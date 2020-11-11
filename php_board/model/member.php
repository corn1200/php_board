<?php
    include '../db.php';

    function confirmId($id) {
        $queryResult = DBQuery("select * from board_member where bm_id='{$id}'");
        return $queryResult;
    }

    function confirmPassword($id) {
        $queryResult = DBQuery("select bm_password from board_member where bm_id='{$id}'");
        return $queryResult;
    }
?>