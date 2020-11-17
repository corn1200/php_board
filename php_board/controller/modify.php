<?php
    session_start();

    include './member_check.php';
    include '../model/post.php';
    
    $bp_title = $_POST['title'];
    $bp_contents = $_POST['content'];
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