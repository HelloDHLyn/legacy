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
					<li><a href="about.php">ABOUT ME</a></li></ul>
			</div>
		</div>
	</header>
	<!-- 헤더 종료 -->

	<!-- 본문 시작 -->
	<article>
		<section id="lecture-section">
			<div class="lecture lecture-notice">
				<p><strong>ⓘ 안내</strong> : 본 페이지는 인쇄에 최적화된 형태를 제공합니다.</p>
			</div>

			<div class="lecture">
				<h3>1. 클라우드 컴퓨팅 개요</h3>
				<h4>1.1 정의</h4>
				<p> 클라우드 컴퓨팅은 인터넷 기반의 컴퓨팅 기술의 한 종류이다. 흔히 <strong>구름</strong>으로 표현되는 인터넷 상의 데이터 서버에 프로그램을 두고, 필요시 컴퓨터나 스마트폰 등의 클라이언트 디바이스로 필요한 정보를 불러와 사용하는 방식의 컴퓨팅을 뜻한다.</p>
				<h4>1.2. 역사</h4>
				<p> <strong>클라우드 컴퓨팅</strong>(Cloud computing)이라는 단어는 2006년 Google의 CEO인 에릭 슈미트의 발언에서 처음 사용한 것으로 알려져있다. 이는 Google App Engine이나 Amazon EC2와 같이 2006년에서 2008년 사이에 등장한 서비스들을 지칭한 것이다. 하지만, &apos;컴퓨터 처리를 네트워크를 통한 서비스로 제공한다&apos;는 개념 자체는 이전부터 존재했다. 1960년부터 타임 쉐어 시스템과 같은 데이터 센터 이용, 1980년대의 VAN, 1991년 부터의 인터넷 기반 ASP등이 현재의 클라우드 컴퓨팅과 유사한 개념이다.</p>
				<h4>1.3. 사용 용어</h4>
				<div class="img-container">
					<p style="text-align: center; font-size: 80%"><a href="http://commons.wikimedia.org/wiki/File:Cloud_computing-ko.svg#/media/File:Cloud_computing-ko.svg"><img src="http://upload.wikimedia.org/wikipedia/commons/3/3a/Cloud_computing-ko.svg" alt="Cloud computing-ko.svg"></a><br><a href="http://commons.wikimedia.org/wiki/">위키미디어 공용</a>에 의해 <a href="http://creativecommons.org/licenses/by-sa/3.0" title="Creative Commons Attribution-Share Alike 3.0">CC BY-SA 3.0</a>으로 라이선스됨.</p>
				</div>
				<p><strong>클라우드</strong>, 즉 구름이라는 용어는 이 기술을 비유적으로 표현한 것이다. 클라이언트 사용자와 서버 사이에는 네트워크의 연결이 분명히 존재하지만, 이용자는 서버가 어떻게 구성되어있는지, 서버까지의 네트워크는 어떻게 연결되어있는지 등을 알 방법도, 알 필요도 없다. 이러한 점을 구름에 비유한 것이다.</p>
			</div>

			<div class="lecture">
				<p><i><a href="directory.php">목차로 돌아가기</a></i></p>
			</div>
		</section>
	</article>
	<!-- 본문 종료 -->

	<!-- 플로팅 바 -->
	<aside>
		<div class="sidebar-container">
			<a href="directory.php">
				<p class="sidebar-content"><img src="assets/img/back.png" alt="go-back" height="48" width="48"></p>
				<p class="sidebar-content" style="color: white;">BACK</p>
			</a>
		</div>
	</aside>

	<!-- 푸터 -->
	<footer class="footer">
		<p>Copyright by Do Hoerin. <a href="license.php">라이선스 정보</a> <a href="admin.php">관리자 페이지</a></p>
	</footer>
</body>
</html>