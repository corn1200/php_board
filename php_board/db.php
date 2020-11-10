<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

$dbinfo = "mysql:host=localhost;port=3306;dbname=stu_khs;charset=utf8";
$db = new PDO($dbinfo, 'khs', 'aa123456');

function DBQuery($query) {
    global $db;
    return $db->query($query);
}
?>