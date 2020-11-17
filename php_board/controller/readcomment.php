<?php
    include '../model/comment.php';
    include '../controller/member_check.php';

    function readCommentList($postIdx, $startLimit, $limit) {
        $findCommentQuery = showComment($postIdx, $startLimit, $limit);
        while($findComment = $findCommentQuery->fetch()) {
            $findMemberQuery = confirmMemberByIDX($findComment['mem_idx']);
            $findMemberQuery = $findMemberQuery->fetch();
            $memberName = $findMemberQuery['bm_name'];
            $createDate = dateConversion($findComment['bc_comment_time']);
            ?>
            <div class="dap_lo">
                <div><b><?php echo $memberName;?></b></div>
			    <div class="dap_to comt_edit"><?php echo nl2br("$findComment[bc_content]"); ?></div>
			    <div class="rep_me dap_to"><?php echo $createDate; ?></div>
			    <div class="rep_me rep_menu">
				    <a class="dat_edit_bt" href="#">Modify | </a>
				    <a class="dat_delete_bt" href="#">Delete</a>
			    </div>
            </div>
            <?php
        }
    }
?>