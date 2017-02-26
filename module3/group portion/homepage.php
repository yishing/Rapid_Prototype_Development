<!DOCTYPE HTML>
<html>
    <head>
        <title>Homepage</title>
        <link href="login.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    	
    	<?php
		session_start();
		
		require 'database.php';
		
		if (!preg_match('/^[\w_\-]+$/', $_SESSION["username"])){
			echo "<a class='link' href='login.php'>Login</a>";
			echo " or ";
			echo "<a class='link' href='signin.php'>Sign in</a>";
		}else{
			echo "<p class='zero'>welcome! ";
			echo htmlentities($_SESSION["username"]);
			echo "</p>";
		}
		
		?>

<!-- 		Filter by category -->
		<form method="get">
			<p class='zero'>
				<label>Filter:</label>
				<input type="radio" name="symbol" value="all">All
       			<input type="radio" name="symbol" value="news">News
        		<input type="radio" name="symbol" value="sports">Sports
       			<input type="radio" name="symbol" value="culture">Pop Culture
        		<input type="radio" name="symbol" value="other">Other
        		<input type="submit" value="Search"><br>
        	</p>
        </form>

		<?php
		session_start();
		
		require 'database.php';
		
		//List user operations
		if(preg_match('/^[\w_\-]+$/', $_SESSION["username"])){
			echo "<a class='link' href='story.php'>Upload a story</a><br>";
			echo "<a class='link' href='logout.php'>Logout</a><br>";
			echo "<a class='link' href='profilepage.php'>Profile Page</a><br>";
		}
		
		$_SESSION["symbol"] = $_GET["symbol"];
				
		$symbol = $_SESSION["symbol"];
		
		//List the title, description, author and category of the stories
		if($symbol == "all" || empty($symbol)){
			$stmt = $mysqli->prepare("select id, title, link, des, username, cate from story");
   			if(!$stmt){
    			printf("Query Prep Failed: %s\n", $mysqli->error);
	   			exit;
    		}
    	} else {
    		$stmt = $mysqli->prepare("select id, title, link, des, username, cate from story where cate=?");
   			if(!$stmt){
    			printf("Query Prep Failed: %s\n", $mysqli->error);
	   			exit;
    		}
    		
    		$stmt->bind_param('s', $symbol);
    	}
 
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
	        echo "<p class='two'>category:  ";
	        echo htmlentities($row["cate"]);
	        echo "<br></p>";
	        if(!$_SESSION["username"]){
				echo "<a class='link' href='viewcomment.php?id=";
				echo htmlentities($row[id]);
				echo "'>View comments</a><br>";
			} else {
				echo "<a class='link' href='comment.php?id=";
				echo htmlentities($row[id]);
				echo "'>Comment</a>";
			}
			if ($_SESSION["username"] == $row["username"]){
				echo "<br><a class='link' href='deletestory.php?id=";
				echo htmlentities($row[id]);
				echo "&token=";
				echo htmlentities($_SESSION['token']);
				echo "'>  delete</a>";
				echo "<a class='link' href='editstory.php?id=";
				echo htmlentities($row[id]);
				echo "&des=";
				echo htmlentities($row["des"]);
				echo "&title=";
				echo htmlentities($row[title]);
				echo "&token=";
				echo htmlentities($_SESSION['token']);
				echo "'>  edit</a>";
			}
			echo "<br>";
    	}  
 
    	$stmt->close();
		
		?>
		
    </body>
</html>
