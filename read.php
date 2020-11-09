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
        $sql = mq("select * from board_post where idx='".$bno."'");asdasdasd
        $board = $sql->fetch_array();
    ?>

    <div id="board_read">
        <h2><?php echo $board['bp_title']; ?></h2>
        <div id="user_info">
            <?php echo $board['mem_idx']; ?> <?php echo $board['bp_create_time']; ?> 조회: <?php echo $board['bp_hit']; ?>
            <div id="bo_line"></div>
        </div>
        <div id="bo_content">asdasdasd
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
</body>
</html>
