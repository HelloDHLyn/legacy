<!DOCTYPE html>
<html lang="ko-KR">
<head profile="http://www.w3.org/2005/10/profile">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>LYnLab 오픈 서버</title>
	<link rel="icon" type="image/png" href="http://server2.lynlab.co.kr/favicon.png">
	<link rel="stylesheet" href="style.css">
	<script src="client/lib/jquery-1.8.2.min.js"></script>
	<script src="readmore.min.js"></script>
	<link rel="stylesheet" type="text/css" href="client/themes/default/jquery.phpfreechat.min.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body>
	<div class="header">
		<h1>LYnLab 오픈 서버</h1>
	</div>
	<div class="section" id="advertise" style="text-align: center;">
		<script type="text/javascript">var kauli_yad_js_count = typeof(kauli_yad_js_count) == 'undefined' ? 1 : kauli_yad_js_count + 1;(function(d){ d.write('<span id="kauli_yad_js_' + kauli_yad_js_count + '" style="width:728px; height:90px; display:inline-block"><' + '!--64934--' + '>'); var src = 'http://js.kau.li/ssp.js?count=' + kauli_yad_js_count; d.write('<scr' + 'ipt type="text/javascript" src="' + src + '"></scr' + 'ipt>'); d.write('</span>');})(document);</script>
	</div>
	<div class="section" style="background-color: #27ae60; color: white; border: 0px solid;">
		<h2><i class="fa fa-info-circle"></i> 탈퇴 / 일괄 삭제 요청 안내</h2>
		<p>서비스 탈퇴나 모든 파일 및 데이터의 일괄 삭제 처리는 6월 6일(토) 부터 가능합니다. 요청한 삭제 처리는 익일 오전 4시에 이루어집니다.</p>
		<p>탈퇴를 위해서는 간단한 설문 조사에 필수로 참여해주셔야 합니다.</p>
		<p>추후, 오픈 서버는 <strong>공식 서비스</strong>로 재개할 예정입니다. 많은 관심과 홍보 부탁드립니다.</p>
	</div>
	<div class="section" style="background-color: #2980b9; color: white; border: 0px solid;">
		<h2><i class="fa fa-cogs"></i> 업데이트 안내</h2>
		<div class="notice-update-content">
			<!-- <h3>v15052101</h3>
			<p>1. (추가) 이제 개인 페이지에서 폴더를 만들고 폴더 안에 업로드를 할 수 있습니다.</p>
			<p>2. (추가) 폴더와 파일을 쉽게 구분할 수 있도록 아이콘을 추가했습니다.</p>
			<p>3. (추가) 이제 php 컴파일 중 문법 오류가 발생했을 때, 어떤 오류가 발생했는지 알려줍니다.</p>
			<p>4. (내부 작업) 서버의 부하를 줄이기 위한 CDN 작업이 진행되었습니다.</p> -->
			<!-- <h3>v150524</h3>
			<p>1. 파일 목록에서 지우기 아이콘을 실수로 누르지 않도록 위치와 크기를 조절했습니다.</p>
			<p>2. 파일 개별 다운로드, 모두 내려받기 기능을 추가했습니다.</p>
			<p>3. 이제 사이트에 공격을 시도할 경우 <del>능지처참</del> 기록을 메인에 띄웁니다.</p>-->
			<h3>v150526</h3>
			<p>1. 파일 복구 기능이 추가 되었습니다. (아직 삭제된 파일에는 동작하지 않습니다)</p>
			<p>2. <strong>트래픽 문제</strong>로 인하여 용량을 너무 많이 사용하면 일부 제한이 걸릴 수 있습니다.</p>
			<p>오픈 서버는 학습용으로만 사용할 수 있습니다.</p>
		</div>
	</div>
	<!--<div class="section" style="background-color: #c0392b; color: white; border: 0px solid;">
		<h2><i class="fa fa-exclamation-triangle"></i> 서버 불안정 경고</h2>
		<p>서버가 불안정합니다. MySQL을 비롯한 데이터베이스 기능이 정상적으로 동작하지 않을 수 있습니다.</p>
	</div>-->
	<?php
		$db_connect = mysqli_connect("localhost", "root", "MOregairu519!", "lynlab");
		if(mysqli_connect_error()) {
			echo 'Fail to connect database.';
		}
		mysqli_set_charset($db_connect, 'utf8');

		session_start();
		if(isset($_SESSION['user_id'])) {
			$uid = $_SESSION['user_id'];
			$find_query = "SELECT * FROM os_member WHERE id = '$uid'";
			$find_result = $db_connect -> query($find_query);
			$num_find_result = $find_result -> num_rows;
			$find_row = $find_result->fetch_assoc();
			$name = $find_row['name'];

			echo '<div class="section">';
			echo "<h2>환영합니다.</h2>";
			echo "<p><a href='$uid"."?dir=/"."'>".$name."님의 페이지로 바로 가기</a></p></div>";

			echo '<div class="section" style="overflow: scroll; max-height: 384px;"><h2>한줄 게시판</h2>';
			echo '<form method="POST" action="comment.php"><input type="hidden" name="id_comment" value="'.$uid.'"><input style="height: 48px; width: 70%;" name="content" type="text" placeholder="게시글을 입력하세요"></input>';
			echo '<input style="height: 48px;" type="submit" value="확인"></input></form>';

			$sql_query_comment = "SELECT * FROM os_comment ORDER BY timestamp desc";
			$result_comment = $db_connect -> query($sql_query_comment);
			$num_result_comment = $result_comment -> num_rows;

			for($j = 0; $j < $num_result_comment; $j++) {
				$row_comment = $result_comment -> fetch_assoc();

				$cid = $row_comment['id'];
				$comment_query = "SELECT * FROM os_member WHERE id = '$cid'";
				$comment_result = $db_connect -> query($comment_query);
				$row_comment_name = $comment_result->fetch_assoc();
				
				echo '<p><strong>'
					.$row_comment_name['name']
					.'</strong> - '
					.$row_comment['comment']
					.' ('
					.$row_comment['timestamp']
					.')';
				}
				echo '</div>';
		} else {
			echo '<div class="section">';
			echo '<p><a href="login.php">로그인</a> 후 이용해주세요.<p>';
			echo '<p>계정이 없다면 <a href="join.php">회원 가입</a> 후 즉시 이용하실 수 있습니다.</p>';
			echo '</div>';
		}
	?>
	<div class="section">
		<h2>이용 방법</h2>
		<p>1. 신규 등록 후 승인이 될 때까지 기다립니다.</p>
		<p>2. 등록이 완료되면 다음의 경로로 접속합니다 : http://server2.lynlab.co.kr/open_server/(학번)</p>
		<p>3. 파일을 <strong>하나씩</strong> 업로드합니다. 서버 부하를 줄이기 위함이니 귀찮아도 양해 부탁드립니다. <strong>파일 이름은 영숫자와 기본 기호만 사용</strong> 가능합니다.</p>
		<p>4. 모든 파일의 업로드가 끝나면 자신의 페이지로 돌아가서 결과를 확인할 수 있습니다.</p>
	</div>
	<div class="section">
		<h2>최근 업데이트</h2>
		<?php
			$sql_query = "SELECT * FROM os_history ORDER BY date desc";
			$result = $db_connect -> query($sql_query);
			$num_result = $result -> num_rows;

			echo '<ul>';
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
			echo '</ul>';

		?>
	</div>
	<!-- <div class="section">
		<h2>사랑방</h2>
		<div role="main">
		    <h1 style="font-size:1.5em">phpFreeChat - default theme and default parameters</h1>
		    <div class="pfc-hook"><a href="http://www.phpfreechat.net">Creating chat rooms everywhere - phpFreeChat</a></div>
		    	<script type="text/javascript">
		    		$('.pfc-hook').phpfreechat();
		    	</script>
			</div>
		</div>
	-->
</body>
</html>