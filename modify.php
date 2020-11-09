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
        <h1><a href="/">자유게시판</a></h1>
        <h4>글을 수정합니다.</h4>
        <div id="write_area">
            <form action="modify_ok.php?idx=<?php echo $bno; ?>" method="post">
        
        </form>
        </div>
    </div>
</body>
</html>