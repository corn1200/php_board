<?php
    session_start();

    include '../model/member.php';
    include '../model/post.php';
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/writepage.css">
    <title>ModifyPage</title>
</head>

<body>
    <?php
        echo showMember();

        $postDataQuery = searchPostByIDX($_GET['idx']);
        $findPost = $postDataQuery->fetch();
    ?>
    <button onclick="history.back()">Back</button>
    <div id="board_write">
        <h1><a href="/">Free Board</a></h1>
        <h4>space for modifing.</h4>
        <div id="write_area">
            <form action="../controller/modify.php?idx=<?php echo $_GET['idx']; ?>" method="post">
                <div id="in_title">
                    <textarea name="title" id="utitle" rows="1" cols="55" placeholder="Title" maxlength="100" required><?php echo $findPost['bp_title'] ?></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_content">
                    <textarea name="content" id="ucontent" placeholder="Content" required><?php echo $findPost['bp_contents'] ?></textarea>
                </div>
                <div class="bt_se">
                    <button type="submit">modifying</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>