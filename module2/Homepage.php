<!DOCTYPE HTML>
<html>
    <head>
        <title>Homepage</title>
        <link href="file.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    	
		<?php
		session_start();
 
		$username = $_SESSION["username"];
		echo "<h1>";
		echo "Welcome!\t";
		echo htmlentities($username);
		echo "</h1>";
		$dir = ('/srv/uploads/' . $username);
    	$files = scandir($dir);
    	$num = count($files);
    	if($num<=2){
    		echo "<h2>";
    		echo "<br>";
    		echo "No file uploaded";
    		echo "</h2>";
    	}else{
    		for ($i=2; $i<$num; $i++) {
    		echo "<h2>";
    		echo "<br>";
        	echo htmlentities($files[$i]);
        	echo "<br>";
        	echo "<a href='view.php?file=$files[$i]'> View </a>";
        	echo "<a href='delete.php?file=$files[$i]'> Delete</a>";
        	echo "<br>";
        	echo "</h2>";
    		}
    	}
		?>
		<h3>
		<form enctype="multipart/form-data" action="uploader.php" method="POST">
			<p>
				<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
				<label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" /><br>
				<input type="submit" value="Upload" />
			</p>
		</form>
		
		<br><a href="logout.php">Logout</a>
		</h3>
    </body>
</html>	