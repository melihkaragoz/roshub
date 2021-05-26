<?php

session_start();

if(isset($_GET['path']))
{
    //Read the url
    $url_a = $_GET['path'];
    $url = "../totalfiles/".$url_a;

    //Clear the cache
    clearstatcache();

    //Check the file path exists or not
    if(file_exists($url)) {
        //Define header information
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($url).'"');
        header('Content-Length: ' . filesize($url));
        header('Pragma: public');

        //Clear system output buffer
        flush();

        //Read the size of the file
        readfile($url,true);
        exec("cd ../totalfiles; rm -r * ");
        header('Location: ../../roshub.php?s=5');

        //Terminate from the script
        die();
    }
    else echo "File path does not exist.";
}
echo "File path is not defined.";


?>