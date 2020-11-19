<?php
    session_start();
    
    include './member_check.php';
    
    $bp_title = strip_tags($_POST['title'], '<a>');
    $bp_contents = strip_tags($_POST['content'], '<a>');
    $idx = confirmId($_SESSION['id'] ? $_SESSION['id'] : $_COOKIE['cookieID']);
    $idxResult = $idx->fetch();
    $mem_idx = $idxResult["idx"];
    $bp_create_time = strtotime("now");

    if($bp_title && $bp_contents && $mem_idx && $bp_create_time) {
        $sql = DBQuery("insert into board_post(bp_title, bp_contents, mem_idx, bp_create_time) values('".$bp_title."', '".$bp_contents."', '".$mem_idx."', '".$bp_create_time."')");
        echo alertMesseage('Write Success.', '/');
    } elseif(!$bp_title) {
        echo notInvalidAccess('Please Type Title.');
    } elseif(!$bp_contents) {
        echo notInvalidAccess('Please Type Content.');
    }
?>