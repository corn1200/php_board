<!-- 
도제학생 김현승 / 게시판 프로젝트
서버 루트에 도착시 로그인 여부에 따라
메인페이지 혹은 로그인 페이지로 인도하는 파일입니다.

2020/11/30 오후 4:30 김현승 수정 시작

수정 내용: 기존 모든 파일에서 세션을 시작할 때 sessionstart를 사용한 부분을
sessionHead 파일을 인클루드 하는 방식으로 변경하였으며, 이로 인해
sessionHead 파일 내에 함수를 이용해 유저가 접근할 수 있는 모든 페이지와
동작을 담당하는 파일에 index 페이지와 같이 현재 로그인 여부를 판별하게
수정했습니다. 다른 페이지에서 로그아웃을 하고 여전히 페이지를 이용하는
오류를 고쳤습니다.

2020/11/30 오후 4:57 김현승 수정 종료
 -->
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/controller/sessionHead.php';
    
    $loginData['id'] = $_SESSION['id'];
    $loginData['pw'] = $_SESSION['password'];
    $cookieData['id'] = $_COOKIE['cookieID'];
    $cookieData['pw'] = $_COOKIE['cookiePW'];

    $hasLoginData = checkAvailableAccess($loginData, $cookieData);
    indexPage($hasLoginData);
?>