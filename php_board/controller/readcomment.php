<?php
include $_SERVER['DOCUMENT_ROOT'].'/model/comment.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controller/member_check.php';

function readCommentList($postIdx, $startLimit, $limit)
{
    $findCommentQuery = showComment($postIdx, $startLimit, $limit);
    $confirmHasCommentQuery = showComment($postIdx, $startLimit, $limit);
    $haveComment = $confirmHasCommentQuery->fetch();

    if ($haveComment >= 1) {
        while ($findComment = $findCommentQuery->fetch()) {
            $findMemberQuery = confirmMemberByIDX($findComment['mem_idx']);
            $findMemberQuery = $findMemberQuery->fetch();
            $memberName = $findMemberQuery['bm_name'];
            $createDate = dateConversion($findComment['bc_comment_time']);
?>
            <div class="dap_lo">
                <div><b><?php echo $memberName; ?></b></div>
                <div class="dap_to comt_edit"><?php echo nl2br("$findComment[bc_content]"); ?></div>
                <div class="rep_me dap_to"><?php echo $createDate; ?></div>
                <?php
                $thisMember = confirmId($_SESSION['id']);
                $thisMember = $thisMember->fetch();
                $thisMember = $thisMember['idx'];
                if ($thisMember == $findComment['mem_idx']) {
                ?>
                    <div class="rep_me rep_menu">
                        <a class="dat_edit_bt" href="">Modify</a>
                        <span> | </span>
                        <a class="dat_delete_bt" href="/controller/comment_delete.php?idx=<?php echo $findComment['idx'] . "&post=" . $findComment['post_idx']; ?>">Delete</a>
                    </div>
                    <div class="dat_edit">
                        <form method="post" action="rep_modify_ok.php">
                            <input type="hidden" name="rno" value="<?php echo $findComment['idx']; ?>" /><input type="hidden" name="b_no" value="<?php echo $postIdx; ?>">
                            <textarea name="content" class="dap_edit_t"><?php echo $findComment['content']; ?></textarea>
                            <input type="submit" value="Modify" class="re_mo_bt">
                        </form>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        }
    } else {
        ?>
        <h5>No Comments . . .</h5>
<?php
    }
}
?>