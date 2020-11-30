<!-- 
도제학생 김현승 / 게시판 프로젝트
로그아웃 진행 파일입니다.

2020/11/30 오전 10:08 김현승 수정 시작

수정 내용: 로그인 진행 파일에서 추가 발급하게 된 비밀번호,
세션 유지 키, 로그인 유지 키에 대해 로그아웃 시 쿠키 삭제를 추가합니다.

2020/11/30 오전 2:45 김현승 수정 종료
 -->
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/controller/sessionHead.php';

    $loginData['id'] = $_SESSION['id'];
    $loginData['pw'] = $_SESSION['password'];
    $cookieData['id'] = $_COOKIE['cookieID'];
    $cookieData['pw'] = $_COOKIE['cookiePW'];
    if(checkAvailableAccess($loginData, $cookieData) == false) {
        echo alertMesseage('You are not Logged in', '/view/loginpage.php');
    }
    
    loginTimeCheck($_SESSION['id']);
    setcookie('cookieID', $_COOKIE['cookieID'], time()-604800, "/");
    setcookie('cookiePW', $_COOKIE['cookiePW'], time()-604800, "/");
    session_unset();
    session_destroy();
    
    echo alertMesseage('Logout success.', '/view/loginpage.php');
?>