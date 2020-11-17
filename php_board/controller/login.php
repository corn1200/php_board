<?php
    session_start();

    include './member_check.php';

    $id = $_POST['id'];
    $password = $_POST['password'];
    
    $loginValid = isLoginDataValid($id, $password);

    if($loginValid) {
        $_SESSION['id'] = $id;
        if(isset($_POST['maintain'])) {
            $cookieID = $id;
            setcookie('cookieID', $cookieID, time()+604800, "/");
        }
        loginTimeCheck($id);
        echo alertMesseage('Login success.', '/view/mainpage.php');
    } else {
        echo notInvalidAccess('Can not Login.');
    }
?>