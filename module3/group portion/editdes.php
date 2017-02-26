<?php
require 'database.php';
session_start();
 
  
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}
$title = $_POST['title'];
$des = $_POST['description'];
$id = $_SESSION['id'];
 
$stmt = $mysqli->prepare("update story set title=?, des=? where id=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->bind_param('ssi', $title, $des, $id);
 
$stmt->execute();
 
$stmt->close();

header("Location: homepage.php");
 
?>