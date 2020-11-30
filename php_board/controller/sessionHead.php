<!-- 
도제학생 김현승 / 게시판 프로젝트
세션, 유저 확인 파일입니다.

2020/11/30 오후 2:58 김현승 수정 시작

수정 내용: 기존 세션에 아이디가 존재하는지 확인하는 방식을 개편하기 위해
세션에 저장된 아이디, 비밀번호의 유효성을 판결합니다.
만약, 로그인 유지를 선택하여 로그인 유지에 대한 쿠키가 존재할 경우
쿠키에 저장된 로그인 정보를 이용하여 로그인 합니다.

2020/11/30 오후 3:35 김현승 수정 종료
 -->
<?php
    session_start();
    include_once $_SERVER['DOCUMENT_ROOT'].'/controller/member_check.php';
    function checkAvailableAccess($loginData, $cookieData) {
        $id = $loginData['id'];
        $pw = $loginData['pw'];
        $cookieID = $cookieData['id'];
        $cookiePW = $cookieData['pw'];
        /*
        로그인 정보가 존재하는가 판별하고 유효한가 판별합니다.
        만약 기존 로그인 정보가 존재하지 않는다면 쿠키의 로그인 정보를
        이용하여 유효한 접근인지 판별합니다.
        */
        if(checkExistenceMemberData($id, $pw) && isLoginDataValid($id, $pw)) {
            return true;
        } elseif(checkExistenceMemberData($cookieID, $cookiePW) && isLoginDataValid($cookieID, $cookiePW)) {
            return true;
        } else {
            return false;
        }
    }

    function checkExistenceMemberData($id, $pw) {
        /*
        받아온 로그인 정보가 유효한지, 비어있진 않은지
        문제를 일으키지 않는 유효한 값임을 판별합니다.
        */
        if(isset($id) && isset($pw) && $id != "" && $pw != "" && $id != null && $pw != null) {
            return true;
        } else {
            return false;
        }
    }

    /*
    index 페이지에서 로그인 정보 유효에 따라 메인페이지 이동하고
    유효하지 않으면 로그인 페이지로 이동시킵니다.
    */
    function indexPage($isLogin) {
        if($isLogin) {
            return header('Location: /view/mainpage.php');
        } else {
            return header('Location: /view/loginpage.php');
        }
    }
?>