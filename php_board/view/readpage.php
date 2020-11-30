<?php
include $_SERVER['DOCUMENT_ROOT'].'/controller/sessionHead.php';
include $_SERVER['DOCUMENT_ROOT'].'/model/post.php';
include $_SERVER['DOCUMENT_ROOT'].'/controller/readcomment.php';

$loginData['id'] = $_SESSION['id'];
$loginData['pw'] = $_SESSION['password'];
$cookieData['id'] = $_COOKIE['cookieID'];
$cookieData['pw'] = $_COOKIE['cookiePW'];
if(checkAvailableAccess($loginData, $cookieData) == false) {
    echo alertMesseage('You are not Logged in', '/view/loginpage.php');
}
?>
<!doctype html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>ReadPage</title>
    <link rel="stylesheet" type="text/css" href="../css/readpage.css" />
    <script type="text/javascript" src="../js/modifyDialog.js"></script>
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
    </style>
</head>

<body style="background-color: #fafafa;">
    <?php
    echo showAppBar();
    ?>
    <div class="container">
        <div class="row" style="margin-top: 100px;">
            <div class="mdc-card" style="min-height: 500px;">
                <?php
                $idxOfPost = $_GET['idx'];
                if (isPostIdxValid($idxOfPost)) {
                    somebodyHitPost($idxOfPost);
                    $searchPostQuery = searchPostByIDX($idxOfPost);
                    $findPost = $searchPostQuery->fetch();
                    $searchMemberQuery = confirmMemberByIDX($findPost['mem_idx']);
                    $findMember = $searchMemberQuery->fetch();
                    $createDate = dateConversion($findPost['bp_create_time']);
                } else {
                    echo notInvalidAccess('The wrong approach');
                }
                ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="board_read" style="margin: 30px;">
                                <h2 style="text-align: center;"><?php echo $findPost['bp_title']; ?></h2>
                                <div id="user_info" style="text-align: center;">
                                    <a href=""><?php echo $findMember['bm_name'] . " | "; ?></a>
                                    <?php echo $createDate . " | "; ?>
                                    <?php echo "hit : " . $findPost['bp_hit']; ?>
                                    <?php
                                    if (isset($findPost['bp_modify_time'])) {
                                        $modifyDate = dateConversion($findPost['bp_modify_time']);
                                        echo " >> modify : " . $modifyDate;
                                    }
                                    ?>
                                    <div id="bo_line"></div>
                                </div>
                                <div id="bo_content">
                                    <?php echo nl2br("$findPost[bp_contents]"); ?>
                                </div>
                                <div id="bo_ser">
                                    <ul>
                                        <li><a href="/">[To List]</a></li>
                                        <?php showModifyAndDelete($_SESSION['id'], $idxOfPost) ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="reply_view" style="margin-top: 20px;">
                <span>
                    <form action="../controller/comment_write.php?idx=<?php echo $idxOfPost; ?>" method="post">
                        <div>
                            <textarea name="content" class="reply_content" id="re_content" placeholder="Comment" style="width: 1170px;" required></textarea>
                        </div>
                        <button id="rep_bt" class="mdc-button mdc-button--raised" style="position: absolute; right: 370px; float: right; font-size: 15px; background: rgb(162,0,255); background: linear-gradient(90deg, rgba(162,0,255,1) 0%, rgba(91,3,250,1) 56%, rgba(55,4,255,1) 100%);">
                            <div class="mdc-button__ripple"></div>
                            <i class="material-icons mdc-button__icon" aria-hidden="true">comment</i>
                            <span class="mdc-button__label">Comment</span>
                        </button>
                    </form>
                </span>
            </div>
            <h3>Comments</h3>
            <?php
            echo readCommentList($idxOfPost, 0, 10);
            ?>
        </div>
        <div id="foot_box"></div>
    </div>
    </div>
</body>

</html>