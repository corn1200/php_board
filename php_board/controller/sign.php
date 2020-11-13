<?php
    include './member_check.php';
    
    $bm_id = $_POST['id'];
    $bm_password = $_POST['password'];
    $retypepw = $_POST['retypepw'];
    $bm_name = $_POST['name'];
    $bm_address = $_POST['address'];
    $bm_address_num = $_POST['post_code'];
    $bm_address_detail = $_POST['detail_address'];
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