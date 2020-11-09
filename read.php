<?php
    include $_SERVER['DOCUMENT_ROOT']."/db.php";
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="./css/style_read.css" />
</head>
<body>
    <?php
        $bno = $_GET['idx'];
        $hit = mysqli_fetch_array(mq("select * from board_post where idx ='".$bno."'"));
        $hit = $hit['bp_hit'] + 1;
        $fet = mq("update board_post set bp_hit = '".$hit."' where idx = '".$bno."'");
        $sql = mq("select * from board_post where idx='".$bno."'");
        $board = $sql->fetch_array();
    ?>

    <div id="board_read">
        <h2><?php echo $board['bp_title']; ?></h2>
        <div id="user_info">
            <?php echo $board['mem_idx']; ?> <?php echo $board['bp_create_time']; ?> 조회: <?php echo $board['bp_hit']; ?>
            <div id="bo_line"></div>
        </div>
        <div id="bo_content">
            <?php echo nl2br("$board[bp_contents]"); ?>
        </div>
        <div id="bo_ser">
            <ul>
                <li><a href="/">[목록으로]</a></li>
                <li><a href="modify.php?idx=<?php echo $board['idx']; ?>">[수정]</a></li>
                <li><a href="delete.php?idx=<?php echo $board['idx']; ?>">[삭제]</a></li>
            </ul>
        </div>
    </div>

    <div class="reply_view">
        <h3>댓글목록</h3>
        <?php
            $sql3 = mq("select * from board_comment post_idx='".$bno."' order by bc_comment_time desc");
            while($reply = $sql3->fetch_array()) {
        ?>
        <div class="dap_lo">
            <div><b><?php echo $reply['name']; ?></b></div>
            <div class="dap_to comt_edit"><?php echo nl2br("$reply[content]"); ?></div>
            <div class="rep_me dap_to"><?php echo $reply['data']; ?></div>
            <div class="rep_me rep_menu">
                <a class="dat_edit_bt" href="#">수정</a>
                <a class="dat_delete_bt" href="#">삭제</a>
            </div>
        </div>
        <div class="dat_edit">
            <form action="rep_modify_ok.php" method="post">
                <input type="hidden" name="rno" value="<?php echo $reply['mem_idx']; ?>" /> <input type="hidden" name="b_no" value="<?php echo $bno; ?>">
                <textarea name="content" class="dap_edit_t"></textarea>
            </form>
        </div>
    </div>
</body>
</html>
