<?php
session_start();
require 'database.php';
 
$id = $_GET['id'];
$story_id = $_SESSION['story_id'];
if($_SESSION['token'] !== $_GET['token']){
	die("Request forgery detected");
}
$stmt = $mysqli->prepare("delete from comment where id=?");
if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
}

$stmt->bind_param('i', $id);

$stmt->execute();

$stmt->close();

header("Location: comment.php?id=$story_id");
?>