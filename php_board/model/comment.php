<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/db.php';

    function showComment($postIdx, $startLimit, $limit) {
        $queryResult = DBQuery("select * from board_comment where post_idx='{$postIdx}' order by bc_comment_time desc limit $startLimit,$limit");
        return $queryResult;
    }

    function getComment($postIdx) {
        $queryResult = DBQuery("select * from board_comment where post_idx='{$postIdx}' order by idx desc");
        return $queryResult;
    }

    function somebodyCommentAtPost($postIdx) {
        $findPost = searchPostByIDX($postIdx);
        $findPost = $findPost->fetch();
        $commentIdx = $findPost['bp_comment_count'] + 1;
        $queryResult = DBQuery("update board_post set bp_comment_count = '{$commentIdx}' where idx = '{$postIdx}'");
        return $queryResult;
    }

    function confirmCommentWasMine($postIdx, $idx, $memIdx) {
        $commentQuery = DBQuery("select * from board_comment where idx = '{$idx}' and post_idx = '{$postIdx}'");
        $findComment = $commentQuery->fetch();
        $commentIDX = $findComment['mem_idx'];

        return $commentIDX == $memIdx;
    }
?>