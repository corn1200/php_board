<?php
	session_start();
    header('Content-Type: text/html; charset=utf-8');

	$db = new mysqli("innoi.kr","khs","aa123456","stu_khs","3306");
	$db->set_charset("utf8");

	function mq($sql) {
		global $db;
		return $db->query($sql);
	}
?>
