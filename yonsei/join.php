=<!DOCTYPE html>
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
	.subscript {
		padding-top: 32px;
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
			<h1 class="left floated header">회원 가입</h1>
			<div class="ui clearing divider"></div>

			<!-- <h2 class="ui dividing header">서비스 이용 약관</h2>
			<h2 class="ui header">
				<i class="lock icon"></i>
				<div class="content">
					개인정보취급방침
					<div class="sub header">쉽고 편리한 서비스를 위하여</div>
				</div>
			</h2>
			<ul>
				<li>LYnLab에서는 다양한 서비스를 제공하기 위하여 아래 양식과 같은 개인정보를 수집, 저장합니다. 이용자의 동의 없이는 추가적인 정보 수집이 이루어지지 않습니다.</li>
				<li>수집된 개인 정보 중 일부는 타인이 열람할 수 있습니다. 열람이 가능한 정보의 범위는 사용자가 직접 지정할 수 있습니다.</li>
				<li>비공개로 지정한 개인 정보라도 서버 관리 담당자는 열람이 가능합니다.</li>
				<li>비밀번호 등 민감 정보는 암호화 된 형태로 저장되어 원본 확인이 불가능합니다.</li>
			</ul> -->

			<h2 class="ui dividing header">개인 정보</h2>
			<div class="ui form">
				<form method="post" action="script/register.php">
					<h3 class="ui dividing header">계정 정보</h3>
					<div class="three fields">
						<div class="field" id="id-field">
							<label>아이디</label>
							<input type="text" name="id" placeholder="5~12자의 영문/숫자/한글" onchange="validId()" required></input>
						</div>
						<div class="field"></div>
						<div class="field"></div>
					</div>
					<div class="three fields">
						<div class="field" id="password-field">
							<label>비밀번호</label>
							<input type="password" name="password" placeholder="5자 이상의 영문/숫자" onchange="validPassword()" required></input>
						</div>
						<div class="field" id="password-re-field">
							<label>비밀번호 확인</label>
							<input type="password" name="password-re" onchange="validPasswordRe()" required></input>
						</div>
						<div class="field"></div>
					</div>

					<h3 class="ui dividing header">개인 정보</h3>
					<p>입력하신 정보로 <strong>본인의 학과 커뮤니티</strong>에 자동 등록됩니다.<br/>같은 학과 학생이 아닌 것으로 신고당했을 경우 이용 제제가 이루어질 수 있습니다.</p>
					<div class="three fields">
						<div class="field">
							<label>이름</label>
							<input type="text" name="name" placeholder="" required></input>
						</div>
						<div class="field"></div>
						<div class="field"></div>
					</div>
					<div class="three fields">
						<div class="field" id="student-id-field">
							<label>학번</label>
							<input type="number" name="student-id" placeholder="" onchange="validStudentId()" required></input>
						</div>
						<div class="field"></div>
						<div class="field"></div>
					</div>
					<div class="three fields">
						<div class="field">
							<label>소속대학</label>
							<select class="ui search dropdown" name="college" id="select-college">
								<option value="">선택...</option>
								<option value="A">문과대학</option>
								<option value="B">상경대학</option>
								<option value="C">경영대학</option>
								<option value="D">이과대학</option>
								<option value="E">공과대학</option>
								<option value="F">생명시스템대학</option>
								<option value="G">신과대학</option>
								<option value="H">사회과학대학</option>
								<option value="I">법과대학</option>
								<option value="J">음악대학</option>
								<option value="K">생활과학대학</option>
								<option value="L">교육과학대학</option>
								<option value="M">의과대학</option>
								<option value="N">치과대학</option>
								<option value="O">간호대학</option>
								<option value="P">언더우드국제대학</option>
								<option value="Q">약학대학</option>
								<option value="R">글로벌인재학부</option>
							</select>
						</div>
						<div class="field">
							<label>소속학부</label>
							<input type="text" name="major" placeholder="정식 명칭으로 입력" required></input>
						</div>
						<div class="field"></div>
					</div>
					<div class="three fields">
						<div class="field" id="email-field">
							<label>이메일</label>
							<input type="email" name="email" placeholder="" onchange="validEmail()" required></input>
						</div>
						<div class="field"></div>
						<div class="field"></div>
					</div>
					<button class="ui blue submit button" type="submit">가입하기</button>
				</form>
			</div>
		</div>
		<script>
			$('#select-college').dropdown();
		</script>
	</div>
</body>
</html>