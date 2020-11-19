<?php
    session_start();

    include '../model/post.php';
    include '../controller/readcomment.php';
?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>ReadPage</title>
    <link rel="stylesheet" type="text/css" href="../css/readpage.css" />
    <script type="text/javascript" src="../js/modifyDialog.js"></script>
</head>

<body>
    <?php
        echo showMember();
        $idxOfPost = $_GET['idx'];
        if(isPostIdxValid($idxOfPost)) {
            somebodyHitPost($idxOfPost);
            $searchPostQuery = searchPostByIDX($idxOfPost);
            $findPost = $searchPostQuery->fetch();
            $searchMemberQuery = confirmMemberByIDX($findPost['mem_idx']);
            $findMember = $searchMemberQuery->fetch();
            $createDate = dateConversion($findPost['bp_create_time']);
        } else {
            echo notInvalidAccess('The wrong approach');
        }
    ?>
    <button onclick="history.back()">Back</button>
    <div id="board_read">
        <h1><a href="/">Free Board</a></h1>
        <h2><?php echo $findPost['bp_title']; ?></h2>
        <div id="user_info">
            <a href=""><?php echo $findMember['bm_name']." | "; ?></a>
            <?php echo $createDate." | "; ?>
            <?php echo "hit : ".$findPost['bp_hit']; ?>
            <?php 
                if(isset($findPost['bp_modify_time'])) {
                    $modifyDate = dateConversion($findPost['bp_modify_time']);
                    echo " >> modify : ".$modifyDate;  
                }
            ?>
            <div id="bo_line"></div>
        </div>
        <div id="bo_content">
            <?php echo nl2br("$findPost[bp_contents]"); ?>
        </div>
        <div id="bo_ser">
            <ul>
                <li><a href="/">[To List]</a></li>
                <?php showModifyAndDelete($_SESSION['id'], $idxOfPost) ?>
            </ul>
        </div>
    </div>
    <div class="reply_view">
        <h3>Comments</h3>
    </div>
    <div class="dap_ins">
        <form action="../controller/comment_write.php?idx=<?php echo $idxOfPost; ?>" method="post">
            <div style="margin-top:10px; ">
				<textarea name="content" class="reply_content" id="re_content" placeholder="Comment" required></textarea>
				<button id="rep_bt" class="re_bt">Comment</button>
			</div>
		</form>
	</div>
    <?php
        echo readCommentList($idxOfPost,0,10);
    ?>
    </div>
        <div id="foot_box"></div>
    </div>
</body>

</html>