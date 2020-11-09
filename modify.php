<?php
    include $_SERVER['DOCUMENT_ROOT']."/db.php";

    $bno = $_GET['idx'];
    $sql = mq("select * from board_post where idx='$bno';");
    $board = $sql->fetch_array();
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" href="/css/style_write.css" />
</head>
<body>
    <div id="board_write">
        <h1><a href="/">자유게시판</a></h1>
        <h4>글을 수정합니다.</h4>
        <div id="write_area">
            <form action="modify_ok.php?idx=<?php echo $bno; ?>" method="post">
                <div id="in_title">
                    <textarea name="title" id="utitle" cols="55" rows="1" placeholder="제목" maxlength="100" required><?php echo $board['bp_title']; ?></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_name">
                    <textarea name="name" id="uname" cols="55" rows="1" placeholder="글쓴이" maxlength="100" required><?php echo $board['mem_idx']; ?></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_content">
                    <textarea name="content" id="ucontent" placeholder="내용" required><?php echo $board['bp_contents']; ?></textarea>
                </div>
                <div class="bt_se">
                    <button type="submit">글 수정</button>
                </div>
        </form>
        </div>
    </div>
</body>
</html>
