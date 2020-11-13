<?php
    session_start();

    $isLogin = false;

    if(isset($_SESSION['id']) || isset($_COOKIE['cookieID'])) {
        $isLogin = TRUE;
    }

    if(!$isLogin) {
        header ('Location: ../view/loginpage.php');
    } else {
        header ('Location: ../view/mainpage.php');
    }
?>