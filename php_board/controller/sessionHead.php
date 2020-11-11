<?php
    include '../model/member.php';

    if(isset($_SESSION['id'])) {
        $isLogin = TRUE;
    }

    if(!$isLogin) {
        header ('Location: ../view/loginpage.php');
    }
?>