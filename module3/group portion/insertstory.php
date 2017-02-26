<?php
session_start();
		
require 'database.php';
		
if(!empty($_POST['title']) && !empty($_POST['link']) && !empty($_POST['description']) && !empty($_POST['symbol'])){
	$title = $_POST['title'];
	$link  = $_POST['link']; 
	$des   = $_POST['description'];
	$symbol= $_POST["symbol"];
		
	$username = $_SESSION['username'];

	if($_SESSION['token'] !== $_POST['token']){
			die("Request forgery detected");
	}

	$stmt = $mysqli->prepare("insert into story (title, link, des, username, cate) values (?, ?, ?, ?, ?)");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
 
	$stmt->bind_param('sssss', $title, $link, $des, $username, $symbol);
 
	$stmt->execute();
 
	$stmt->close();

	header("Location: homepage.php");
} else {
	echo "No field is allowed to be empty. Please fill in all the fields<br>";
	echo "<a class='link' href='story.php'>Try again</a>";
}
?>

