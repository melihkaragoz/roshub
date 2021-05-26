<?php

if(isset($_GET['list'])){
    $list = $_GET['list'];
    $liste = explode(",",$list);
    $str = "";
    foreach($liste as $item){
        if(file_exists("../".$item) && $item != ""){
        $url = "cp -r ../".$item." ../totalfiles/";
        }else{
        $url = "cp ../".$item." ../totalfiles/";
        }
        exec($url);
    }
    echo(exec("cd ../totalfiles;rar a rosehub.rar *"));
    $next = exec("cd ../totalfiles;ls *.rar");
    $hd_url = 'Location: indir.php?path='.$next;
    header($hd_url);



}


?>