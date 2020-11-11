<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../js/checkMember.js"></script>
    <title>LoginPage</title>
</head>
<body>
    <h1>LOGIN</h1>
    <form action="../controller/login.php" method="POST">
        <input type="text" name="id" placeholder="* ID" id="id" required>
        <input type="password" name="password" placeholder="* PASSWORD" id="password" required>
        <input type="submit" value="LOGIN" disabled="" id="submit">
    </form>
    <a href="./signpage.php">SIGN</a>
</body>
</html>