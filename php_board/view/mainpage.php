<?php
session_start();

include '../controller/member_check.php';

if (!isset($_SESSION['id'])) {
    if (!isset($_COOKIE['cookieID'])) {
        echo alertMesseage('You are not Logged in', '/view/loginpage.php');
    } elseif (confirmId($_COOKIE['cookieID'])->fetch() >= 1) {
        $_SESSION['id'] = $_COOKIE['cookieID'];
    }
}
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="../css/mainpage.css"> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="/js/onChangeLeader.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>MainPage</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <header class="mdc-top-app-bar" style="left: 0;">
                    <div class="mdc-top-app-bar__row">
                        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
                            <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button" aria-label="Open navigation menu">account_circle</button>
                            <span class="mdc-top-app-bar__title">
                                <a href="/" style="text-decoration: none;">
                                    <h1 style="font-weight: bold; color: white; margin-bottom: 30px;">Free Board</h1>
                                </a>
                            </span>
                            <span class="mdc-top-app-bar__title">
                                <h4>You can write freely!</h4>
                            </span>
                        </section>
                        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
                            <button class="material-icons mdc-top-app-bar__action-item mdc-icon-button" aria-label="Options">menu</button>
                        </section>
                    </div>
                </header>
            </div>
        </div>
    </div>
    <div class="container">
        <div class></div>
    </div>
    <?php echo showMember(); ?>
    <div id="board_area">
        <a href="/">
            <h1>Free Board</h1>
        </a>
        <h4>You can write freely!</h4>
        <?php
        include '../model/post.php';

        echo showSearchBox($_GET['list']);
        ?>
        <span id="viewing">
            Viewing :
            <select id="num" name="list">
                <option value="ten" <?php echo isSelected($_GET['list'], 10); ?>> 10</option>
                <option value="thirty" <?php echo isSelected($_GET['list'], 30); ?>> 30</option>
                <option value="fifty" <?php echo isSelected($_GET['list'], 50); ?>> 50</option>
                <option value="eighty" <?php echo isSelected($_GET['list'], 80); ?>> 80</option>
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
        if ($_GET['list'] >= 30 && $_GET['page'] != $total) echo showSearchBox($_GET['list']);
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