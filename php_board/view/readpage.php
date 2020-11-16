<?php
    include '../model/post.php';
    include '../model/member.php';
?>
<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>ReadPage</title>
    <link rel="stylesheet" type="text/css" href="../css/readpage.css" />
</head>

<body>
    <?php
        $idxOfPost = $_GET['idx'];
        somebodyHitPost($idxOfPost);
        $searchPostQuery = searchPostByIDX($idxOfPost);
        $findPost = $searchPostQuery->fetch();
        $searchMemberQuery = confirmMemberByIDX($findPost['mem_idx']);
    ?>
    <div id="board_read">
        <h2><?php echo $board['title']; ?></h2>
        <div id="user_info">
            <?php echo $board['name']; ?> <?php echo $board['date']; ?> 조회:<?php echo $board['hit']; ?>
            <div id="bo_line"></div>
        </div>
        <div id="bo_content">
            <?php echo nl2br("$board[content]"); ?>
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