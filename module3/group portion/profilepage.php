<!DOCTYPE HTML>
<html>
    <head>
        <title>Profile page</title>
        <link href="login.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    	<?php
		require 'database.php';
		session_start();
		
		$username = $_SESSION['username'];
		
		//query the number of storys for user
		$stmt = $mysqli->prepare('select count(*) from story where username=?');

		$stmt->bind_param('s', $username);
		$stmt->execute();

		$stmt->bind_result($story_cnt);
		$stmt->fetch();
		
		$stmt->close();
		
		//query the number of comments for user
		$stmt = $mysqli->prepare('select count(*) from comment where username=?');

		$stmt->bind_param('s', $username);
		$stmt->execute();

		$stmt->bind_result($comment_cnt);
		$stmt->fetch();
		
		$stmt->close();
		
		if($story_cnt == 0){
			echo "<p class='one'>You never uploaded a story! </p><br><br>";
		}else{
			echo "<br><p class='one'>Stories:</p><br>";
    	
    		$stmt = $mysqli->prepare("select title, link, des, cate from story where username=?");
			if(!$stmt){
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
			}
 
			$stmt->bind_param('s', $username);
 
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
				echo "</p> <p class='two'>Category: ";
				echo htmlentities($row["cate"]);
				echo "</p><br>";
			}
 
			$stmt->close();
		}
		
		if($comment_cnt == 0){
			echo "<p class='one'>You never wrote a comment on any story! </p><br><br>";
		}else{
			echo "<br><p class='one'>Comments:</p><br>";
    	
    		$stmt = $mysqli->prepare("select comment, title, link from comment AS comment, story AS story where comment.story_id = story.id and comment.username=?");
			if(!$stmt){
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
			}
 
			$stmt->bind_param('s', $username);
 
			$stmt->execute();
 
    		$result = $stmt->get_result();
		
			while($row = $result->fetch_assoc()){
				echo "<p class='two'>";
				echo htmlspecialchars($row["comment"]);
				echo " </p> on  ";
				echo "<a href='";
        		echo htmlentities($row[link]); 
        		echo "'>";
        		echo htmlentities($row[title]); 
        		echo "</a><br>";
			}
 
			$stmt->close();
		}
		?>
		
		<a class='link' href='homepage.php'>Homepage</a>
    </body>
</html>