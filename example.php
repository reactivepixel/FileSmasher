<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Interesting blog</title>
		<?php
		/* 	Usage */
			require_once('combine.php');
		 	$aryCombine = fileSmash(array("styleOne.css","jsOne.js","styleTwo.css", "jsTwo.js")); 
		 	echo "<style type='text/css'>";
			echo $aryCombine['css'];
		 	echo "</style>";
		 
		 	echo "<script type='text/javascript'>";
			echo $aryCombine['js'];
		 	echo "</script>";
		?>
	</head>
	<body>
		<div class="styleOne">
			<p class="styleTwo">Hello World</p>
		</div>
	</body>
</html>