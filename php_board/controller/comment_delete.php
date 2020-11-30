<!-- 
도제학생 김현승 / 게시판 프로젝트
댓글을 삭제하는 동작을 담당하는 파일입니다.

2020/11/30 오후 5:11 김현승 수정 시작

수정 내용: 기존 메인페이지에서 쿠키 값이 존재하면 세션에 쿠키 값을 덮어
씌우는 동작을 변경하여 현재 세션으로만 구분하던 부분이 정상 작동하지 않아
구조 개선 및 로그인 유효 확인을 추가했습니다.

2020/11/30 오후 5:17 김현승 수정 종료
 -->
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/controller/sessionHead.php';
    include $_SERVER['DOCUMENT_ROOT'].'/model/comment.php';
    include $_SERVER['DOCUMENT_ROOT'].'/model/post.php';
    
    $loginData['id'] = $_SESSION['id'];
    $loginData['pw'] = $_SESSION['password'];
    $cookieData['id'] = $_COOKIE['cookieID'];
    $cookieData['pw'] = $_COOKIE['cookiePW'];
    if(checkAvailableAccess($loginData, $cookieData) == false) {
        echo alertMesseage('You are not Logged in', '/view/loginpage.php');
    }
    
    $postIdx = $_GET['post'];
    $commentIdx = $_GET['idx'];
    $memberIdx = confirmLoginData($loginData['id'], $loginData['pw']);
    $memberIdx = $memberIdx->fetch();
    $memberIdx = $memberIdx['idx'];
    $isMineComment = confirmCommentWasMine($postIdx, $commentIdx, $memberIdx);

    if($isMineComment && isLoginDataValid($loginData['id'], $loginData['pw'])) {
        $sql = DBQuery("delete from board_comment where idx=$commentIdx and post_idx=$postIdx");
        $findPost = searchPostByIDX($postIdx);
        $findPost = $findPost->fetch();
        $commentIdx = $findPost['bp_comment_count'] - 1;
        $queryResult = DBQuery("update board_post set bp_comment_count = '{$commentIdx}' where idx = '{$postIdx}'");
        return header('Location: ../view/readpage.php?idx='.$postIdx);
    } else {
        echo notInvalidAccess('You can not Delete this Comment.');
    }
?>