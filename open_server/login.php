<!DOCTYPE HTML>
<?php
	session_start();
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="style.css">
	<title>LYnLab Beta</title>
</head>
<body>
	<div class="header">
		<h1>로그인</h1>
	</div>
	<div class="section">
		<form name="login" action="checkout.php" method="post">
		<div style="text-align: center;">
			<p><input name="uid" type="text" placeholder="STUDENT ID"></p>
			<p><input name="upw" type="password" placeholder="PASSWORD"></p>
		</div>
		<div style="text-align: center;">
			<input type="submit" name="login" value="LOGIN">
		</div>
		</form>
	</div>
</body>
</html>
