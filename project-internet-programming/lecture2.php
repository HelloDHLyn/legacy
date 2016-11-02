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
					<li><a href="about.php">ABOUT ME</a></li>
				</ul>
			</div>
		</div>
	</header>
	<!-- 헤더 종료 -->

	<!-- 본문 시작 -->
	<article>
		<section style="background-color: #2c3e50">
			<div class="lecture">
				<h3>2. 클라우드 컴퓨팅의 특징</h3>
				<h4>2.1 이용되는 기술</h4>
				<h4>2.2 장점</h4>
				<p>클라우드 서비스의 사용자는 자신의 컴퓨터나 하드웨어, 소프트웨어, 장비 등을 직접 보유, 설계, 개발하거나 관리할 필요가 없어지고, 네트워크에 접속하면 언제 어디서나 자신의 데이터에 접근할 수 있다. 특히 클라우드 컴퓨팅을 이용하여 플랫폼을 구축하면, 서비스를 시작하기 위한 초기 비용을 줄여 서비스 자체를 저렴하게 제공하여 경쟁력을 확보할 수 있는 밑바탕으로 이어진다. 또한 관련 회사나 제휴 업체 사이의 표준화 및 데이터 연계 등이 쉽게 가능하다. 한편 서비스 업체는 자원의 활용도 향상 등을 통해 비용 절감 및 상대적으로 저렴한 서비스 요금을 설정이 가능하다.</p>

				<h4>2.3 문제점</h4>
				<p>반면, 위에서 언급한 경제성은 서비스 업체의 인프라, 올바른 수요 예측 등이 충분한 기반이 되어야한다. 업체는 하드웨어 및 장비를 구입하는 시점부터 유지 관리 비용이 발생하며, 수요 예측이 잘못되면 인프라가 부족해지거나 비용이 과잉 부담되는 문제가 생긴다. 따라서 대규모의 경제적 효과는 얻을 수 있을지 모르겠으나, 이것이 기존의 아웃 소싱에 비해 경제적 측면에서 효과적이라고 할 수 있을 지는 재고해볼 필요가 있다.</p>
			</div>

			<div class="lecture">
				<i><a href="directory.php">목차로 돌아가기</a></i>
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