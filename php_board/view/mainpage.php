<?php
include $_SERVER['DOCUMENT_ROOT'].'/controller/sessionHead.php';
include $_SERVER['DOCUMENT_ROOT'].'/model/post.php';

$loginData['id'] = $_SESSION['id'];
$loginData['pw'] = $_SESSION['password'];
$cookieData['id'] = $_COOKIE['cookieID'];
$cookieData['pw'] = $_COOKIE['cookiePW'];
if(checkAvailableAccess($loginData, $cookieData) == false) {
    echo alertMesseage('You are not Logged in', '/view/loginpage.php');
}
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="/js/onChangeLeader.js"></script>
    <script type="text/javascript" src="/js/onChangeLeader2.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script>
        const listEl = document.querySelector('.mdc-drawer .mdc-list');
        const mainContentEl = document.querySelector('.main-content');

        listEl.addEventListener('click', (event) => {
            mainContentEl.querySelector('input, button').focus();
        });

        document.body.addEventListener('MDCDrawer:closed', () => {
            mainContentEl.querySelector('input, button').focus();
        });
    </script>
    <style>
        a {
            text-decoration: none;
            color: black;
        }

        a:hover {
            text-decoration: none;
            color: black;
        }

        ul li {
            list-style: none;
        }

        .fl {
            float: left;
        }

        .tc {
            text-align: center;
        }

        .list-table {
            margin-top: 60px;
        }

        .list-table thead th {
            height: 40px;
            border-top: 2px solid #38006b;
            border-bottom: 1px solid #CCC;
            font-weight: bold;
            font-size: 17px;
            text-align: center;
        }

        .list-table tbody td {
            text-align: center;
            padding: 10px 0;
            border-bottom: 1px solid #CCC;
            height: 20px;
            font-size: 14px
        }

        #page_num {
            font-size: 14px;
            margin-left: 260px;
            margin-top: 50px;
        }

        #page_num ul li {
            float: left;
            margin-left: 10px;
            text-align: center;
        }

        .fo_re {
            font-weight: bold;
            color: #38006b;
            margin-left: 15px;
        }
    </style>
    <title>MainPage</title>
</head>

<body style="background-color: #fafafa;">
    <?php
    echo showAppBar();
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3" style="margin-top: 65px;">
                <aside class="mdc-drawer" style="border-bottom:1px solid #CCC;">
                    <div class="mdc-drawer__content">
                        <nav class="mdc-list">
                            <a class="mdc-list-item" href="./writepage.php" aria-current="page">
                                <span class="mdc-list-item__ripple"></span>
                                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">create</i>
                                <span class="mdc-list-item__text" id="write_btn">Writing</span>
                            </a>
                            <a class="mdc-list-item">
                                <span class="mdc-list-item__ripple"></span>
                                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">view_headline</i>
                                <span class="mdc-list-item__text" id="viewing">
                                    Viewing :
                                </span>
                                <select id="num" name="list" style="border-style: none;">
                                    <option value="ten" <?php echo isSelected($_GET['list'], 10); ?>> 10</option>
                                    <option value="thirty" <?php echo isSelected($_GET['list'], 30); ?>> 30</option>
                                    <option value="fifty" <?php echo isSelected($_GET['list'], 50); ?>> 50</option>
                                    <option value="eighty" <?php echo isSelected($_GET['list'], 80); ?>> 80</option>
                                </select>
                            </a>
                            <a class="mdc-list-item">
                                <span class="mdc-list-item__ripple"></span>
                                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">sort</i>
                                <span class="mdc-list-item__text" id="viewing">
                                    Sorting By :
                                </span>
                                <select id="order" name="order" style="border-style: none;">
                                    <option value="default" <?php echo isSelected($_GET['order'], "default"); ?>>default</option>
                                    <option value="hit" <?php echo isSelected($_GET['order'], "hit"); ?>>hit</option>
                                </select>
                            </a>
                        </nav>
                    </div>
                </aside>
            </div>
            <div class="col-sm-6" style="margin-top: 90px;">
                <div class="mdc-card">
                    <div id="board_area" style="margin-left: 30px; margin-right: 30px; margin-top: -20px; margin-bottom: 20px;">
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

                            echo readPostList($start_num, $list, $_GET['category'], $_GET['search'], $_GET['order']);
                            ?>
                        </table>
                    </div>
                </div>
                <div id="page_num" style="margin-top: 0px; margin-bottom: 50px;">
                    <ul>
                        <?php
                        echo showPagingView($page, $block, $total, $list, $_GET['category'], $_GET['search'], $_GET['order']);
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>