<?php
session_start();
require 'database.php';

$comment = $_POST['comment'];
$id = $_SESSION['id'];
$story_id = $_SESSION['story_id'];

if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}

$stmt = $mysqli->prepare("update comment set comment=? where id=?");
if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
}

$stmt->bind_param('si', $comment, $id);

$stmt->execute();

$stmt->close();

header("Location: comment.php?id=$story_id");

?>