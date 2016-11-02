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
	}
	@media screen and (min-width: 1000px) {
		.container {
			width: 1000px;
			margin: 0 auto;
		}
	}
	</style>
	<script>
	</script>
</head>
<body style="padding: 8px;">
	<?php
		$db_connect = mysqli_connect("localhost", "root", "MOregairu519!", "lynlab");
		if(mysqli_connect_error()) {
			echo 'Fail to connect database.';
		}
		mysqli_set_charset($db_connect, 'utf8');

		session_start();
	?>
	<div class="ui fixed inverted main menu">
		<div class="container">
			<div class="title item">
				<b>Open Server</b>
			</div>
			<div class="right menu">
				<?php
				if(!isset($_SESSION['user_id'])) {
					echo '<div class="ui item" id="login"><a href="./login.php">로그인</a></div>';
				}
				else {
					echo '<div class="ui item" id="login"><a href="./files.php">나의 파일 보기</a></div>';	
				} 
				?>
				<!--
				<div class="ui popup" id="login-popup">
					<div class="ui form segment">
						<div class="field">
							<label>계정명</label>
							<div class="ui left icon input">
								<input type="text">
								<i class="user icon"></i>
							</div>
						</div>
						<div class="field">
							<label>비밀번호</label>
							<div class="ui left icon input">
								<input type="password">
								<i class="lock icon"></i>
							</div>
						</div>
						<div class="ui blue submit button">로그인</div>
					</div>
				</div>
				-->
			</div>
		</div>
	</div>
	<div class="main container" style="margin-top: 48px;">
		<div class="ui segment">
			<?php
				if(isset($_SESSION['user_id'])) {
					$uid = $_SESSION['user_id'];
					$find_query = "SELECT * FROM os_member WHERE id = '$uid'";
					$find_result = $db_connect -> query($find_query);
					$num_find_result = $find_result -> num_rows;
					$find_row = $find_result -> fetch_assoc();
					$name = $find_row['name']; ?>
				
				<div class="ui segment">
					<h1 class="left floated header">환영합니다, <?php echo $find_row['name']; ?>님.</h1>
					<div class="ui clearing divider"></div>
					<h3>현재 사용중인 용량</h3>
					<div class="ui indicating teal progress" id="storage">
						<div class="bar"></div>
						<div class="label">(undefined) MB</div>
					</div>
					<script>
					$('#storage').progress({
						percent: 99,
					});
					</script>
					<p>사용중인 용량 확인 기능은 현재 준비중입니다.</p>
				</div>

			<?php } ?>

			<div class="ui segment">
				<div class="ui two column middle aligned relaxed fitted stackable grid">
					<div class="column" style="overflow: hidden;">
						<h1 class="left floated header">공지사항</h1>
						<div class="ui clearing divider"></div>
						<div style="overflow: auto; overflow-x: hidden; height: 400px;">
							<h3 class="ui header">
								<i class="info circle icon"></i>
								<div class="content">탈퇴 / 계정 초기화 안내</div>
							</h3>
							<p>서비스 탈퇴나 데이터 삭제 요청은 6월 6일부터 가능합니다. 요청한 처리는 익일 오전 4시에 일괄적으로 이루어집니다.</p>
							<div class="ui divider"></div>
							<h3 class="ui header">
								<i class="info circle icon"></i>
								<div class="content">v1506061 업데이트</div>
							</h3>
							<p>본 업데이트는 두 단계로 나누어 진행합니다.</p>
							<p>1-1. 세션 공유 오류 현상을 수정했습니다.</p>
							<p>1-2. 새로운 UI가 적용됩니다.</p>
							<p>2-1. 개인 파일 관리가 더욱 편리해집니다. 자신이 현재 사용중인 용량을 파악할 수 있으며, 파일을 일괄적으로 삭제할 수 있는 기능도 지원합니다.</p>
							<p>2-2. 로그아웃, 계정 정보 수정, 프로필 관리가 가능해집니다.</p>
							<p>2-3. 타인의 프로필 열람이 가능해집니다.</p>
							<div class="ui divider"></div>
						</div>
					</div>
					<div class="ui vertical divider"></div>
					<div class="column" style="overflow: hidden;">
						<h1 class="left floated header">담벼락</h1>
						<div class="ui clearing divider"></div>
						<div style="overflow: auto; overflow-x: hidden; height: 400px;">
							<?php
								if(isset($_SESSION['user_id'])) { ?>
									<form method="POST" action="comment.php">
										<input type="hidden" name="id_comment" value=<?php echo '"' . $_SESSION['user_id'] . '"'; ?>></input>
										<div class="ui fluid action input">
											<input type="text" name="content" placeholder="게시글 내용"></input>
											<button class="ui button">올리기</button>
										</div>
									</form>
							<?php } ?>
							<div class="ui comments">
								<?php
									$sql_query_comment = "SELECT * FROM os_comment ORDER BY timestamp desc";
									$result_comment = $db_connect -> query($sql_query_comment);
									$num_result_comment = $result_comment -> num_rows;

									for($j = 0; $j < $num_result_comment; $j++) {
										$row_comment = $result_comment -> fetch_assoc();

										$cid = $row_comment['id'];
										$comment_query = "SELECT * FROM os_member WHERE id = '$cid'";
										$comment_result = $db_connect -> query($comment_query);
										$row_comment_name = $comment_result->fetch_assoc();
										
										echo '<div class="comment">';	
										echo '<a class="avatar"><img src="./img/user.png"></img></a>';
										echo '<div class="content">';
										echo '<a class="author">' . $row_comment_name['name'] . '</a>';
										echo '<div class="metadata">';
										echo '<div class="date">' . $row_comment['timestamp'] . '</div>';
										echo '</div>';
										echo '<div class="text">' . $row_comment['comment'] . '</div>';
										echo '</div>';
										echo '</div>';
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="ui segment">
				<h1 class="left floated header">최근 활동 목록</h1>
				<div class="ui clearing divider"></div>
				<?php
					$sql_query = "SELECT * FROM os_history ORDER BY date desc";
					$result = $db_connect -> query($sql_query);
					$num_result = $result -> num_rows;

					echo '<tr>';
					for ($i = 0; $i < 20; $i++) {
						$row = $result->fetch_assoc();

						$id = $row['id'];
						if ($id == '2014147575') {
							$i--;
							continue;
						}
				        $find_query = "SELECT * FROM os_member WHERE id = '$id'";
				        $find_result = $db_connect -> query($find_query);
				        $num_find_result = $find_result -> num_rows;
				        $find_row = $find_result->fetch_assoc();
				        $name = $find_row['name'];

				        if ($row['etc2'] == 0)
							echo '<li>'. $name. ' 님이 '
								. $row['filename']. ' 파일을 올렸습니다. ('
								. $row['date']. ')</li>';
						else if ($row['etc2'] == 1) 
							echo '<li>'. $name. ' 님이 로그인했습니다. ('.
								$row['date'] .')</li>';
						else if ($row['etc2'] == 2) 
							echo '<li>'. $name. ' 님이 '
								. $row['filename']. ' 파일을 지웠습니다. ('
								. $row['date']. ')</li>';
						else if ($row['etc2'] == 401)
							echo '<b><li style="color: red;">'. $name. ' 님이 '
								. ' 사이트에 공격을 시도했습니다. ('
								. $row['date']. ')</li></b>';
					}
					echo '</tr>';
				?>
			</div>
		</div>
	</div>
</body>
</html>