<?php
session_start();

include '../controller/member_check.php';

if (isset($_SESSION['id'])) {
    $logId = $_SESSION['id'];
    echo alertMesseage('You are Already Logged in ' . $logId, '/view/mainpage.php');
} elseif (isset($_COOKIE['cookieID'])) {
    $logId = $_COOKIE['cookieID'];
    echo alertMesseage('You are Already Logged in ' . $logId, '/view/mainpage.php');
}
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Texturina:wght@100&display=swap" rel="stylesheet">
    <title>LoginPage</title>
</head>

<body style="background-color: #484848; font-family: 'Texturina', serif; text-shadow: 4px 4px 6px black;">
    <div class="container">
        <div class="mdc-card" style="margin-top: 95px; background-color: #212121; color: white;">
            <div class="row">
                <div class="col-sm-6">
                    <img src="https://images.unsplash.com/photo-1606055292780-79987ee44af7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80" style="width: 100%; height: auto;">
                </div>
                <div class="col-sm-6">
                    <h1 style="text-align: center; margin-top: 200px; font-weight: bold;">LOGIN</h1>
                    <form class="form-horizontal" action="../controller/login.php" method="POST">
                        <div class="form-group" style="margin-top: 30px;">
                            <label for="id" class="col-sm-2 control-label">ID</label>
                            <div class="col-sm-8">
                                <label class="col-sm-12 mdc-text-field mdc-text-field--outlined">
                                    <span class="mdc-notched-outline">
                                        <span class="mdc-notched-outline__leading"></span>
                                        <span class="mdc-notched-outline__trailing"></span>
                                    </span>
                                    <i class="material-icons mdc-button__icon" style="margin-top: 15px;" aria-hidden="true">perm_identity</i>
                                    <input type="text" class="mdc-text-field__input" name="id" placeholder="* ID" id="id" style="color: white; font-size: 15px; margin-left: 10px;" required>
                                </label>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 30px;">
                            <label for="password" class="col-sm-2 control-label">PASSWORD</label>
                            <div class="col-sm-8">
                                <label class="col-sm-12 mdc-text-field mdc-text-field--outlined">
                                    <span class="mdc-notched-outline">
                                        <span class="mdc-notched-outline__leading"></span>
                                        <span class="mdc-notched-outline__trailing"></span>
                                    </span>
                                    <i class="material-icons mdc-button__icon" style="margin-top: 15px;" aria-hidden="true">security</i>
                                    <input type="password" class="mdc-text-field__input" name="password" placeholder="* PASSWORD" id="password" style="color: white; font-size: 15px; margin-left: 10px;" required>
                                </label>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 30px; margin-bottom: 30px;">
                            <label for="submit" class="col-sm-4 control-label"></label>
                            <div class="col-sm-4">
                                <button class="mdc-button mdc-button--raised form-control" value="LOGIN" id="submit" style="background-color: #fc9f00; font-size: 15px;">
                                    <div class="mdc-button__ripple"></div>
                                    <i class="material-icons mdc-button__icon" aria-hidden="true">login</i>
                                    <span class="mdc-button__label">LOGIN</span>
                                </button>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 30px; margin-bottom: 30px;">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <div class="mdc-form-field">
                                    <div class="mdc-checkbox">
                                        <input type="checkbox" class="mdc-checkbox__native-control" name="maintain" id="idMaintain" value="keepLogin">
                                        <div class="mdc-checkbox__background">
                                            <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                            </svg>
                                            <div class="mdc-checkbox__mixedmark"></div>
                                        </div>
                                        <div class="mdc-checkbox__ripple"></div>
                                    </div>
                                    <label for="idMaintain" style="font-size: 15px; color: white; font-weight: bold;">Keep logged in</label>
                                </div>
                                <span> / </span>
                                <a href="./signpage.php" style="text-decoration: none; color:#333; color: white; font-weight: bold;">SIGN</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>