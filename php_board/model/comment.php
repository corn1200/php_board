<?php
    include_once '../db.php';

    function showComment($postIdx, $startLimit, $limit) {
        $queryResult = DBQuery("select * from board_comment where post_idx='{$postIdx}' order by bc_comment_time desc limit $startLimit,$limit");
        return $queryResult;
    }

    function getComment($postIdx) {
        $queryResult = DBQuery("select * from board_comment where post_idx='{$postIdx}'");
        return $queryResult;
    }

    function somebodyCommentAtPost($postIdx) {
        $findPost = searchPostByIDX($postIdx);
        $findPost = $findPost->fetch();
        $commentIdx = $findPost['bp_comment_idx'] + 1;
        $queryResult = DBQuery("update board_post set bp_hit = '{$commentIdx}' where idx = '{$postIdx}'");
        return $queryResult;
    }
?>