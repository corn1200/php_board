<?php
    include './member_check.php';
    
    $bm_id = strip_tags($_POST['id'], '<a>');
    $bm_password = hash("sha256", $_POST['password']);
    $retypepw = hash("sha256", $_POST['retypepw']);
    $bm_name = strip_tags($_POST['name'], '<a>');
    $bm_address = strip_tags($_POST['address'], '<a>');
    $bm_address_num = strip_tags($_POST['post_code'], '<a>');
    $bm_address_detail = strip_tags($_POST['detail_address'], '<a>');
    $bm_create_time = strtotime("now");

    $isIdOverlap = confirmOverlapId($bm_id);
    $isPwValid = $bm_password == $retypepw;

    if($bm_id && $bm_password && $bm_name && $bm_create_time && !$isIdOverlap && $isPwValid) {
        $sql = DBQuery("insert into board_member(bm_id, bm_password, bm_name, bm_address, bm_address_num, bm_address_detail, bm_create_time) values('".$bm_id."', '".$bm_password."', '".$bm_name."', '".$bm_address."', '".$bm_address_num."', '".$bm_address_detail."', '".$bm_create_time."')");
        echo alertMesseage('Sign Success.', '/');
    } elseif(!$isPwValid) {
        echo notInvalidAccess('PASSWORD Not Invalid.');
    } else {
        echo notInvalidAccess('ID already exists.');
    }
?>