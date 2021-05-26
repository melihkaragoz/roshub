<?php

session_start();
$check = 0;
if(isset($_GET)){
    if(isset($_GET['file'])){
        $_data = $_GET['file'];
        $_files = explode(',',$_data);
        foreach($_files as $dosya){
            $_username = explode("/",$dosya)[0];
            $_filename = str_replace($_username."/","",$dosya);
            if(file_exists("uploads/$_username/$_filename") && ($_filename != "")){
                if($_SESSION['username'] == $_username){
                    if(is_dir("uploads/$_username/$_filename")){
                        // exec("rm -r uploads/$_username/$_filename");
                        rmdir("uploads/$_username/$_filename");
                    }else exec("rm uploads/$_username/$_filename");
                    $check = 7;
                }else $check = 9;
            }else $check = 7;
        }
    }else header('Location:roshub.php?s=10');
}else header('Location:roshub.php?s=10');

// $yol = "Location:roshub.php?s=".$check."&f=/".$_SESSION['directory_without_upload'];
// header($yol);

switch ($check) {
    case 7:
        header('Location:roshub.php?s=7&f=/'.$_SESSION['directory_without_upload']);
        break;
    case 8:
        header('Location:roshub.php?s=8');
        break;
    case 9:
        header('Location:roshub.php?s=9');
        break;
    case 10:
        header('Location:roshub.php?s=10');
        break;
    }

?>