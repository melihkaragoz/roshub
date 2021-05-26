<?php 

$baglanti = new mysqli("localhost", "<veritabani_kullanici", "<veritabani_parola", "<veritabani_adi>");   // veritabanına baglanma komutları
$GLOBALS['baglanti'] = $baglanti;
if ($baglanti->connect_errno > 0) die("<b>Bağlantı Hatası:</b> " . $baglanti->connect_error);
$baglanti->set_charset("utf8");

function checkErr(){
    $baglanti = $GLOBALS['baglanti'];
    if ($baglanti->connect_errno > 0) die("<b>Bağlantı Hatası:</b> " . $baglanti->connect_error);
    else echo("<br>"." > process ok.");
}

function getData($username){
    $baglanti = $GLOBALS['baglanti'];
    $userData = $baglanti->query("SELECT * FROM users WHERE username = $username");
    $userData_result = $userData->fetch_array();
    return $userData_result;
}

?>
