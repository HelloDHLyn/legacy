<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Cloud Intro</title>

	<!-- 장비 너비 기준 미디어 쿼리 -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" media="screen and (min-width:801px)" href="css/desktop.css">
	<link rel="stylesheet" media="screen and (min-width:481px) and (max-width:800px)" href="css/tablet.css">
	<link rel="stylesheet" media="screen and (max-width:480px)" href="css/mobile.css">
	<style>
		.container {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translateX(-50%) translateY(-50%);
		}

		label {
			text-align: center;
		}
	</style>
</head>
<body>
	<!-- 헤더 부분 시작 -->
	<header class="header-menu">
		<div class="header-container">
			<div class="logo-container">
				<h2 class="header-menu-title">CloudIntro</h2>
			</div>
			<div class="menu-container">
				<ul>
					<li><a href="index.php">HOME</a></li>
					<li><a href="directory.php">DIRECTORY</a></li>
					<li><a href="about.php">ABOUT ME</a></li>
				</ul>
			</div>
		</div>
	</header>

	<section>
		<div class="container">
			<form method="post" action="script/checkout.php">
				<p><label>아이디</label></p>
				<p><input type="text" name="login-id" id="login-id"></input></p>
				<p><label>비밀번호</label></p>
				<p><input type="password" name="login-password" id="login-id"></input></p>
				<p style="text-align: center;">
					<input type="submit" id="login-submit" style="height: 48px; width: 100px;" value="로그인" />
					<a href="./join.php"><input type="button" id="login-signup" style="height: 48px; width: 100px;" value="회원가입" /></a>
				</p>
			</form>
		</div>
	</section>
</body>