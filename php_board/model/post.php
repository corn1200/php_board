<?php
    include_once '../db.php';

    function getAllPost() {
        $queryResult = DBQuery("select * from board_post");
        return $queryResult;
    }
    
    function isPostIdxValid($idx) {
        $postQuery = searchPostByIDX($idx);
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
                <td width="500"><a href="/view/readpage.php?idx=<?php echo $postList['idx']; ?>"><?php echo $title."[".$postList['bp_comment_count']."]" ?></a></td>
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

    function getPageNum($page) {
        if(isset($page)) {
            return $page;
        } else {
            return 1;
        }
    }

    function calcBlockData($page, $block_ct) {
        $block['num'] = ceil($page/$block_ct);
        $block['start'] = (($block['num'] - 1) * $block_ct) + 1;
        $block['end'] = $block['start'] + $block_ct - 1;
        return $block;
    }

    function calcPageData($row_num, $list, $block, $page, $block_ct) {
        $total['page'] = ceil($row_num/$list);
        if($block['end'] > $total['page']) $block['end'] = $total['page'];
        $total['block'] = ceil($total['page']/$block_ct);
        return $total;
    }

    function showPagingView($page, $block, $total) {
        if($page >= 1) {
            echo "<li class='fo_re'>First</li>";
        } else {
            echo "<li><a href='?page=1'>First</a></li>";
        }
        
        if($page <= 1) {

        } else {
            $pre = $page - 1;
            echo "<li><a href='?page=$pre'>Previous</a></li>";
        }

        for($i = $block['start']; $i <= $block['end']; $i++) {
            if($page == $i) {
                echo "<li class='fo_re'>[$i]</li>";
            } else {
                echo "<li><a href='?page=$i'>[$i]</a></li>";
            }
        }

        if($block['num'] >= $total['block']) {

        } else {
            $next = $page + 1;
            echo "<li><a href='?page=$next'>Next</a></li>";
        }

        if($page >= $total['page']) {
            echo "<li class='fo_re'>Last</li>";
        } else {
            echo "<li><a href='?page=$total[page]'>Last</a></li>";
        }
    }
?>