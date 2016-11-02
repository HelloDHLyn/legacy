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
	<script src="js/script.js"></script>
	<script src="../dist/semantic.js"></script>
	<link rel="stylesheet" href="../dist/semantic.css">
	<link rel="stylesheet" href="../css/stylesheet.css">
	<style>
	@media screen and (min-width: 1000px) {
		#myChart {
			width: 500px;
		}
	}

	.blank {
		width: 8px;
	}

	.small {
		width: 80px;
	}
	</style>
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
		<div class="ui segment">
			<h1 class="left floated header">메인 광장</h1>
			<div class="ui clearing divider"></div>
			<h2 class="left floated header">기능제안/건의</h2>
			<form action="script/comment.php" method="post">
				<div class="ui fluid action input">
					<input name="content" class="prompt" type="text" placeholder="나도 제안하기" />
					<button class="ui icon button" type="submit">
						<i class="comments icon"></i>
					</button>
				</div>
			</form>
			
			<div class="ui comments">
				<?php
					$sql_query_comment = "SELECT * FROM ys_comment ORDER BY timestamp desc";
					$result_comment = $db_connect -> query($sql_query_comment);
					$num_result_comment = $result_comment -> num_rows;

					for($j = 0; $j < $num_result_comment; $j++) {
						$row_comment = $result_comment -> fetch_assoc();

						$cid = $row_comment['user'];

						$comment_query = "SELECT * FROM ys_member WHERE code = '$cid'";
						$comment_result = $db_connect -> query($comment_query);
						$row_comment_name = $comment_result->fetch_assoc();
						if ($cid == "NONE") {
							$row_comment_name['name'] = "익명의 연대생";
						}
						
						echo '<div class="comment">';
						echo '<a class="avatar"><img src="./assets/user.png"></img></a>';
						echo '<div class="content">';
						echo '<a class="author">' . $row_comment_name['name'] . '</a>';
						echo '<div class="metadata">';
						echo '<div class="date">' . $row_comment['timestamp'] . '</div>';
						echo '</div>';
						echo '<div class="text">' . $row_comment['content'] . '</div>';
						echo '</div>';
						echo '</div>';
					}
				?>
			</div>
			<div class="ui clearing divider"></div>
			<h2 class="left floated header">공지사항</h2>
			<div class="ui green segment">
				<h3 class="ui header">
					<i class="info circle icon"></i>
					<div class="content">개발 준비중인 기능들</div>
				</h3>
				<div class="ui clearing divider"></div>
				<ul>
					<li><strong>개발 진행중</strong></li>
					<ul>
						<li>개인 계정 생성 기능</li>
						<li>모든 강의에 대한 데이터베이스 생성</li>
					</ul>
					<li><strong>기획중</strong></li>
					<ul>
						<li>개인 시간표 등록 기능</li>
						<li>강의 평가 기능</li>
						<li>과목별 마일리지 맞춤 추천 시스템</li>
					</ul>
				</ul>
				<p>기능 제안은 언제든지 환영합니다. <a href="mailto:lyn@lynlab.co.kr">lyn@lynlab.co.kr</a>으로 다양한 의견 보내주세요.</p>
			</div>
		</div>
		<p>Version : 2015070701</p>
	</div>
	<div class="ui small modal"  style="padding-left: 5%; padding-right: 5%;" id="login-modal">
		<div class="header">로그인</div>
		<div class="content">
			<div class="ui two column middle aligned very relaxed stackable grid">
				<div class="column">
					<div class="ui form">
						<form method="post" action="script/login.php">
							<div class="field">
								<label>아이디</label>
								<div class="ui left icon input">
									<input name="uid" type="text" placeholder="">
									<i class="user icon"></i>
								</div>
							</div>
							<div class="field">
								<label>비밀번호</label>
								<div class="ui left icon input">
									<input name="upw" type="password">
									<i class="lock icon"></i>
								</div>
							</div>
							<div vlass="center aligned column" style="text-align: center;">
								<button class="ui blue submit button">로그인</button>
							</div>
						</form>
					</div>
				</div>
				<div class="ui vertical divider">
					또는
				</div>
				<div class="center aligned column">
					<a href="join.php">
						<div class="ui big green labeled icon button">
							<i class="signup icon"></i>
							회원가입
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>