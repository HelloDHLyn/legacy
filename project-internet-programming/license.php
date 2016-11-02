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

	<style type="text/css">
		.section a {
			font-style: italic;
		}
	</style>

	<!-- 장비 너비 기준 미디어 쿼리 -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" media="screen and (min-width:801px)" href="css/desktop.css">
	<link rel="stylesheet" media="screen and (min-width:481px) and (max-width:800px)" href="css/tablet.css">
	<link rel="stylesheet" media="screen and (max-width:480px)" href="css/mobile.css">
</head>
<body>
	<!--헤더 시작 -->
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
	<!-- 헤더 종료 -->

	<!-- 본문 시작 / 가로 정렬 -->
	<article class="flex" id="license">
		<section class="section section-underline">
			<div>
				<div>
					<div style="padding: 32px;">
						<img src="assets/img/creative-commons.png" alt="creative commons" width="168" height="168" />
					</div>
					<div class="license-comment">
						<h2>Creative Commons</h2>
						<p>디렉토리의 모든 문서는 <a href="https://creativecommons.org/licenses/by-sa/3.0/">크리에이티브 커먼즈 저작자표시 - 동일조건변경허락 3.0</a>에 따라 인용, 재구성하였습니다.</p>
						<p>원 내용의 출처는 <a href="wikipedia.org">Wikipedia</a>(영문판, 한국어판, 일본어판)입니다.</p>
					</div>
				</div>
			</div>
		</section>

		<section class="section">
			<div>
				<div style="padding: 32px;">
					<img src="assets/img/photo.png" alt="icons" width="168" height="168" />
				</div>
				<h2>아이콘 및 일러스트</h2>
				<div class="license-comment">
					<p>Icons made by <a href="http://www.flaticon.com/authors/simpleicon" title="SimpleIcon">SimpleIcon</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC BY 3.0</a></p>
					<p><a href="http://icons8.com">Icon pack by Icons8</a>, licensed by <a href="http://creativecommons.org/licenses/by-nd/3.0/" title="Creative Commons BY 3.0">CC BY-ND 3.0</a></p>
				</div>
			</div>
		</section>
	</article>
	<!-- 본문 종료 -->

	<!-- 푸터 -->
	<footer class="footer">
		<div>
			<p>Copyright by Do Hoerin. <a href="license.php">라이선스 정보</a> <a href="admin.php">관리자 페이지</a></p>
		</div>
	</footer>
</body>
</html>