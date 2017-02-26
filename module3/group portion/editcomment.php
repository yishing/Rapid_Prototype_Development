<!DOCTYPE html>
<html>
	<head>
	    <title>Edit Comment</title>
	    <link href="login.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<?php
		session_start();
		$id = $_GET['id'];
		$com = $_GET['com'];
		$_SESSION['id'] = $id;
		if($_SESSION['token'] !== $_GET['token']){
			die("Request forgery detected");
		}
		?>
		
		<form action="editcom" method="post">
			<p class='zero'>
   				<label>Comment:</label><br>
        		<textarea name="comment" style="width:700px;height:300px;" placeholder="<?php echo $com;?>"></textarea><br>
    			<input type="hidden" name="token" value="<?php session_start(); echo $_SESSION['token'];?>" />
    			<input type="submit" name="post" id="post" value="Submit"><br>
    		</p>
		</form>
		
	</body>
</html>