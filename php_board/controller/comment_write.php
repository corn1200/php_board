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

    if($post_idx && $post_idx && $post_idx && $post_idx) {
        $sql = DBQuery("insert into board_comment(mem_idx, bc_content, post_idx, bc_comment_time) values('".$mem_idx."','".$bc_content."','".$post_idx."','".$bc_comment_time."',)");
        return header('Location: ../view/readpage.php?idx='.$post_idx);
    } else {
        echo notInvalidAccess('You can not Comment it.');
    }
?>