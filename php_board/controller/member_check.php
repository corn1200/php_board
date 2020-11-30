<?php
    include $_SERVER['DOCUMENT_ROOT'].'/model/member.php';

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
        $getMember = confirmLoginData($id, $pw);
        $getMember = $getMember->fetch();

        if($getMember >= 1) {
            return true;
        } else {
            return false;
        }
    }

    function alertMesseage($alert, $href) {
        return "<script>
            alert('$alert');
            location.href='$href';
        </script>";
    }

    function notInvalidAccess($alert) {
        return "<script>
            alert('$alert');
            history.back();
        </script>";
    }

    function loginTimeCheck($id) {
        $bm_login_time = strtotime("now");
        return DBQuery("update board_member set bm_login_time = '{$bm_login_time}' where bm_id = '{$id}'");
    }

    function randomString($string_length) {
        $characters = "0123456789";
        $characters .= "abcdefghijklmnopqrstuvwxyz";
        $characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $characters .= "_";

        $resultString = "";

        $loop_length = $string_length;
        while($loop_length--) {
            $resultString .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $resultString;
    }
?>