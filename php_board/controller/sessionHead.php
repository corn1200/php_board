<?php
    session_start();

    $isLogin = false;

    if(isset($_SESSION['id']) || isset($_COOKIE['cookieID'])) {
        $isLogin = TRUE;
    }

    function indexPage($isLogin) {
        if(!$isLogin) {
            return header('Location: ../view/loginpage.php');
        } else {
            return header('Location: ../view/mainpage.php');
        }
    }
?>