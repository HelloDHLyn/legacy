<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" href="dist/semantic.css" />
	<script src="dist/semantic.js"></script>
	<script src="js/jquery.js"></script>
	<style type="text/css">
		body {
			padding: 5%;
		}
	</style>
</head>
<body>
	<h1>가로 세로 배치</h1>
	<div class="ui segment">
		<div class="ui two column middle aligned relaxed fitted stackable grid">
			<div class="column">
				<div class="ui form segment">
					<div class="field">
						<label>Username</label>
						<div class="ui left icon input">
							<input type="text" placeholder="Username">
							<i class="user icon"></i>
						</div>
					</div>
					<div class="field">
						<label>Password</label>
						<div class="ui left icon input">
							<input type="password">
							<i class="lock icon"></i>
						</div>
					</div>
					<div class="ui blue submit button">Login</div>
				</div>
			</div>
			<div class="ui vertical divider">
				Or
			</div>
			<div class="center aligned column">
				<div class="huge green ui labeled icon button">
					<i class="signup icon"></i>
					Sign Up
				</div>
			</div>
		</div>
	</div>

	<div class="ui divider"></div>

	<h1>탭 버튼</h1>
	<div>
		<div class="ui buttons">
			<div class="ui button">내 주변</div>
			<div class="ui button">경로 주변</div>
			<div class="ui button">전체 소식</div>
		</div>
		<div class="ui segment">
			<div class="ui vertical segment">
				<p>송재우, 노잼 개그로 유명..</p>
			</div>
			<div class="ui vertical segment">
				<p>송재우, 재미없는 개그로 유명..</p>
			</div>
			<div class="ui vertical segment">
				<p>송재우, 부장님 개그로 유명..</p>
			</div>
		</div>
	</div>
</body>
</html>