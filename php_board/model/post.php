<?php
    include_once '../db.php';
    
    function confirmPost($idx) {
        $queryResult = DBQuery("select * from board_post where idx='{$idx}'");
        return $queryResult;
    }

    function isPostIdxValid($idx) {
        $postQuery = confirmPost($idx);
        $postQuery = $postQuery->fetch();

        if($postQuery >= 1) {
            return true;
        } else {
            return false;
        }
    }

    function readPostList($startLimit,$limit) {
        $queryResult = DBQuery("select * from board_post order by idx desc limit $startLimit,$limit");
        while($postList = $queryResult->fetch()) {
            $searchNameQuery = DBQuery("select * from board_member where idx = '{$postList['mem_idx']}'");
            $findName = $searchNameQuery->fetch();
            $title = $postList["bp_title"];
            $writetime = dateConversion($postList['bp_create_time']);
            if(strlen($title) > 30) {
                $title = str_replace($postList["bp_title"], mb_substr($postList["bp_title"], 0, 30, "utf-8")."...", $postList["bp_title"]);
            }
        ?>
        <tbody>
            <tr>
                <td width="70"><?php echo $postList['idx'] ?></td>
                <td width="500"><a href="/view/readpage.php?idx=<?php echo $postList['idx']; ?>"><?php echo $title ?></a></td>
                <td width="120"><a href=""><?php echo $findName['bm_name'] ?></a></td>
                <td width="150"><?php echo $writetime ?></td>
                <td width="100"><?php echo $postList['bp_hit'] ?></td>
            </tr>
        </tbody>
    <?php
        }
    }

    function searchPostByIDX($idx) {
        $queryResult = DBQuery("select * from board_post where idx='{$idx}'");
        return $queryResult;
    }

    function somebodyHitPost($idx) {
        $searchHitQuery = searchPostByIDX($idx);
        $findHit = $searchHitQuery->fetch();
        $findHit = $findHit['bp_hit'] + 1;
        $queryResult = DBQuery("update board_post set bp_hit = '{$findHit}' where idx = '{$idx}'");
        return $queryResult;
    }

    function dateConversion($time) {
        $writetime = date("Y-m-d | h:i:s", $time);
        return $writetime;
    }

    function confirmPostWasMine($memberId, $postIdx) {
        $memberQuery = DBQuery("select * from board_member where bm_id = '{$memberId}'");
        $findMember = $memberQuery->fetch();
        $memberIDX = $findMember['idx'];

        $postQuery = searchPostByIDX($postIdx);
        $findPost = $postQuery->fetch();
        $postMemIdx = $findPost['mem_idx'];

        return $memberIDX == $postMemIdx;
    }

    function showModifyAndDelete($memberId, $postIdx) {
        if(confirmPostWasMine($memberId, $postIdx)) {
            ?>
                <li><a href="../view/modifypage.php?idx=<?php echo $postIdx; ?>">[Modify]</a></li>
                <li><a href="../controller/delete.php?idx=<?php echo $postIdx; ?>">[Delete]</a></li>
            <?php
        }
    }
?>