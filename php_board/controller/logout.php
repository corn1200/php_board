<?php
    session_start();
    $cookieID = $_SESSION['id'];
    include './member_check.php';
    loginTimeCheck($_SESSION['id']);
    setcookie('cookieID', $cookieID, time()-604800, "/");
    session_unset();
    session_destroy();
    
    echo alertMesseage('Logout success.', '/view/loginpage.php');
?>