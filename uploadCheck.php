<?php
session_start();
$username = $_SESSION['username'];
if($_FILES["filex"]) {
  $yol = $_SESSION['active_directory'];
  $yuklemeYeri = $yol . DIRECTORY_SEPARATOR . $_FILES["filex"]["name"];

    if($_FILES["filex"]["size"]>100000000) echo "Dosya boyutu sınırı";
    else{
        $dosyaUzantisi = pathinfo($_FILES["filex"]["name"], PATHINFO_EXTENSION);
        if (file_exists($yuklemeYeri)) $exists = True; //dosya zaten var
        $sonuc = move_uploaded_file($_FILES["filex"]["tmp_name"], $yuklemeYeri);
        if($exists && $sonuc){
            header('Location:roshub.php?s=3');
        }elseif($sonuc){
            //basarili
            $_yol = explode('/',$yol);
            unset($_yol[0]);
            $yol = implode('/',$_yol);
            header('Location:roshub.php?s=1&f=/'.$yol);
        }
        elseif(!($_FILES["filex"]["size"]>0)){
            //dosya secilmedi
            header('Location:roshub.php?s=4');
        }elseif(!file_exists($yol)){
            //kullanicinin dosyasi olusturulmamissa
            header('Location:roshub.php?s=6');
        }else{
            //basarisiz
            header('Location:roshub.php?s=2');
        }
    }
    

}elseif(isset($_POST['createDirectory']) && empty(!$_POST['createDirectory'])){
    $_newDir = $_POST['createDirectory'];
    if(!file_exists($_SESSION['active_directory']."/$_newDir")){
        mkdir($_SESSION['active_directory']."/$_newDir",0777);
        header('Location:roshub.php?s=11&f=/'.$_SESSION['directory_without_upload']);
    }else header('Location:roshub.php?s=12&f=/'.$_SESSION['directory_without_upload']);

}else header('Location:roshub.php?s=4');

?>