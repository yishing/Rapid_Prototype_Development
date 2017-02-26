<?php
session_start();
require 'database.php';
 
$id = $_GET['id'];

if($_SESSION['token'] !== $_GET['token']){
	die("Request forgery detected");
}
$stmt = $mysqli->prepare("delete from comment where story_id=?");
if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
}

$stmt->bind_param('i', $id);

$stmt->execute();

$stmt->close();
 
$stmt = $mysqli->prepare("delete from story where id=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->bind_param('i', $id);
 
$stmt->execute();
 
$stmt->close();
header("Location: homepage.php"); 
?>
