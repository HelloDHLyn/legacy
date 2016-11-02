<!DOCTYPE html>
<html lang="ko-KR">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>LYnLab Open Server</title>
	<link rel="icon" type="image/png" href="http://server2.lynlab.co.kr/favicon.png">
	<link rel="stylesheet" href="dist/semantic.css">
	<!-- <link rel="stylesheet" href="style.css"> -->
	<script src="dist/jquery.js"></script>
	<script src="dist/semantic.js"></script>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<style>
	@media screen and (min-width: 800px) {
		.container {
			width: 800px;
			margin: 0 auto;
		}

		code {
			width: 800px;
			word-wrap: break-word;
		}
	}
	</style>
</head>
<body style="padding: 8px;">
	<?php
		$db_connect = mysqli_connect("localhost", "root", "MOregairu519!", "lynlab");
		if(mysqli_connect_error()) {
			echo 'Fail to connect database.';
		}
		mysqli_set_charset($db_connect, 'utf8');
	?>
	<div class="ui fixed inverted main menu">
		<div class="container">
			<div class="title item">
				<a href="./index.php"><b>Open Server</b></a>
			</div>
			<div class="right menu">
				<div class="ui item" id="login"><a href="./files.php">나의 파일 보기</a></div>
			</div>
		</div>
	</div>
	<div class="main container" style="margin-top: 48px;">
		<div class="ui segment">
			<h1 class="left floated header">회원 유형 선택</h1>
			<div class="ui clearing divider"></div>
			<div class="ui grid">
				<div class="ui five wide column">
					<div class="ui center aligned segment">
						<h1>보통 계정</h1>
						<div class="ui statistic">
							<div class="value">20</div>
							<div class="label">MB Storage</div>
						</div>
						<div class="ui divider"></div>
						<div class="ui statistic">
							<div class="value"><i class="dollar icon"></i> 0.49</div>
							<div class="label">Monthly</div>
						</div>
						<div class="ui divider"></div>
						<div class="ui button">준비중</div>
					</div>
				</div>
				<div class="six wide column">
					<div class="ui center aligned segment">
						<h1>학생용 계정</h1>
						<div class="ui statistic">
							<div class="value">50</div>
							<div class="label">MB Storage</div>
						</div>
						<div class="ui divider"></div>
						<div class="ui statistic">
							<div class="value">Free</div>
							<div class="label">Monthly</div>
						</div>
						<div class="ui divider"></div>
						<div class="positive ui button">선택</div>
					</div>
				</div>
				<div class="five wide column">
					<div class="ui center aligned segment">
						<h1>대용량 계정</h1>
						<div class="ui statistic">
							<div class="value">100</div>
							<div class="label">MB Storage</div>
						</div>
						<div class="ui divider"></div>
						<div class="ui statistic">
							<div class="value"><i class="dollar icon"></i> 0.99</div>
							<div class="label">Monthly</div>
						</div>
						<div class="ui divider"></div>
						<div class="ui button">준비중</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>