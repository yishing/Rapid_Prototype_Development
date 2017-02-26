<!DOCTYPE HTML>
<html>
    <head>
        <title>Login</title>
        <link href="login.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    	<form action="login.php" method="POST">
    		<p class='zero'>
    			<label>Username:</label>
    			<input type="text" name="username">
    			<label>Password:</label>
				<input type="password" name="password">
    			<input type="submit" value="Login"/><br>
    		</p>
    	</form>
    	
    	<p class='two'>
    		<label>Have no account? Click</label>
    		<a class='link' href='signin.php'>here</a>
    		<br>
    		<label>Visit as a visitor? Click</label>
    		<a class='link' href='homepage.php'>here</a>
    	</p>
    	
    	<?php
		session_start();
		
		require 'database.php';
		
		if (!empty($_POST["username"])) {
			$user=$_POST["username"];
			$stmt = $mysqli->prepare('select count(*), id, crypted_password from user where username=?');

			//Bind the parameter
			$stmt->bind_param('s', $user);
			$stmt->execute();

			// Bind the results
			$stmt->bind_result($cnt, $user_id, $pwd_hash);
			$stmt->fetch();
			$pwd_guess = $_POST["password"];
			if($cnt == 1 && crypt($pwd_guess, $pwd_hash) == $pwd_hash) {
				$_SESSION['username'] = $user;
				$_SESSION['token'] = substr(md5(rand()), 0, 10);
			    header("location: homepage.php");
			    exit;
			}
			echo "<br>";
			echo "<p><label>Invaild username or password!</label></p>";
		}
		?>
    </body>
</html>