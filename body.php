<?php

session_start();
$username = $_SESSION['username'];
if(!file_exists("uploads/$username")) $noDir = true;
else $noDir = false;
if($noDir) mkdir("uploads/$username",0777);
$activeDirectory = "uploads/$username";

    if($_GET || $noDir){
        if(isset($_GET['f'])){
            $_recieve_data =  $_GET['f'];
            $_rec_data = explode('/',$_recieve_data);
            unset($_rec_data[1]);
            $_data = implode('/',$_rec_data);
            $_getDir = "uploads/$username".$_data;
            $_getDir = str_replace('..','',$_getDir);
            if(is_dir($_getDir)){
                $activeDirectory = $_getDir;
                if($activeDirectory[strlen($activeDirectory)-1] == '/') $activeDirectory = substr($activeDirectory,0,-1);
            }else $activeDirectory = 'null';
        }
        if($_GET['s'] || $noDir){
            $status_code = $_GET['s'];
            if($noDir) $status_code = '6';
            if($status_code == '1') $status = "Dosya yükleme başarılı.";
            if($status_code == '2') $status = "Dosya yükleme başarısız.";
            if($status_code == '3') $status = "Dosya güncellendi";
            if($status_code == '4') $status = "Lütfen bir dosya seçin.";
            if($status_code == '5') $status = "Dosya indirme işlemi başarılı.";
            //if($status_code == '6') $status = "Adınıza alan ayrılmamış, lütfen yönetici ile iletişime geçin : <a href='mailto:rubwally@gmail.com'>rubwally@gmail.com</a>";
            if($status_code == '6') $status = "Merhaba, RosHUB Sunucusuna hoşgeldiniz. Dilediğiniz türden dosyaları burada ücretsiz barındırabilir ve istediğiniz dosyaları zip formatında tek seferde indirebilirsiniz. Hata,öneri ve şikayetler için : <a href='mailto:rubwally@gmail.com'>rubwally@gmail.com</a> ";
            if($status_code == '7') $status = "Dosya başarıyla silindi.";
            if($status_code == '8') $status = "Dosya sistemde mevcut değil.";
            if($status_code == '9') $status = "Bu dosyaya erişmeye yetkiniz yok";
            if($status_code == '10')$status = "Bir hata meydana geldi.";
            if($status_code == '11')$status = "Klasör başarıyla oluşturuldu.";
            if($status_code == '12')$status = "Bu klasör zaten sistemde bulunuyor.";

            $colors = ['green','red','green','orange','green','green','green','red','red','red','green','orange'];
        } 
    }

$_SESSION['active_directory'] = $activeDirectory;
?>

<div class="body-main">
    <div class="body-upload">
        <div class="body-upload-status" style="background-color: <?php echo($colors[$status_code-1]) ?>;">
            <p><?php echo($status) ?></p>
        </div>

        <form action="uploadCheck.php" method="post" enctype="multipart/form-data">
            <label for="filex"><div class="body-file-label" id="body-form-button">Dosya seç</div></label>
            <input style="display:none" type="file" name="filex" id="filex">
            <input id="body-form-button" type="submit" value="Yükle">
            <input type="file" name="klasor" webkitdirectory directory multiple value="klasor">
        </form>
       
    </div>
    


    <div class="body-list">

        <div class="body-list-files">
            <p id="body-list-text">  Dosyalarınız : </p>
            <form action="uploadCheck.php" method="post" id="createDirForm">
                <input type="text" name="createDirectory" id="createDirectory">
            </form>
            <button id="addDirBtn" onclick="showAddDirBtn();">+</button>
            <button onclick="startSelection()" id="selection_btn">Seç</button>
            <br><br>
            <form id="checkboxform">
                <?php
                    $_tmp_backDir = explode('/',$activeDirectory);
                    unset($_tmp_backDir[0]);
                    $_SESSION['directory_without_upload'] = implode('/',$_tmp_backDir);
                    $_dir_str = $_tmp_backDir[count($_tmp_backDir)];
                    if($_tmp_backDir[count($_tmp_backDir)] != $username) unset($_tmp_backDir[count($_tmp_backDir)]);
                    $_backDir = implode('/',$_tmp_backDir);
                    $_SESSION['back_directory'] = "/".$_backDir;
                ?>
            <a href="<?php echo("roshub.php?f=/" .$_backDir) ?>"><img src="media/backDir.png" alt="back_to_main_directory" id='backDir' width="25" height="25"></a><?php echo("<p id='_dir_str'>$_dir_str</p>") ?>
            <div class="_files">
            <?php 
                $username = $_SESSION['username'];
                $dir = "uploads";
                if(isset($activeDirectory) && ($activeDirectory != 'null')){
                    $dosyalar = glob("$activeDirectory/*");
                    foreach ($dosyalar as $dosya) {
                        if($dosya != "uploads/code" && $dosya != "uploads/totalfiles"){
                            $dosya = str_replace($dir,"",$dosya);
                            $dosya = str_replace('//',"",$dosya);
                            $_dosya= str_replace($username."/","",$dosya);    
                            //$_dosya= str_replace("/","",$_dosya); 
                            $_new_dir = explode('/',$_dosya);
                            $newDir = $_new_dir[count($_new_dir)-1];
                            $dirORfile = "";
                            if(is_dir($activeDirectory.'/'.$newDir)) $dirORfile = 'dir_p';
                            else $dirORfile = 'file_p';
                            ?>
                            <div class="list-row">
                                <input type="checkbox" name="selections[]" class="checkbox" value="<?php echo($dosya) ?>">
                                <a id="body-list-row" onclick="showContent('<?php echo($dosya) ?>');" target='ifrm'>
                                <?php echo("<p id='".$dirORfile."'>".$newDir."</p>") ?>
                                <div class="enterDir"><a href="roshub.php?f=<?php echo($dosya) ?>">
                                <?php if(is_dir($activeDirectory.'/'.$newDir))echo("<img src='media/enterDir.png' width='20' height='20' alt='enter_directory'>") ?></a><br></div>
                            </div>
                            <?php
                        }
                    }
                }else echo("<b id='noActiveDir'>Bir hata meydana geldi.</b><br><b id='noActiveDir'>Lütfen yönetici ile iletişime <a href='mailto:rubwally@gmail.com'>geçin</a></b> ");

            ?>
            </div>

            <script>

                var _files = ""

                function _download(){
                    selected_arr = showSelected();
                    _arr = showSelected(1);
                    _len = Object.keys(_arr).length;
                    str_req = "uploads/code/compression.php?list=" + selected_arr;
                    window.location.replace(str_req);
                }

                function _delete(){
                    _files = showSelected();
                    areYouSure()
                }

            </script>


            </form>
            <div class="actions">
                <button id="btn-download" onclick="_download();">İndir</button>
                <button id="btn-delete" onclick="_delete();">Sil</button>
            </div>

        </div>

        <div class="body-list-content">
            <iframe id="ifrm"></iframe>
        </div>

    </div>
    
</div>

<div id="areYouSure">

    <p> Seçili öğeleri silmek istediğinize emin misiniz? </p><br>
    <button onclick="areYouSure(true,false)">Evet</button>
    <button onclick="areYouSure(false,true)">İptal</button>


 </div>