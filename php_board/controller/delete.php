<?php
    session_start();

    include './member_check.php';
    include '../model/post.php';
    
    $postIdx = $_GET['idx'];
    $isMinePost = confirmPostWasMine($_SESSION['id'], $postIdx);

    if($isMinePost) {
        $sql = DBQuery("delete from board_post where idx=$postIdx");
        DBQuery("delete from board_comment where post_idx=$postIdx");
        echo alertMesseage('Delete Success.', '/');
    } else {
        echo notInvalidAccess('You can not Delete this Post.');
    }
?>