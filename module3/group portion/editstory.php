<!DOCTYPE html>
<html>
	<head>
	    <title>Edit Story</title>
	    <link href="login.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<?php
		session_start();
		$id = $_GET['id'];
		$des = $_GET['des'];
		$title = $_GET['title'];
		$_SESSION['id'] = $id;
		if($_SESSION['token'] !== $_GET['token']){
			die("Request forgery detected");
		}
		?>
		<form action="editdes.php" method="post">
			<p class='zero'>
				<label>Title:</label><br>
        		<input type="text" name="title" placeholder="<?php echo $title;?>"><br>
   				<label>Description:</label><br>
        		<textarea name="description" style="width:700px;height:300px;" placeholder="<?php echo $des;?>"></textarea><br>
    			<input type="hidden" name="token" value="<?php session_start(); echo $_SESSION['token'];?>" />
    			<input type="submit" name="post" id="post" value="Submit"><br>
    		</p>
		</form>
		
		<a class='link' href='homepage.php'>Homepage</a>
	</body>
</html>