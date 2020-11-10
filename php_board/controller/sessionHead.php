<?php
    session_start();
    if(isset($_SESSION['id'])) {
        $isLogin = TRUE;
    }

    if(!$isLogin) {
        header ('Location: ../view/loginpage.php');
    }
?>