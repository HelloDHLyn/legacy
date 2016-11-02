<?php
	session_start();

	if (!isset($_SESSION['user_id'])) {
		?>
		<script>alert("로그인 후 이용하실 수 있습니다.")</script>
		<meta http-equiv="refresh" content="0; url=./login.php">
		<?php
	}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Cloud Intro</title>

	<!-- 목차 리스트의 구분점 제거 -->
	<style type="text/css">
		li {
			list-style-type: none;
		}
	</style>

	<!-- 장비 너비 기준 미디어 쿼리 -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" media="screen and (min-width:801px)" href="css/desktop.css">
	<link rel="stylesheet" media="screen and (min-width:481px) and (max-width:800px)" href="css/tablet.css">
	<link rel="stylesheet" media="screen and (max-width:480px)" href="css/mobile.css">
</head>
<body>
	<!-- 헤더 시작 -->
	<header class="header-menu">
		<div class="header-container">
			<div class="logo-container">
				<h2 class="header-menu-title">CloudIntro</h2>
			</div>
			<div class="menu-container">
				<ul>
					<li><a href="index.php">HOME</a></li>
					<li class="header-menu-selected"><a href="#">DIRECTORY</a></li>
					<li><a href="about.php">ABOUT ME</a></li>				</ul>
			</div>
		</div>
	</header>
	<!-- 헤더 종료 -->

	<!-- 본문 시작 -->
	<article>
		<section>
			<h2>목차</h2>
			<nav class="nav-lecture dot-border" style="text-align: left;">
				<ul>
					<li><a href="lecture1.php">1. 클라우드 컴퓨팅 개요</a></li>
					<li>
						<ul>
							<li>1.1. 정의</li>
							<li>1.2. 역사</li>
							<li>1.3. 사용 용어</li>
						</ul>
					</li>
					<li><a href="lecture2.php">2. 클라우드 컴퓨팅의 특징</a></li>
					<li>
						<ul>
							<li>2.1. 이용되는 기술</li>
							<li>2.2. 장점</li>
							<li>2.3. 문제점</li>
						</ul>
					</li>
					<li><a href="lecture3.php">3. 관련 정보</a></li>
					<li>
						<ul>
							<li>3.1. 서비스 업체</li>
						</ul>
					</li>
				</ul>
			</nav>	
		</section>
	</article>
	<!-- 본문 종료 -->

	<!-- 푸터 -->
	<footer class="footer">
		<p>Copyright by Do Hoerin. <a href="license.php">라이선스 정보</a> <a href="admin.php">관리자 페이지</a></p>
	</footer>
</body>
</html>