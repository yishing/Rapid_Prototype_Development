<!DOCTYPE html>
<html>
	<head>
		<title>Upload Story</title>
		<link href="login.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
    	<form action="insertstory.php" method="post">
    		<p class='zero'>
        		<label>Title:</label><br>
        		<input type="text" name="title"><br>
        		<label>Link:</label><br>
        		<input type="text" name="link"><br>
        		<label>Description:</label><br>
        		<textarea name="description" style="width:700px;height:300px;"></textarea><br>
        		<label>category:</label>
        		<input type="radio" name="symbol" value="news">News
        		<input type="radio" name="symbol" value="sports">Sports
       	 		<input type="radio" name="symbol" value="culture">Pop Culture
        		<input type="radio" name="symbol" value="other">Other<br>
        		<input type="hidden" name="token" value="<?php session_start(); echo $_SESSION['token'];?>" />
        		<input type="submit" value="Upload"><br>
        	</p>
    	</form>
    	
    	<a class='link' href='homepage.php'>Homepage</a>
	</body>
</html>