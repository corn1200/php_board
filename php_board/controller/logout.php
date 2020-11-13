<?php
    session_start();
    $cookieID = $_SESSION['id'];
    setcookie('cookieID', $cookieID, time()-604800, "/");
    session_unset();
    session_destroy();
    
    include './member_check.php';

    echo alertMesseage('Logout success', '/view/loginpage.php');
?>