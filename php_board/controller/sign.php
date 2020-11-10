<?php
    include '../db.php';
    
    $bm_id = $_POST['id'];
    $bm_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $bm_name = $_POST['name'];
    $bm_address = ($_POST['address'] ? $_POST['address'] : null);
    $bm_address_num = ($_POST['post_code'] ? $_POST['post_code'] : null);
    $bm_address_detail = ($_POST['detail_address'] ? $_POST['detail_address'] : null);
    $bm_create_time = strtotime("now");

    if($bm_id && $bm_password && $bm_name && $bm_create_time) {
        $sql = DBQuery("insert into board_member(bm_id, bm_password, bm_name, bm_address, bm_address_num, bm_address_detail, bm_create_time) values('".$bm_id."', '".$bm_password."', '".$bm_name."', '".$bm_address."', '".$bm_address_num."', '".$bm_address_detail."', '".$bm_create_time."')");
        header('Location: ../index.php');
    }
?>