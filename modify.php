<?php
    include $_SERVER['DOCUMENT_ROOT']."/db.php";

    $bno = $_GET['idx'];
    $sql = mq("select * from board where idx='$bno';");
    $board = $sql->fetch_array();
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" href="/css/style.css" />
</head>
<body>
    <div id="board_write">
        <h1><a href=""></a></h1>
    </div>
</body>
</html>