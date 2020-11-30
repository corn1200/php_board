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
    
    $postIdx = $_GET['idx'];
    $isMinePost = confirmPostWasMine(isset($_SESSION['id']) ? $_SESSION['id'] : $_COOKIE['cookieID'], $postIdx);

    if($isMinePost) {
        $sql = DBQuery("delete from board_post where idx=$postIdx");
        DBQuery("delete from board_comment where post_idx=$postIdx");
        echo alertMesseage('Delete Success.', '/');
    } else {
        echo notInvalidAccess('You can not Delete this Post.');
    }
?>