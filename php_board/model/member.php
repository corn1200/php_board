<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/db.php';

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

    function showMember() {
        ?>
        <div style="position: relative; margin-bottom: 5px;">
            Logged at <a href="" style="color: #fc9f00; font-weight: bold;"><?php echo isset($_SESSION['id']) ? $_SESSION['id'] : $_COOKIE['cookieID']; ?></a> .
        </div>
        <?php
    }
?>