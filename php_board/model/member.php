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

    function showMember() {
        ?>
        <div style="position: absolute; right: 10px; top: 10px;">
            Logged at <a href="" style="color:rgb(240, 181, 54);"><?php echo $_SESSION['id']; ?></a> .
            <div style="position: absolute; margin-top: 5px; right: 10px;">
                <a href="../controller/logout.php"><button>Logout</button></a>
            </div>
        </div>
        <?php
    }
?>