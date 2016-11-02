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
					<li class="header-menu-selected"><a href="directory.php">DIRECTORY</a></li>
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
				<h3>3. 관련 정보</h3>
				<h4>3.1 서비스 업체</h4>
				<strong>아마존 웹 서비스(AWS)</strong>
				<p class="img-container"><img src="assets/img/aws.png" alt="aws.png"></p>
				<p>아마존 웹 서비스는, 본래 인터넷 서점 사이트였던 <a href="http://amazon.com/">아마존</a>이 피크 시기에 비해 상대적으로 여유로운 서버 자원을 팔자는 의도로 시작한 서비스이다. 웹 서비스에 필요한 대부분의 기능을 지원하며, 이러한 기능들은 모두 API로 제어한다. API의 호출은 HTTP나 SOAP으로 이루어지며, Java, Python, PHP, Ruby 등에서 사용할 수 있는 라이브러리와 샘플 코드도 제공한다. 애플의 iCloud 또한 AWS를 이용하고 있는 것으로 유명하다. 다만 국내에는 아마존 데이터 센터가 없어 다소 성능이 떨어지는 경향이 있다.</p>

				<strong>Microsoft Cloud Platform</strong>
				<p class="img-container"><img src="assets/img/azure.png" alt="azure.png"></p>
				<p>Microsoft Cloud Platfrom은 기존의 IaaS, PaaS 뿐만 아니라, CRM, Exchange, SharePoint, Office 등의 다양한 소프트웨어를 서비스하고, Xbox나 Windows Live와 같은 애플리케이션 서비스도 제공한다. 그 중에서도 플랫폼 서비스인 Azure가 PaaS 서비스이며 Apache Hadoop과 함께 클라우드 컴퓨팅 시장의 원조 서비스를 양분하던 것 중 하나이다.</p>
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