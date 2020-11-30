<!-- 
도제학생 김현승 / 게시판 프로젝트
로그인 진행 파일입니다.

2020/11/30 오전 9:50 김현승 수정 시작

수정 내용: 로그인 후 세션에 아이디만 저장하는 부분을
아이디, 비밀번호를 저장하고 유효한지 확인하는 형태로 수정합니다.
로그인 유지 선택 시 아이디 값이 담긴 쿠키만 발급하는 형태를
아이디와 비밀번호 쿠키 발급 형태로 수정합니다. 

2020/11/30 오전 10:06 김현승 수정 종료
 -->
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/controller/sessionHead.php';

    $loginData['id'] = $_SESSION['id'];
    $loginData['pw'] = $_SESSION['password'];
    $cookieData['id'] = $_COOKIE['cookieID'];
    $cookieData['pw'] = $_COOKIE['cookiePW'];
    if(checkAvailableAccess($loginData, $cookieData)) {
        echo alertMesseage('You are already Logged in', '/view/mainpage.php');
    }

    $id = $_POST['id'];
    $password = hash("sha256", $_POST['password']);
    
    $loginValid = isLoginDataValid($id, $password);

    /* 
    로그인 정보가 유효한지 판별하고 로그인 유지 선택여부와
    로그인 정보의 유효함에 따라 분기를 나눠서 로그인 처리를 합니다.
    */
    if($loginValid) {
        $_SESSION['id'] = $id;
        $_SESSION['password'] = $password;
        /*
        로그인 유지를 선택 시 7일간 유지되는 아이디, 비밀번호 쿠키를 발급합니다.
        */
        $maintainLogin = isset($_POST['maintain']);
        if($maintainLogin) {
            setcookie('cookieID', $id, time()+604800, "/");
            setcookie('cookiePW', $password, time()+604800, "/");
        }
        loginTimeCheck($id);
        echo alertMesseage('Login success.', '/view/mainpage.php');
        /*
        로그인 정보가 유효하지 않은 경우 로그인 할 수 없다는 알림창을 띄워
        유저가 로그인 정보가 잘못됐다는 것을 알 수 있게 합니다.
        */
    } else {
        echo notInvalidAccess('Can not Login.');
    }
?>