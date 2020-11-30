<?php
    include $_SERVER['DOCUMENT_ROOT'].'/controller/member_check.php';

    $postIdData = $_POST['userid'];

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