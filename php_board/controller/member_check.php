<?php
    include '../model/member.php';

    $postIdData = $_POST['userid'];

    function confirmOverlapId($id) {
        $id_check = confirmId($id);
        $id_check = $id_check->fetch();

        if($id_check >= 1) {
            return true;
        } else {
            return false;
        }
    }

    function isLoginDataValid($id, $pw) {
        $getId = confirmId($id);
        $getPw = DBQuery();
    }

    if($postIdData != NULL) {
        if(confirmOverlapId($postIdData)) {
            echo "ID already exists.";
        } else {
            echo "Your ID is valid.";
        }
    } else {
        echo "Please Type Your ID.";
    }
?>