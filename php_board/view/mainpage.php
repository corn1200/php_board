<?php
session_start();

include '../controller/member_check.php';

if (!isset($_SESSION['id'])) {
    if (!isset($_COOKIE['cookieID'])) {
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
        <a href="/"><h1>Free Board</h1></a>
        <h4>You can write freely!</h4>
        <?php
            include '../model/post.php';

            echo showSearchBox($_GET['list']);
        ?>
        <span id="viewing">
            Viewing :
            <select id="num" name="list" onchange="location.href='/view/mainpage.php?list='+document.getElementById('num').options[document.getElementById('num').selectedIndex].text;">
                <option required>list</option>
                <option value="ten"> 10</option>
                <option value="thirty"> 30</option>
                <option value="fifty"> 50</option>
                <option value="eighty"> 80</option>
            </select>
        </span>
        <span id="write_btn">
            <a href="./writepage.php"><button>Writing</button></a>
        </span>
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
                $page = getPageNum($_GET['page']);
                $row_num = getPost($_GET['category'], $_GET['search'])->rowCount();
                $list = getListNum($_GET['list']);
                $block_ct = 5;
                $block = calcBlockData($page, $block_ct);
                $total = calcPageData($row_num, $list, $block_ct);
                if ($block['end'] > $total['page']) {
                    $block['end'] = $total['page'];
                }
                $start_num = ($page - 1) * $list;

                echo readPostList($start_num, $list, $_GET['category'], $_GET['search']);
            ?>
        </table>
        <?php
            if($_GET['list'] >= 30 && $_GET['page'] != $total) echo showSearchBox($_GET['list']);
        ?>
        <div id="page_num">
            <ul>
                <?php
                echo showPagingView($page, $block, $total, $list, $_GET['category'], $_GET['search']);
                ?>
            </ul>
        </div>
    </div>
</body>

</html>