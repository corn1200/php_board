<?php
    include $_SERVER['DOCUMENT_ROOT'].'/controller/sessionHead.php';
    include $_SERVER['DOCUMENT_ROOT'].'/model/post.php';

    $loginData['id'] = $_SESSION['id'];
    $loginData['pw'] = $_SESSION['password'];
    $cookieData['id'] = $_COOKIE['cookieID'];
    $cookieData['pw'] = $_COOKIE['cookiePW'];
    if(checkAvailableAccess($loginData, $cookieData) == false) {
        echo alertMesseage('You are not Logged in', '/view/loginpage.php');
    }
    
    $bp_title = strip_tags($_POST['title'], '<a>');
    $bp_contents = strip_tags($_POST['content'], '<a>');
    $isMinePost = confirmPostWasMine($_SESSION['id'], $_GET['idx']);
    $bp_modify_time = strtotime("now");

    if($bp_title && $bp_contents && $isMinePost && $bp_modify_time) {
        $sql = DBQuery("update board_post set bp_title = '".$bp_title."', bp_contents = '".$bp_contents."', bp_modify_time = '".$bp_modify_time."' where idx = '".$_GET['idx']."'");
        echo alertMesseage('Modify Success.', '/view/readpage.php?idx='.$_GET['idx']);
    } elseif(!$bp_title) {
        echo notInvalidAccess('Please Type Title.');
    } elseif(!$bp_contents) {
        echo notInvalidAccess('Please Type Content.');
    } else {
        echo notInvalidAccess('You can not Modify this Post.');
    }
?>