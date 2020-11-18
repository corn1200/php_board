<?php
    session_start();

    include '../model/post.php';
    include './member_check.php';
    include '../model/comment.php';

    $post_idx = $_GET['idx'];
    $mem_idx = confirmId($_SESSION['id']);
    $mem_idx = $mem_idx->fetch();
    $mem_idx = $mem_idx['idx'];
    $bc_content = $_POST['content'];
    $bc_comment_time = strtotime("now");
    $idx = getComment($post_idx);
    $idx = $idx->fetch();
    $idx = $idx['idx'] + 1;

    if($post_idx && $mem_idx && $bc_content && $bc_comment_time && $idx) {
        $sql = DBQuery("insert into board_comment(mem_idx, bc_content, post_idx, bc_comment_time, idx) values('".$mem_idx."','".$bc_content."','".$post_idx."','".$bc_comment_time."','".$idx."')");
        somebodyCommentAtPost($post_idx);
        return header('Location: ../view/readpage.php?idx='.$post_idx);
    } else {
        echo notInvalidAccess('You can not Comment it.');
    }
?>