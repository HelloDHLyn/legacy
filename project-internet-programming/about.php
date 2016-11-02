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
	<!-- 헤더 시작 -->
	<header class="header-menu">
		<div class="header-container">
			<div class="logo-container">
				<h2 class="header-menu-title">CloudIntro</h2>
			</div>
			<div class="menu-container">
				<ul>
					<li><a href="index.php">HOME</a></li>
					<li><a href="directory.php">DIRECTORY</a></li>
					<li class="header-menu-selected"><a href="#">ABOUT ME</a></li>
				</ul>
			</div>
		</div>
	</header>
	<!-- 헤더 종료 -->

	<!-- 본문 시작 -->
	<article>
		<!-- 프로필 섹션 시작 -->
		<section>
			<h2>프로필</h2>
			<div style="text-align: left">
				<div>
					<h3>기본 소개</h3>
					<table>
						<tr>
							<td class="table-head">이름</td>
							<td>도회린</td>
						</tr>
						<tr>
							<td class="table-head">소속</td>
							<td>연세대학교 공과대학 컴퓨터과학과 2학년</td>
						</tr>
						<tr>
							<td class="table-head">자기소개</td>
							<td><p>컴퓨터를 처음 접한 것은 5살 무렵, 학문적인 의미로 컴퓨터를 시작한 시기는 초등학교 5학년. C언어를 비롯한 컴퓨터 공부를 시작한 이후로 이쪽 분야에 푹 빠져들어 컴퓨터와 뗄래야 뗄 수 없는 관계가 되었다. 프로그래밍 뿐만 아니라 키보드로 할 수 있는 것이라면 대부분 무난하게 해내지만 몸을 쓰는 것에는 영 취약하다. 어릴 때부터 사람보다 컴퓨터와 친하게 지내서 대인 관계와 감정 표현에 서툰 부분이 있다.<br/>
							장기적인 목표는 어떤 작품의 크레딧에 자신의 이름이 올랐을 때, 그것을 본 사람이 누구나 &apos;역시 그 사람 작품이구나&apos;하고 생각할 수 있는 입지에 오르는 것. 여기서의 &apos;작품&apos;은 단순히 프로그램만으로 한정짓지 않기 위하여 노력하고 있다.</td>
						</tr>
					</table>
					<h3>약력</h3>
					<table>
						<tr>
							<td class="table-head">2012 ~ 2014</td>
							<td>경남과학고등학교 졸업</td>
						</tr>
						<tr>
							<td class="table-head">2014 ~ </td>
							<td>연세대학교 컴퓨터과학과 학부 재학</td>
						</tr>
					</table>
					<h3>업무 및 수상 경력</h3>
					<table>
						<tr>
							<td class="table-head">2013 ~ 2014</td>
							<td>(주)노트케이스 프로그램 개발 계약 체결</td>
						</tr>
						<tr>
							<td class="table-head">2014</td>
							<td>제 20회 삼성휴먼테크논문대상 고교부문 수학/전산분야 금상</td>
						</tr>
						<tr>
							<td class="table-head">2014</td>
							<td>특허출원(10-2014-0192784) - 디스플레이 보정 장치 및 방법</td>
						</tr>
						<tr>
							<td class="table-head">2015</td>
							<td>국가공인기술자격 정보처리기능사</td>
						</tr>
					</table>
					<h3>연락처</h3>
					<table>
						<tr>
							<td class="table-head">홈페이지</td>
							<td><a href="http://lynlab.co.kr/">lynlab.co.kr</a></td>
						</tr>
						<tr>
							<td class="table-head"><b>전화번호</b></td>
							<td>010-8896-5803</td>
						</tr>
						<tr>
							<td class="table-head"><b>이메일</b></td>
							<td><a href="mailto:lyn@lynlab.co.kr">lyn@lynlab.co.kr</a></td>
						</tr>
					</table>
				</div>
			</div>
		</section>
		<!-- 프로필 섹션 종료 -->

		<!-- 문의 섹션 시작 / 배경색 있음 -->
		<section id="contact-us">
			<div>
				<h2>문의하기</h2>
				<div style="text-align: left;">
					<form method="post" action="#">
						<p>
							<label>이름</label>
							<input type="text" style="width: 250px;" />
						</p>
						<p>
							<label>메일</label>
								<input type="email" style="width: 250px;" />
						</p>
						<p>
							<label>연락처</label>
							<input type="tel" style="width: 250px;" placeholder="010-1234-5678" pattern="\d{3}-\d{4}-\d{4}" />
						</p>
						<p>
							<label>문의 내용</label>
							<input type="text" style="width: 90%; height: 100px" />
						</p>
						<p style="text-align:center;">
							<input type="submit" style="width: 100px; height: 48px" />
						</p>
					</form>
				</div>
			</div>
		</section>
	</article>
	<!-- 문의 섹션 종료 -->

	<!-- 푸터 -->
	<footer class="footer">
		<p>Copyright by Do Hoerin. <a href="license.php">라이선스 정보</a> <a href="admin.php">관리자 페이지</a></p>
	</footer>
</body>
</html>