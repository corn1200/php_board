<?php
    include_once '../db.php';

    function confirmId($id) {
        $queryResult = DBQuery("select * from board_member where bm_id='{$id}'");
        return $queryResult;
    }

    function confirmLoginData($id, $pw) {
        $queryResult = DBQuery("select * from board_member where bm_id='{$id}' AND bm_password='{$pw}'");
        return $queryResult;
    }

    function confirmMemberByIDX($idx) {
        $queryResult = DBQuery("select * from board_member where idx='{$idx}'");
        return $queryResult;
    }
?>