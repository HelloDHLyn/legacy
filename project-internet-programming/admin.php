<?php
	session_start();

	if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 'admin') {
		?>
		<script>alert("이 페이지는 관리자만 이용할 수 있습니다.")</script>
		<meta http-equiv="refresh" content="0; url=./index.php">
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
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">

	<script src="js/jquery.js"></script>
	<script src="js/script.js"></script>
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
					<li><a href="index.html">HOME</a></li>
					<li><a href="directory.html">DIRECTORY</a></li>
					<li><a href="about.html">ABOUT ME</a></li>
				</ul>
			</div>
		</div>
	</header>
	<!-- 헤더 종료 -->

	<!-- 본문 시작-->
	<article>
		<section class="section" style="text-align: left;">
			<h2>회원 목록 백업(XML)</h2>
			<p>회원 목록을 XML 파일 형식으로 백업할 수 있습니다.</p>
			<p><a href="script/backup.php">여기를 눌러 백업을 시작하세요.</a></p>
		</section>

		<section class="section" style="text-align: left;">
			<h2>실시간 회원 현황</h2>
			<table class="pure-table" style="font-size: 90%;">
				<thead>
					<td>#</td>
					<td>ID</td>
					<td>이름</td>
					<td>주소</td>
					<td>생년월일</td>
					<td>전화번호</td>
					<td>동작</td>
				</thead>
				<tbody>
				<?php
				$db_connect = mysql_connect("localhost", "u2014147575", "u2014147575") or die("fail");
				mysql_set_charset($db_connect, "utf8");
				mysql_select_db("db_u2014147575", $db_connect);

				$query = "SELECT * FROM db_member WHERE id != 'admin' ORDER BY member_code;";
				$result = mysql_query($query);
				$num = mysql_num_rows($result);

				for ($i = 0; $i < $num; $i++) {
					echo '<tr>';
					$list = mysql_fetch_assoc($result);
					echo '<td>' . $list['member_code'] . '</td>';
					echo '<td>' . $list['id'] . '</td>';
					echo '<td>' . $list['name'] . '</td>';
					echo '<td>' . $list['address1'] . '</td>';
					echo '<td>' . $list['birthday'] . '</td>';
					echo '<td>' . $list['phonenumber'] . '</td>';
					echo '<td><a href="javascript:deleteMemberByCode(' . $list['member_code'] . ')"><span>삭제</span></a></td>';
					echo '</tr>';
				}
				?>
			</table>
		</section>
	</article>

	<!-- 푸터 -->
	<footer class="footer">
		<p>Copyright by Do Hoerin. <a href="license.php">라이선스 정보</a> <a href="admin.php">관리자 페이지</a></p>
	</footer>

</body>