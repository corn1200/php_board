<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../js/searchAddress.js"></script>
    <script type="text/javascript" src="../js/checkMember.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Texturina:wght@100&display=swap" rel="stylesheet">
    <title>SignPage</title>
</head>

<body style="background: rgb(63,94,251); background: linear-gradient(90deg, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%); font-family: 'Texturina', serif; text-shadow: 2px 2px 6px #aeaeae;">
    <div class="container">
        <div class="row">
            <button class="mdc-button mdc-button--raised" onclick="location.href = '/'" style="margin-top: 30px; font-size: 15px;">
                <div class="mdc-button__ripple"></div>
                <i class="material-icons mdc-button__icon" aria-hidden="true">arrow_back_ios</i>
                <span class="mdc-button__label">Back</span>
            </button>
            <div class="mdc-card" style="margin-top: 30px;">
                <h1 style="text-align: center; font-weight: bold;">SIGN</h1>
                <form class="form-horizontal" action="/controller/sign.php" method="post">
                    <div class="form-group" style="margin-top: 30px;">
                        <label for="id" class="col-sm-2 control-label">ID *</label>
                        <div class="col-sm-8">
                            <label class="col-sm-12 mdc-text-field mdc-text-field--outlined">
                                <span class="mdc-notched-outline">
                                    <span class="mdc-notched-outline__leading"></span>
                                    <span class="mdc-notched-outline__trailing"></span>
                                </span>
                                <i class="material-icons mdc-button__icon" style="margin-top: 15px;" aria-hidden="true">perm_identity</i>
                                <input type="text" class="mdc-text-field__input" name="id" placeholder="* ID" id="id" style="font-size: 15px; margin-left: 10px;" required autofocus>
                            </label>
                            <div id="id_check" style="margin-top: 15px; color: #000;">Please Type Your ID.</div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 15px;">
                        <label for="password" class="col-sm-2 control-label">PASSWORD *</label>
                        <div class="col-sm-8">
                            <label class="col-sm-12 mdc-text-field mdc-text-field--outlined">
                                <span class="mdc-notched-outline">
                                    <span class="mdc-notched-outline__leading"></span>
                                    <span class="mdc-notched-outline__trailing"></span>
                                </span>
                                <i class="material-icons mdc-button__icon" style="margin-top: 15px;" aria-hidden="true">security</i>
                                <input type="password" class="mdc-text-field__input" name="password" placeholder="* PASSWORD" id="password" style="font-size: 15px; margin-left: 10px;" required>
                            </label>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 30px;">
                        <label for="retypepw" class="col-sm-2 control-label">Retype PASSWORD *</label>
                        <div class="col-sm-8">
                            <label class="col-sm-12 mdc-text-field mdc-text-field--outlined">
                                <span class="mdc-notched-outline">
                                    <span class="mdc-notched-outline__leading"></span>
                                    <span class="mdc-notched-outline__trailing"></span>
                                </span>
                                <i class="material-icons mdc-button__icon" style="margin-top: 15px;" aria-hidden="true">repeat</i>
                                <input type="password" class="mdc-text-field__input" name="retypepw" placeholder="* Retype PASSWORD" id="retypepw" style="font-size: 15px; margin-left: 10px;" required>
                            </label>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 30px;">
                        <label for="name" class="col-sm-2 control-label">NAME *</label>
                        <div class="col-sm-8">
                            <label class="col-sm-12 mdc-text-field mdc-text-field--outlined">
                                <span class="mdc-notched-outline">
                                    <span class="mdc-notched-outline__leading"></span>
                                    <span class="mdc-notched-outline__trailing"></span>
                                </span>
                                <i class="material-icons mdc-button__icon" style="margin-top: 15px;" aria-hidden="true">assignment</i>
                                <input type="text" class="mdc-text-field__input" name="name" placeholder="* NAME" id="name" style="font-size: 15px; margin-left: 10px;" required>
                            </label>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 15px;">
                        <label for="searchaddress" class="col-sm-2 control-label"></label>
                        <div class="col-sm-8">
                            <button type="button" class="mdc-button mdc-button--raised" id="searchaddress" onclick="searchAddress()" style="font-size: 15px;">
                                <div class="mdc-button__ripple"></div>
                                <i class="material-icons mdc-button__icon" aria-hidden="true">search</i>
                                <span class="mdc-button__label">SEARCH ADDRESS</span>
                            </button>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 15px;">
                        <label for="post_code" class="col-sm-2 control-label">POST CODE</label>
                        <div class="col-sm-8">
                            <label class="col-sm-12 mdc-text-field mdc-text-field--outlined">
                                <span class="mdc-notched-outline">
                                    <span class="mdc-notched-outline__leading"></span>
                                    <span class="mdc-notched-outline__trailing"></span>
                                </span>
                                <i class="material-icons mdc-button__icon" style="margin-top: 15px;" aria-hidden="true">local_post_office</i>
                                <input type="text" class="mdc-text-field__input" name="post_code" placeholder="POST CODE" id="post_code" style="font-size: 15px; margin-left: 10px;">
                            </label>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 30px;">
                        <label for="address" class="col-sm-2 control-label">ADDRESS</label>
                        <div class="col-sm-8">
                            <label class="col-sm-12 mdc-text-field mdc-text-field--outlined">
                                <span class="mdc-notched-outline">
                                    <span class="mdc-notched-outline__leading"></span>
                                    <span class="mdc-notched-outline__trailing"></span>
                                </span>
                                <i class="material-icons mdc-button__icon" style="margin-top: 15px;" aria-hidden="true">room</i>
                                <input type="text" class="mdc-text-field__input" name="address" placeholder="ADDRESS" id="address" style="font-size: 15px; margin-left: 10px;">
                            </label>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 30px;">
                        <label for="detail_address" class="col-sm-2 control-label">DETAIL ADDRESS</label>
                        <div class="col-sm-8">
                            <label class="col-sm-12 mdc-text-field mdc-text-field--outlined">
                                <span class="mdc-notched-outline">
                                    <span class="mdc-notched-outline__leading"></span>
                                    <span class="mdc-notched-outline__trailing"></span>
                                </span>
                                <i class="material-icons mdc-button__icon" style="margin-top: 15px;" aria-hidden="true">apartment</i>
                                <input type="text" class="mdc-text-field__input" name="detail_address" placeholder="DETAIL ADDRESS" id="detail_address" style="font-size: 15px; margin-left: 10px;">
                            </label>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 30px; margin-bottom: 30px;">
                        <label for="submit" class="col-sm-5 control-label"></label>
                        <div class="col-sm-2">
                            <button class="mdc-button mdc-button--raised form-control" id="submit" style="font-size: 15px;" disabled="">
                                <div class="mdc-button__ripple"></div>
                                <i class="material-icons mdc-button__icon" aria-hidden="true">person_add</i>
                                <span class="mdc-button__label">SIGN</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>