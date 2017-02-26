<?php
session_start();
		
require 'database.php';
		
$comment = $_POST['comment'];
$username = $_SESSION['username'];
$story_id = $_SESSION['story_id'];
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}
$stmt = $mysqli->prepare("insert into comment (username, story_id, comment) values (?, ?, ?)");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('sis', $username, $story_id, $comment);

$stmt->execute();

$stmt->close();

header("Location: comment.php?id=$story_id");
?>