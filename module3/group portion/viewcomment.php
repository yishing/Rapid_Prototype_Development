<!DOCTYPE HTML>
<html>
    <head>
        <title>Comment</title>
        <link href="login.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    	<?php
		session_start();
		
		require 'database.php';
		
		$story_id = $_GET['id'];
		$stmt = $mysqli->prepare("select title, link, des, username, cate from story where id=?");
   		if(!$stmt){
    		printf("Query Prep Failed: %s\n", $mysqli->error);
	   		exit;
    	}
    		
    	$stmt->bind_param('i', $story_id);
    	
    	$stmt->execute();
 
    	$result = $stmt->get_result();

    	while($row = $result->fetch_assoc()){
        	echo "<a class='title' href='";
        	echo htmlentities($row[link]); 
        	echo "'>";
        	echo htmlentities($row[title]); 
        	echo "</a><br>";
	        echo "<p class='one'>Description: ";
	        echo htmlentities($row["des"]);
	        echo "<br></p>";
	        echo "<p class='two'>posted by:  ";
	        echo htmlentities($row["username"]);
	        echo "</p> ";
	        echo "<p class='two'>category: ";
	        echo htmlentities($row["cate"]);
	        echo "<br></p>";
    	}  
 
    	$stmt->close();
    	
    	$stmt = $mysqli->prepare('select count(*) from comment where story_id=?');

		$stmt->bind_param('s', $story_id);
		$stmt->execute();

		$stmt->bind_result($cnt);
		$stmt->fetch();
		
		$stmt->close();
		
		if($cnt == 0){
			echo "<br>";
			echo "<p class='one'>No comment now!</p>";
		} else {
    		echo "<br><p class='one'>Comments<br></p>";
    	
    		$stmt = $mysqli->prepare("select comment, username from comment where story_id=?");
			if(!$stmt){
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
			}
 
			$stmt->bind_param('i', $story_id);
 
			$stmt->execute();
 
    		$result = $stmt->get_result();
		
			while($row = $result->fetch_assoc()){
				echo "\t<p class='two'>";
				echo htmlspecialchars($row["username"]);
				echo ":</p><p class='one'> ";
				echo htmlspecialchars($row["comment"]);
				echo "</p>";
			}
 
			$stmt->close();
		}
		?>
    	
    	<a class='link' href='homepage.php'>Homepage</a>
    	
    </body>
</html>