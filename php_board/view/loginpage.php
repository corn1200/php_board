<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MainPage</title>
</head>
<body>
    <h1>로그인</h1>
    <form action="../controller/login.php" method="POST">
        <input type="text" name="id" placeholder="ID">
        <input type="password" name="password" placeholder="PASSWORD">
        <button>Login</button>
    </form>
    <a href="./signpage.php">회원가입</a>
</body>
</html>