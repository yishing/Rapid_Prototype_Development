<!DOCTYPE HTML>
<html>
    <head>
        <title>Signin</title>
        <link href="login.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    	<form method="POST">
    		<p class='zero'>
    			<label> Username:</label>
    			<input type="text" name="username"><br>
    			<label>Password:</label>
				<input type="password" name="password"><br>
    			<input type="submit" value="Sign in"/><br>
    		</p>
    	</form>
    	
    	<p class='two'>
    		<label>Already Have account? Click</label>
    		<a class='link' href='login.php'>here</a>
    		<br>
    		<label>Visit as a visitor? Click</label>
    		<a class='link' href='homepage.php'>here</a>
    	</p>
    	
    	<?php
		session_start();
		
		require 'database.php';
		
		if (!empty($_POST["username"]) && isset($_POST["username"]) && !empty($_POST["password"]) && isset($_POST["password"])) {
			$_SESSION['token'] = substr(md5(rand()), 0, 10);
			$user=$_POST["username"];
			$stmt = $mysqli->prepare('select count(*), id, crypted_password from user where username=?');

			//Bind the parameter
			$stmt->bind_param('s', $user);
			$stmt->execute();

			// Bind the results
			$stmt->bind_result($cnt, $user_id, $pwd_hash);
			$stmt->fetch();
			$password = $_POST["password"];
			if($cnt == 1) {
				echo "Username already exists!";
				exit;
			}
			$stmt->close();
			if($cnt < 1) {
				$stmt = $mysqli->prepare("insert into user (username, crypted_password) values(?,?)");
				if(!$stmt){
					printf("Second Query Prep Failed: %s\n", $mysqli->error);
					exit;
				}
				$stmt->bind_param('ss', $user, crypt($password));
				$stmt->execute();
				$stmt->close();
				$_SESSION['username'] = $user;
			    header("location: homepage.php");
			    exit;
			}
			echo "<br>";
			echo "Invaild username or password!";
		}
		?>
    </body>
</html>