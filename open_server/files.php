<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
		echo "<meta http-equiv='refresh' content='0; url=./login.php'>";
	}

	function curPageURL() {
		$pageURL = 'http';
		# if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
	 		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
?>
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

	a {
		color: #262626;
	}

	th {
		padding: 5px;
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
		<?php
			if (!isset($_GET['dir'])) $dir = '/';
			else $dir = $_GET['dir'];
		?>
		<div class="ui segment">
			<h1 class="ui left floated header">
				현재 폴더에서 작업
				<div class="sub header">현재 경로 : <?php echo $dir; ?></div>
			</h1>
			<div class="ui clearing divider"></div>
			<h3>새 파일 올리기</h3>
			<div class="ui segment">
				<form action="process.php?mode=upload" method="post" enctype="multipart/form-data">
					<p>올릴 파일을 선택 후 '파일 올리기' 버튼을 눌러주세요.</p>
					<input class="input-file" type="file" name="fileToUpload" id="fileToUpload">
					<input type="hidden" value=<?php echo '"'.$_SESSION['user_id'].'"';?> name="id" >
					<input type="hidden" value=<?php echo (isset($_GET['dir']))?($_GET['dir']):'/'; ?> name="route">
					<input type="submit" style="float: right; height: 32px;" value="파일 올리기" name="upload">
				</form>
			</div>
		</div>
		<table class="ui celled striped table">
			<thead>
				<tr>
					<th>파일 이름</th>
					<th>작업</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ( $handle = opendir($_SESSION['user_route'] . $dir) ) {
					while (false !== ($entry = readdir($handle))) {
						if ($entry != "." && $entry != "..") {
							echo '<tr>';
							if( is_dir($_SESSION['user_route'] . $dir . $entry) ) {
								echo '<th class="left aligned"><i class="folder icon"></i> <a href="?dir=' . $dir . $entry . '/' . '"> ' . $entry . '</a></th>';
								echo '<th class="right aligned"><a href="process.php?mode=delete&file='.$entry.'&target='.$dir.$entry.'"><div class="ui labeled icon tiny red button"><i class="trash o icon"></i> 지우기</div></a></th>';
							}
							else {
								echo '<th class="left aligned"><i class="file text icon"></i> <a href="' . $_SESSION['user_route']. $dir . $entry . '"> ' . $entry . '</span></a></th>';
								echo '<th class="right aligned collapsing">';
								echo '<a href="process.php?mode=view&target='.$dir.$entry.'"><div class="ui labeled icon tiny green button"><i class="file code o icon"></i> 코드 보기</div></a>';
								echo '<a id="download" href="process.php?mode=download&target='.$dir.$entry.'"><div class="ui labeled icon tiny blue button"><i class="download icon"></i> 내려받기</div></a>';
								echo '<a href="process.php?mode=history&target='.$dir.$entry.'"><div class="ui labeled icon tiny purple button"><i class="history icon"></i> 버전 관리</div></a>';
								echo '<a href="process.php?mode=delete&file='.$entry.'&target='.$dir.$entry.'"><div class="ui labeled icon tiny red button"><i class="trash o icon"></i> 지우기</div></a>';
								echo '</th>';
							}
							echo '</tr>';
						}
					}
					closedir($handle);
				}
				?>
			</tbody>
		</table>
	</div>
</body>
</html>