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
    <title>WritePage</title>
</head>

<body style="background-color: #fafafa;">
    <?php
    echo showAppBar();
    ?>
    <div class="container">
        <div class="row" style="margin-top: 80px;">
            <div class="mdc-card">
                <div id="board_write">
                    <div id="write_area">
                        <form action="../controller/write.php" method="post">
                            <div id="in_title">
                                <textarea name="title" id="utitle" rows="1" cols="55" placeholder="Title" maxlength="100" required></textarea>
                            </div>
                            <div class="wi_line"></div>
                            <div id="in_content">
                                <textarea name="content" id="ucontent" placeholder="Content" required></textarea>
                            </div>
                            <div class="bt_se" style="margin-bottom: 20px;">
                                <button  type="submit" class="mdc-button mdc-button--raised" onclick="location.href = '/'" style="margin-top: 30px; font-size: 13px;">
                                    <div class="mdc-button__ripple"></div>
                                    <i class="material-icons mdc-button__icon" aria-hidden="true">create</i>
                                    <span class="mdc-button__label">Writing</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>