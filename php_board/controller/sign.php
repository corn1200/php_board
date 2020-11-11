<?php
    include './member_check.php';
    
    $bm_id = $_POST['id'];
    $bm_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $bm_name = $_POST['name'];
    $bm_address = $_POST['address'];
    $bm_address_num = $_POST['post_code'];
    $bm_address_detail = $_POST['detail_address'];
    $bm_create_time = strtotime("now");

    $isIdOverlap = confirmOverlapId($bm_id);

    if($bm_id && $bm_password && $bm_name && $bm_create_time && !$isIdOverlap) {
        $sql = DBQuery("insert into board_member(bm_id, bm_password, bm_name, bm_address, bm_address_num, bm_address_detail, bm_create_time) values('".$bm_id."', '".$bm_password."', '".$bm_name."', '".$bm_address."', '".$bm_address_num."', '".$bm_address_detail."', '".$bm_create_time."')");
        header('Location: ../index.php');
    } else {
        echo "<script>
                alert('ID already exists.');
                history.back();
              </script>";
    }
?>