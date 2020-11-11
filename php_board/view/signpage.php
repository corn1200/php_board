<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../js/searchAddress.js"></script>
    <script type="text/javascript" src="../js/checkMember.js"></script>
    <title>signpage</title>
</head>
<body>
    <form action="../controller/sign.php" method="post">
        <input type="text" name="id" placeholder="* ID" id="id" required>
        <div id="id_check">Please Type Your ID.</div>
        <input type="password" name="password" placeholder="* PASSWORD" id="password" required>
        <input type="text" name="name" placeholder="* NAME" id="name" required>
        <input type="button" value="SEARCH ADDRESS" id="searchaddress" onclick="searchAddress()"></input>
        <input type="text" name="address" placeholder="ADDRESS" id="address">
        <input type="text" name="post_code" placeholder="POST CODE" id="post_code">
        <input type="text" name="detail_address" placeholder="DETAIL ADDRESS" id="detail_address">
        <input type="submit" value="SIGN" disabled="" id="submit">
    </form>
</body>
</html>