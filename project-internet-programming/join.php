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

	<!-- jQuery와 Postcodify 팝업 기능을 로딩 -->
	<script src="js/jquery.js"></script>
	<script src="//cdn.poesis.kr/post/popup.min.js"></script>

	<!-- 필요한 함수 로드 -->
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

	<!-- 본문 시작 -->
	<article>
		<!-- 가입 섹션 시작 -->
		<section>
			<form action="script/register.php" method="post">
				<h2>회원 가입</h2>
				<div style="text-align: left;">
					<h3>계정 정보</h3>
					<p>
						<span>
							<label>아이디</label>
							<input type="text" name="id" id="join-id" onchange="validateId()" required />
						</span>
						<span id="join-id-comment"></span>
					</p>
					<p>
						<label>비밀번호</label>
						<input type="password" name="password" id="join-password" placeholder="비밀번호 입력" onchange="validatePassword()" required />
						<span id="join-password-comment"></span>
					</p>
					<p>
						<label></label>
						<input type="password" name="password_confirm" id="join-password-confirm" placeholder="다시 입력" onchange="validatePasswordConfirm()" required />
						<span id="join-password-confirm-comment"></span>
					</p>
					<p>
						<label>이름</label>
						<input type="text" name="name" id="join-name" required />
					</p>
					<p>
						<label>전화번호</label>
						<input type="text" name="phonenum" id="join-phonenum" placeholder="01X-XXXX-XXXX" required />
					</p>
					<p>
						<label>생년월일</label>
						<input type="date" name="birthday" id="join-birthday" placeholder="" required />
					</p>

					<h3>주소</h3>
					<!-- 주소와 우편번호를 입력할 <input>들을 생성하고 적당한 name과 class를 부여한다 -->
					<div id="join-address">
						<p>
							<label>우편 번호</label>
							<input type="text" name="postcode1" class="postcodify_postcode6_1" value="" style="width: 64px;" required /> &ndash;
							<input type="text" name="postcode2" class="postcodify_postcode6_2" value="" style="width: 64px;" required />
							<button type="button" id="postcodify_search_button">검색</button>
						</p>
						<p><label>(도로명)</label><input type="text" name="address1" class="postcodify_address" value="" style="width: 75%;" required /></p>
						<p><label>(상세주소)</label><input type="text" name="address2" class="postcodify_details" value="" style="width: 75%;" required /></p>
						<p><label>(지번주소)</label><input type="text" name="address3" class="postcodify_extra_info" value="" style="width: 75%;" required /></p>
					</div>

					<!-- "검색" 단추를 누르면 팝업 레이어가 열리도록 설정한다 -->
					<script> $(function() { $("#postcodify_search_button").postcodifyPopUp(); }); </script>

					<p style="text-align: center;">
						<input type="submit" id="join-submit" style="height: 48px; width: 100px; " />
					</p>
				</div>
			</form>
		</section>
	</article>
	<!-- 문의 섹션 종료 -->

	<!-- 푸터 -->
	<footer class="footer">
		<p>Copyright by Do Hoerin. <a href="license.php">라이선스 정보</a> <a href="admin.php">관리자 페이지</a></p>
	</footer>
</body>
</html>