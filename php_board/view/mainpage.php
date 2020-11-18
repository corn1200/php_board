<?php
    session_start();

    include '../controller/member_check.php';

    if(!isset($_SESSION['id'])) {
        if(!isset($_COOKIE['cookieID'])) {
            echo alertMesseage('You are not Logged in', '/view/loginpage.php');
        } else {
            $_SESSION['id'] = $_COOKIE['cookieID'];
        }
    }
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/mainpage.css">
    <title>MainPage</title>
</head>
<body>
    <?php echo showMember(); ?>
    <div id="board_area">
        <h1>Free Board</h1>
        <h4>You can write freely!</h4>
        <div id="write_btn">
            <a href="./writepage.php"><button>Writing</button></a>
        </div>
        <table class="list-table">
            <thead>
                <tr>
                    <th width="70">No.</th>
                    <th width="500">Title</th>
                    <th width="120">Writer</th>
                    <th width="150">Date Created</th>
                    <th width="100">Hit</th>
                </tr>
            </thead>
            <?php
                include '../model/post.php';

                $page = getPageNum($_GET['page']);
                $row_num = getAllPost()->rowCount();
                $list = 30;
                $block_ct = 5;
                $block = calcBlockData($page, $block_ct);
                $total = calcPageData($row_num, $list, $block, $page, $block_ct);
                $start_num = ($page-1) * $list;
                
                echo readPostList($start_num,$list);
            ?>
        </table>
        <div id="page_num">
            <ul>
                <?php
                    echo showPagingView($page, $block, $total);
                ?>
            </ul>
        </div>
    </div>
</body>
</html>