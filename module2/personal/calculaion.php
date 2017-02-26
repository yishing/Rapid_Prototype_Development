<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">

<title>zlatan's calculator's answer</title>
<link rel="stylesheet" type="text/css" href="calculaion.css">
</head>
<body>
<?php
	$numF=$_GET['firstNumber'];
	$numS=$_GET['secondNumber'];
	$OPE=$_GET['opp'];
	echo"<br>";
	if($_GET['opp']=='addop'){
	    echo "<h1>";
		echo "Your ANSWER is";
		echo "</h1>";
		echo"<br>";
		echo "<h2>";
		echo  $numF + $numS;
		echo "</h2>";
	}
	else if($_GET['opp']=='subtractop'){
		echo "<h1>";
		echo "Your ANSWER is";
		echo "</h1>";
		echo"<br>";
		echo "<h2>";
		echo  $numF-$numS;
		echo "</h2>";
	}
	else if($_GET['opp']=='multiplyop'){
		echo "<h1>";
		echo "Your ANSWER is";
		echo "</h1>";
		echo"<br>";
		echo "<h2>";
		echo $numF*$numS;
		echo "</h2>";
	}
	else if($_GET['opp']=='divideopp'){
		if($numS==0){
		echo "<h2>";
		echo"Hey dude, Did't your primary school teacher tell you not to divide by 0?";
		echo "</h2>";
		}
		else{
		echo "<h1>";
		echo "Your ANSWER is";
		echo "</h1>";
		echo"<br>";
		echo "<h2>";
		echo $numF/$numS;
		echo "</h2>";
		}
	}
	
	
	?>
</body>
</html>
	
	
