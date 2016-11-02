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
	<!-- 헤더 부분 시작 -->
	<header class="header-menu">
		<div class="header-container">
			<div class="logo-container">
				<h2 class="header-menu-title">CloudIntro</h2>
			</div>
			<div class="menu-container">
				<ul>
					<li class="header-menu-selected"><a href="#">HOME</a></li>
					<li><a href="directory.php">DIRECTORY</a></li>
					<li><a href="about.php">ABOUT ME</a></li>
				</ul>
			</div>
		</div>
	</header>
	<!-- 헤더 부분 종료 -->

	<!-- 본문 부분 시작 -->
	<article>
		<!-- 메인 섹션 시작 -->
		<section class="section" style="background-color: #3498db; color: #ffffff;">
			<h2>Welcome to CloudIntro</h2>
			<p>CloudIntro는 클라우드 컴퓨팅에 대한 모든 정보를 모아둔 사이트입니다.</p>
			<div>
				<img src="assets/img/main-cloud.png" alt="cloud" width="256"/>
			</div>
			<p><a class="main-button transition dot-border" href="directory.html" style="color: #2980b9;">정보 보러가기</a></p>
		</section>
		<!-- 메인 섹션 종료 -->

		<!-- 페이지 특징 섹션 시작 -->
		<section class="section" id="main-section">
			<h2>CloudIntro의 특징</h2>
			<!-- 다중 컬럼 레이아웃, All icons by Icons8 -->
			<div class="multicolumns">
				<div class="columns-divider">
					<h3>직관적인 구성</h3>
					<img class="icon icons8-Gallery" alt="jikgwan" src="data:image/png;base64,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" width="64" height="64">
					<p>심플한 구성과 디자인을 통한<br/>직관적인 이용이 가능합니다.</p>
				</div>
				<div class="columns-divider">
					<h3>인쇄에 최적화된 문서</h3>
					<img class="icon icons8-Print" alt="print" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAEQElEQVR4Xu2d7XnTMBhFJWcA2g3KBLj2AJQJgAmADdoJGIFuAJ2AMgFdQKqZgDJB2wEU8ShN+qQmjhxxX8V2Lz+JdCWfY9mWP1StQP/quvagqFHGGGM0ouOQkNARCqEQxA4Jy+AIgaHEBA1eCKqDGFz4lPYhGrW9YucQVAfxKDGJFILhCEuhEBhKTBCFYDjCUigEhhITRCEYjrAUCoGhxARRCIYjLIVCYCgxQRSC4QhLoRAYSkwQhWA4wlIoBIYSE0QhGI6wFAqBocQEUQiGIyyFQmAoMUEUguEIS6EQGEpMEIVgOMJSKASGEhNEIRiOsBQKgaHEBGURUtf1B6XUqVKqxHSbKRECjVLq3BhzsSq3eC+rLMuD2Wz2kyL2tgM1zrk3TdPcLYTUdX1NGXuTsWq4McYc66qqPmqtv+69O+yA8t5/0htGx4Vz7jQMHzKSIxBOE0VRXGqtX6+10gQhTz60cc4dUoaciPXk5bn7dv3//hEy9Zek86Du30p7QFBIf3YiJSlEBGt6KIWksxOpSSEiWB9Cy7I8ms1mX7z3izsdWusw4Ttrmuamq1kKERISZBRFca21Plhvwnt/N5/Pj7ukUIiQkLquL5VSbzvifxhj3m36jUKEhFRVddseHaumvPc31tqXFCIEvwNsuLPxYtNv3vs/1tojCskrhIesjLyjTS2vsMLzjfYouXfOlTypRxHiCyylnLcue8ONWl724nHLJPIqS4ZrciqFJKOTqUghMlyTUykkGZ1MRQqR4ZqcSiHJ6GQqUogM1+RUCklGJ1ORQmS4JqeKCWkHJ/dwpBVT39ahECHhFCIENjWWQlLJCdUbvJDUDgrxgseiPtjJdg6hkH77AIX04xQtxRESRZS3AIXk5R1tjUKiiPIWoJC8vKOtUUgUUd4CkxFSVVX4Dv5z12uXebF2txZeklZKnVlrv20qNQkhy/eWfg8FeqwfQYq19pBCYqTy/X5vjHnyecGq6UmMkLAxI/ou/t57fzrpQ1a+HVu+pcmMEHlUeVqgkDyce7dCIb1R5SmYTUjq0hp9OziUeUhsnhHT2nd7t+VsmgaE1YAarfWrtYpXzrn3u6530qeDQ5uHbJtnSAtZrnPyXSl1smrLe/9LbHmmTQ+ohiZEKdU5z9hVSKx8n98XyzMt5wbtUdKn/tYyXU8MBzQP2TrPiAFAv/YURoe1tnxc4q8oiqvWoSvWpyQh/xU6oMpIIUHGfD4/eVzib7WdYe8Ni2AixDy3Z+op+0oQERbBXL8bwD9OnELyYZ3KJwu/oXZACnnuQoYyD4l5iM1TJjFCBnjZu9VLjuch7Q5kPWSNTci2ecokRgifh8QOlEplHSHx7oynxGRGyHiQb+8phQzMJIVQyG4EpPaY3XqRr7TU9vKknuiQQhLBSVWjECmyibmjE5K4naOtNvi7vaMlm9hxCkkEJ1WNQqTIJuaihPwFrfT3bEoGKcsAAAAASUVORK5CYII=" width="64" height="64">
					<p>디렉토리의 모든 문서들은 출력시<br/>자동으로 알맞게 최적화됩니다.</p>
				</div>
				<div class="">
					<h3>공개 라이선스</h3>
					<img class="icon icons8-Public" alt="license" src="data:image/png;base64,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" width="64" height="64">
					<p>페이지의 모든 문서, 이미지 등은<br />CC등 공개 라이센스가 적용됩니다.</p>
				</div>
			</div>
		</section>
		<!-- 페이지 특징 섹션 종료 -->
	</article>
	<!-- 본문 부분 종료 -->

	<!-- 푸터 -->
	<footer class="footer">
		<p>Copyright by Do Hoerin. <a href="license.php">라이선스 정보</a> <a href="admin.php">관리자 페이지</a></p>
	</footer>
</body>
</html>