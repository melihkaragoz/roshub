<?php

include('connect.php');

session_destroy();
session_start();

if(isset($_POST)){
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        $log_username = $_POST['username'];
        $log_password = $_POST['password'];
        $baglanti = $GLOBALS['baglanti'];
        $req = $baglanti->query("SELECT * FROM users WHERE username = '$log_username'");
        $log = $req->fetch_array();
        if($log_password == $log['password']){
            $_SESSION['logged'] = True;
            $_SESSION['isAdmin'] = True;
            $_SESSION['username'] = $log_username;
            $_SESSION['mail'] = $log['mail'];
            $_SESSION['teams'] = $log['teams'];
            $_SESSION['register_date'] = $log['register_date'];
            header('Location: roshub.php');
        } 
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RosHUB</title>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300&display=swap" rel="stylesheet"> 
</head>
<body>

<div class="login-main">

    <form method="post">

        <input type="text" name="username" id="username" placeholder="kullanici adi">
        <input type="password" name="password" id="password" placeholder="sifre">
        <button>giriş yap</button>
        <button id="registerbtn">kayıt ol</button>

    </form>

</div>
    
</body>
</html>