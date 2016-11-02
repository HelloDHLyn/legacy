<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>연세 수강신청 서포터 (α)</title>
	<link rel="icon" type="image/png" href="http://server2.lynlab.co.kr/favicon.png">
	<script src="/js/jquery.js"></script>
	<script src="/js/Chart.js"></script>
	<script src="/yonsei/js/script.js"></script>
	<script src="/dist/semantic.js"></script>
	<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
	<link rel="stylesheet" href="/dist/semantic.css">
	<link rel="stylesheet" href="/css/stylesheet.css">
</head>
<body>
	<?php
		$db_connect = mysqli_connect("localhost", "root", "MOregairu519!", "lynlab");
		if (mysqli_connect_error()) echo 'Fail to connect database.';
		mysqli_set_charset($db_connect, 'utf8');

		session_start();
	?>
	<div class="ui fixed inverted main menu">
		<div class="container">
			<?php
				$sql_query = "SELECT * FROM ys_topmenu WHERE type = 0;";
				$sql_result = $db_connect -> query($sql_query);
				$row = $sql_result -> fetch_assoc();

				echo "<div class=\"title item\" id=\"main-menu\"><a href=\"/yonsei/" . $row['link'] . "\"><b> " . $row['name'] . " </b></a></div>";

				$sql_query = "SELECT * FROM ys_topmenu WHERE type = 1 ORDER BY code;";
				$sql_result = $db_connect -> query($sql_query);
				$row_num = $sql_result -> num_rows;

				for ($i = 0; $i < $row_num; $i++) {
					$row = $sql_result -> fetch_assoc();
					echo "<div class=\"item\"><a href=\"/yonsei/" . $row['link'] . "\"> " . $row['name'] . " </a></div>";
				}

				echo "<div class=\"right menu\">";

				if (!isset($_SESSION['ys_usercode']))
					$sql_query = "SELECT * FROM ys_topmenu WHERE code = 201 ORDER BY code;";
				else
					$sql_query = "SELECT * FROM ys_topmenu WHERE code = 202 ORDER BY code;";

				$sql_result = $db_connect -> query($sql_query);
				$row_num = $sql_result -> num_rows;

				for ($i = 0; $i < $row_num; $i++) {
					$row = $sql_result -> fetch_assoc();
					echo "<div class=\"item\"><a href=\"" . $row['link'] . "\"> " . $row['name'] . " </a></div>";
				}

				echo "</div>";
			?>
			</div>
		</div>
	</div>
	<div class="main container">
		<?php
			$uid = $_GET['id'];
			if ($uid == 'me') {
				$sql_query = "SELECT * FROM ys_member WHERE code = '" . $_SESSION['ys_usercode'] . "';";
				$sql_result = $db_connect -> query($sql_query);
				$row = $sql_result -> fetch_assoc();
				$uid = $row['id'];
				$uname = $row['name'];
			}
		?>
		<div class="ui segment">
			<h1 class="left floated header">프로필</h1>
			<div class="ui clearing divider"></div>	
		</div>
		<div class="ui segment">
			<h1 class="left floated header">시간표</h1>
			<div class="ui clearing divider"></div>
			<table class="ui six column celled unstackable definition table">
				<thead>
					<tr>
						<th></th>
						<th>월</th>
						<th>화</th>
						<th>수</th>
						<th>목</th>
						<th>금</th>
					</tr>
				</thead>
				<tbody>
					<?php
						for ($i = 1; $i <= 14; $i++) {
							echo "<tr>";
							echo "<td>" . $i . "교시</td>";
							for ($j = 1; $j < 6; $j++) {
								echo "<td id=\"cell-" . $j . $i . "\"></td>";
							}
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
		</div>
		<?php
		if ($uid == 'admin') {
		?>
		<script>setTableSample();</script>
		<?php
		}
		?>

	</div>
</body>