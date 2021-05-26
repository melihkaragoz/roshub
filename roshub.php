<?php

session_start();
if(!$_SESSION['logged']){
    header('Location: login.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RosHub</title>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300&display=swap" rel="stylesheet">
</head>
<body>

<?php include('header.php'); ?> 
<?php include('body.php'); ?>
<?php include('footer.php'); ?>   

</body>
</html>