<?php
    include $_SERVER['DOCUMENT_ROOT'].'/controller/sessionHead.php';
    include $_SERVER['DOCUMENT_ROOT'].'/model/comment.php';
    include $_SERVER['DOCUMENT_ROOT'].'/model/post.php';
    
    $loginData['id'] = $_SESSION['id'];
    $loginData['pw'] = $_SESSION['password'];
    $cookieData['id'] = $_COOKIE['cookieID'];
    $cookieData['pw'] = $_COOKIE['cookiePW'];
    if(checkAvailableAccess($loginData, $cookieData) == false) {
        echo alertMesseage('You are not Logged in', '/view/loginpage.php');
    }
    
    $postIdx = $_GET['post'];
    $commentIdx = $_GET['idx'];
    $memberIdx = confirmId($_SESSION['id']);
    $memberIdx = $memberIdx->fetch();
    $memberIdx = $memberIdx['idx'];
    $isMineComment = confirmCommentWasMine($postIdx, $commentIdx, $memberIdx);

    if($isMineComment) {
        $sql = DBQuery("delete from board_comment where idx=$commentIdx and post_idx=$postIdx");
        $findPost = searchPostByIDX($postIdx);
        $findPost = $findPost->fetch();
        $commentIdx = $findPost['bp_comment_count'] - 1;
        $queryResult = DBQuery("update board_post set bp_comment_count = '{$commentIdx}' where idx = '{$postIdx}'");
        return header('Location: ../view/readpage.php?idx='.$postIdx);
    } else {
        echo notInvalidAccess('You can not Delete this Comment.');
    }
?>