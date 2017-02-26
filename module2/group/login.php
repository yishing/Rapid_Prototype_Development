<!DOCTYPE HTML>
<html>
    <head>
        <title>Login</title>
        <link href="login.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    	<h1>
    	<form method="get">
    	<label> Username:</label>
    	<input type="text" name="username"><br>
    	<input type="submit" value="Login"/>
    	</form>
    	
		<?php
		session_start();

		if (!empty($_GET["username"])) {
			$username = $_GET["username"];
			$_SESSION["username"] = $username;
 			$h=fopen("../private/users.txt","r");
 			while( !feof($h) ) {
 				$candidate=fgets($h);
 				if (trim($candidate) == trim($username)) {
 		    		header("Location: Homepage.php");
 		    		exit;
 				}
 			}
 			fclose($h);
 			echo "<br>";
 			echo "invalid username";
		}
		?>
		</h1>	
    </body>
</html>