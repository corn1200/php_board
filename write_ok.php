<?php

include $_SERVER['DOCUMENT_ROOT']."/db.php";

$username = $_POST['name'];
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$title = $_POST['title'];
$content = $_POST['content'];
$date = strtotime("now");
if($username && $userpw && $title && $content) {
    $sql = mq("insert into board_post(bp_title, bp_contents, mem_idx, bp_create_time, bp_modify_time, bp_file, bp_hit) values('".$title."', '".$content."', '".$username."', '".$date."', '".null."', '".null."', 0)") ;
    echo "<script>
    alert('글쓰기가 완료되었습니다.');
    location.href='/';
    </script>";
} else {
    echo "<script>
    alert('글쓰기에 실패했습니다.');
    history.back();
    </script>";
}
?>
