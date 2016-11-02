<?php
	session_start();
#	if(!isset($_SESSION['ys_usercode'])) {
#		echo "<script>alert(\"로그인 후 이용하실 수 있습니다.\");</script>";
#		echo "<meta http-equiv='refresh' content='0; url=http://yonsei.lynlab.co.kr/'>";
#	}
	if(isset($_GET['hakno'])) $hakno = $_GET['hakno'];
		else $hakno = "CSI2101";
	if(isset($_GET['class'])) $class = $_GET['class'];
		else $class = "01";
	if(isset($_GET['exer'])) $exer = $_GET['exer'];
		else $exer = "00";
	$complete_class = $hakno . '-' . $class . '-' . $exer;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>연세 수강신청 서포터 (α)</title>
	<link rel="icon" type="image/png" href="http://server2.lynlab.co.kr/favicon.png">
	<script src="../js/jquery.js"></script>
	<script src="../js/Chart.js"></script>
	<script src="../dist/semantic.js"></script>
	<script src="js/script.js"></script>
	<link rel="stylesheet" href="../dist/semantic.css">
	<link rel="stylesheet" href="../css/stylesheet.css">
	<style>
	@media screen and (min-width: 1000px) {
		#myChart {
			width: 500px;
		}
	}
	</style>
</head>
<body>
	<?php
		$db_connect = mysqli_connect("localhost", "root", "MOregairu519!", "lynlab");
		if (mysqli_connect_error()) echo 'Fail to connect database.';
		mysqli_set_charset($db_connect, 'utf8');
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
		<div class="ui segment">
			<h1>강의 찾기</h1>
			<div class="ui top attached tabular menu">
				<a class="active item" data-tab="1">강의 정보로</a>
				<!-- <a class="item" data-tab="2">분류로</a> -->
				<a class="item" data-tab="3">직접 입력...</a>
			</div>
			<div class="ui bottom attached active tab segment" data-tab="1">
				<div class="ui icon message">
					<i class="info circle icon"></i>
					<div class="content">
						<div class="header">DB 구축중!</div>
						<p>현재 공과대학, 교양(2010~) 과목만 검색이 가능합니다.</p>
					</div>
				</div>
				<div class="ui search" id="find-course">
					<div class="ui fluid action input">
						<input class="prompt" type="text" placeholder="강의명 / 교수명으로 찾기"/>
						<button class="ui icon button">
							<i class="search icon"></i>
						</button>
					</div>
					<div class="results"></div>
				</div>
			</div>
			<div class="ui bottom attached tab segment" data-tab="2">

			</div>
			<div class="ui bottom attached tab segment" data-tab="3">
				<p>학정 번호를 아래 양식에 맞게 직접 입력해주세요.</p>
				<div class="ui fluid action input">
					<input class="prompt" type="text" placeholder="ABC1001-01-00" id="user-hakno"/>
					<button class="ui icon button" onclick="search()">
						<i class="search icon"></i>
					</button>
				</div>
				<h4>이런 과목도 찾아보세요</h4>
				<p>
					<a href="search.php?hakno=CSI2101&class=01&exer=00">이산구조</a> | 
					<a href="search.php?hakno=ECO1001&class=01&exer=00">경제학입문</a> | 
					<a href="search.php?hakno=YCF1652&class=01&exer=00">수화</a>
				</p>
			</div>
			<script>
			var data;
			var test;

			$('.menu .item').tab();

			$.ajax({	
				dataType: "json",   
				url: "script/getcourse.php", 
				data: data, 
				success: function(data) { 
					test = data;
					$('#find-course').search({
						source: data.results
					});
				}   
			}).error(function(XMLHttpRequest, textStatus, errorThrown) { 

			}).complete(function() { 

			});		
			</script>
		</div>

		<div class="ui top attached tabular menu">
			<a class="item" data-tab="101">강의 정보</a>
			<a class="active item" data-tab="102">마일리지 분석</a>
			<a class="item" data-tab="103">강의평가</a>
		</div>
		<div class="ui bottom attached active tab segment" data-tab="102">
			<h1>마일리지 분석</h1>
			<div class="ui clearing divider"></div>
			<ul id="info">

			</ul>
			<h1>1차 모의 신청 결과</h1>
			<div style="text-align: center;">
				<table class="ui table">
					<thead>
						<tr>
							<th>비례 정원</th>
							<th>신청 인원</th>
							<th>신청률</th>
							<th>커트라인 마일리지</th>
							<th>평균 마일리지</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td id="max_num"></td>
							<td id="course_num"></td>
							<td id="percentage"></td>
							<td id="cutline">인원 미달</td>
							<td id="average"></td>
						</tr>
					</tbody>
				</table>
				<canvas id="myChart"></canvas>
			</div>
			<h2>신청자 현황</h2>
			<div style="text-align: center">
				<div style="text-align: center;">
				<table class="ui definition table">
					<thead>
						<tr>
							<th></th>
							<th>신청 인원 (명)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1학년</td>
							<td id="grade1"></td>
						</tr>
						<tr>
							<td>2학년</td>
							<td id="grade2"></td>
						</tr>
						<tr>
							<td>3학년</td>
							<td id="grade3"></td>
						</tr>
						<tr>
							<td>4학년</td>
							<td id="grade4"></td>
						</tr>
						<tr>
							<td>5학년 이상</td>
							<td id="grade5"></td>
						</tr>
					</tbody>
				</table>
				<canvas id="pChart" width="300" height="300"></canvas>
			</div>
			<script charset="euc-kr">
			$('.menu .item').tab();

			initData();

			var loaderUrl = "script/getdata.php?hakno=" + <?='"'.$hakno.'&class='.$class.'&exer='.$exer.'"'?>;

			<?php
			if (!file_exists('data/' . $hakno . '-' . $class . '-' . $exer . '.dt'))
				echo "$.get(loaderUrl).done(function(data) { showResults(); });";
			?>

			showResults();

			function showResults() {
				$.ajax({
					url: "data/" + <?='"' . $hakno . '-' . $class . '-' . $exer . '"'?> + ".dt",
					type: 'GET',
					success: function(data) {
						var num = 0;
						var max_num;
						var infos = "";
						var count = new Array(10);
						for (var i = 0; i < 10; i++) count[i] = 0;

						$(data).find(".BoxText_1_C").each(function() {
							if (num == 11) {
								max_num = parseInt($(this).html());
								setTable("max_num", max_num);
							}
							if (num == 12) {
								setTable("course_num", $(this).html());
								setTable("percentage", (parseInt($(this).html()) / max_num * 100).toFixed(3) + "%");
							}
							if (num == 15) {
								setTable("average", $(this).html());
							}
							if (num >= 16 && num % 8 == 1) {
								count[Math.floor(parseInt($(this).html()) / 4)]++;
								if ((num - 9) / 8 == max_num) {
									setTable("cutline", $(this).html());
								}
							}
							if (num >= 16 && num % 8 == 6) {
								//var hakgi = Math.floor((parseInt(($(this).html()) - 1.5) / 12.5) / 2);
								var hakgi = parseInt($(this).html());
								if (hakgi <= "14") value_p[0].value++;
								else if (hakgi <= "39") value_p[1].value++;
								else if (hakgi <= "64") value_p[2].value++;
								else if (hakgi <= "89") value_p[3].value++;
								else value_p[4].value++;
								
							}

							if (num == 5)
								infos += "<li><strong>과목명</strong> : " + $(this).html() + "</li>";
							if (num == 7)
								infos += "<li><strong>담당교수</strong> : " + $(this).html() + "</li>";
							num++;
						});

						$('.dimmer').removeClass('active');
						$('.dimmer').addClass('disabled');

						for (var i = 0; i < 10; i++) {
							value.datasets[0].data.push(count[i]);
						}

						for (var i = 1; i <= 5; i++) {
							document.getElementById("grade" + i).innerHTML = value_p[i - 1].value;
						}

						var myNewChart = new Chart(ctx).Line(value);
						var myPChart = new Chart(ctx_p).Doughnut(value_p);


					}
				});
			}
			</script>
			<div class="ui active dimmer">
				<div class="ui text loader">불러오는 중..</div>
			</div>
		</div>
	</div>
	<!-- Start of StatCounter Code for Default Guide -->
	<script type="text/javascript">
		var sc_project=10492559; 
		var sc_invisible=0; 
		var sc_security="33c62cc8"; 
		var scJsHost = (("https:" == document.location.protocol) ?
		"https://secure." : "http://www.");
		document.write("<sc"+"ript type='text/javascript' src='" +
		scJsHost+
		"statcounter.com/counter/counter.js'></"+"script>");
	</script>
	<noscript>
		<div class="statcounter"><a title="hits counter"
		href="http://statcounter.com/" target="_blank"><img
		class="statcounter"
		src="http://c.statcounter.com/10492559/0/33c62cc8/0/"
		alt="hits counter"></a>
		</div>
	</noscript>
	<!-- End of StatCounter Code for Default Guide -->
</body>
</html>