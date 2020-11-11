<?php
    include '../db.php';

    function confirmId($id) {
        $queryResult = DBQuery("select * from board_member where bm_id='{$id}'");
        return $queryResult;
    }
?>