<?php
    session_start();

    include '../controller/member_check.php';

    if(isset($_SESSION['id']) || isset($_COOKIE['cookieID'])) {
        $logId = $_SESSION['id'];
        echo alertMesseage('You are Already Logged in '.$logId, '/view/mainpage.php');
    }
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginPage</title>
</head>
<body>
    <h1>LOGIN</h1>
    <form action="../controller/login.php" method="POST">
        <input type="text" name="id" placeholder="* ID" id="id" required>
        <input type="password" name="password" placeholder="* PASSWORD" id="password" required>
        <input type="submit" value="LOGIN" id="submit">
        <div>
            <input type="checkbox" name="maintain" id="idMaintain" value="keepLogin">Keep logged in
        </div>
    </form>
    <a href="./signpage.php">SIGN</a>
</body>
</html>