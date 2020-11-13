<?php
    session_start();

    include '../controller/member_check.php';

    if(!isset($_SESSION['id']) && !isset($_COOKIE['cookieID'])) {
        echo alertMesseage('You are not Logged in', '/view/loginpage.php');
    } else {
        $_SESSION['id'] = $_COOKIE['cookieID'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Logged at <a href=""><?php echo $_SESSION['id']; ?></a> .
    <div>
        <a href="../controller/logout.php">LOGOUT</a>
    </div>
</body>
</html>