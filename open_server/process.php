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

		code {
			width: 800px;
			word-wrap: break-word;
		}
	}
	</style>
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
			$db_connect = mysqli_connect("localhost", "root", "MOregairu519!", "lynlab");
			if(mysqli_connect_error()) {
				echo 'Fail to connect database.';
			}
			mysqli_set_charset($db_connect, 'utf8');

			session_start();

			$mode = $_GET['mode'];

			if ($mode == 'upload') {
				$target_dir = $_SESSION['user_route'].$_POST['route'];
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$userside_file = $_POST['route'] . basename($_FILES["fileToUpload"]["name"]);

				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
					$uploadOk = 1;
				}
				// Check if file already exists
				if (file_exists($target_file)) {
					echo "<p>이미 존재하는 파일입니다. 기존에 파일에 덮어씁니다.</p>";

		            $sql_query = "SELECT * FROM os_files WHERE filename = '".$userside_file."';";
		            $result = $db_connect -> query($sql_query); 
		            $rev = mysqli_num_rows($result) + 1;
				}

				// Check file size
				if ($_FILES["fileToUpload"]["size"] > 2097152 ) {
					echo "파일의 용량이 너무 큽니다. 2MB가 넘는 파일은 올릴 수 없습니다.";
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					echo " 파일 업로드에 실패했습니다.";
				// if everything is ok, try to upload file
				} else {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						echo "<p>The file ". basename( $_FILES["fileToUpload"]["name"]). " 파일이 성공적으로 올라갔습니다.</p>";
						echo "<p><a href='".$_SESSION['user_route']."'>결과 보러가기</a></p>";
						echo "<p><a href='index.php'>이어서 올리기</a></p>";

						date_default_timezone_set('Asia/Seoul');
						$dt = new DateTime();
						$datetime = $dt -> format('Y-m-d H:i');
						$sql_query = "INSERT INTO os_history value ('".$datetime."','".$_FILES['fileToUpload']['name']."',".$_POST['id'].",0);";
						mysqli_query($db_connect, $sql_query) or die(mysql_error());

						$sql_query = "SELECT * FROM os_files WHERE 1;";
		                $result = $db_connect -> query($sql_query); 
		                $code = mysqli_num_rows($result) + 1;

		                if (!isset($rev)) $rev = 1;
						$sql_query = "INSERT INTO os_files VALUES ('".$code."', '".$_SESSION['user_id']."', '".$userside_file."', '".$rev."', '".$datetime."', 'NEW')";
						mysqli_query($db_connect, $sql_query) or die(mysql_error());
					} else {
						echo "Sorry, there was an error uploading your file.";
					}

					$backup_file = "backup" . $userside_file;
					if (!file_exists("backup" . $_POST['route'])) {
					    mkdir("backup" . $_POST['route'], 0777, true);
					}
			
					copy($target_file, $backup_file . '.' . $rev);
				}
			}

			else if ($mode == 'newfolder') {
				$name = $_GET['name'];
				mkdir($_SESSION['user_route'].'/'.$name, 01777);
				echo '<p>새 폴더 "'.$name.'" 을 만들었습니다.</p>';
				echo '<p><a href="index.php?dir=/">업로드 페이지로 돌아가기</p>';
			}

			else if ($mode == 'delete') {
				$target = $_SESSION['user_route'].'/'.$_GET['target'];

				function delTree($dir) { 
					$files = array_diff(scandir($dir), array('.','..')); 
					foreach ($files as $file) { 
						(is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
					} 
					return rmdir($dir); 
				}

				if (is_dir($target)) delTree($target);
				else unlink($target);

				date_default_timezone_set('Asia/Seoul');
				$dt = new DateTime();
				$datetime = $dt -> format('Y-m-d H:i');
				$sql_query = "INSERT INTO os_history value ('".$datetime."','".$_GET['file']."',".$_SESSION['user_id'].",2);";
				mysqli_query($db_connect, $sql_query) or die(mysql_error());

				echo '<p>'.$_GET['target'].'파일을 성공적으로 삭제했습니다.</p>';
				echo '<p><a href="index.php">업로드 페이지로 돌아가기</p>';
			}

			else if ($mode == 'download') {
				$filepath = $_SESSION['user_route'].$_GET['target'];
				$filesize = filesize($filepath);
				$path_parts = pathinfo($filepath);
				$filename = $path_parts['basename'];
				$extension = $path_parts['extension'];
				 
				header("Pragma: public");
				header("Expires: 0");
				header("Content-Type: application/octet-stream");
				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Transfer-Encoding: binary");
				header("Content-Length: $filesize");
				 
				ob_clean();
				flush();
				readfile($filepath);

				echo '<p><a href="index.php">업로드 페이지로 돌아가기</p>';
			}

			else if ($mode == 'zip') {
				$rootPath = realpath($_SESSION['user_route']);

				// Initialize archive object
				$zip = new ZipArchive();
				$zip->open($_SESSION['user_id'].'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

				// Create recursive directory iterator
				/** @var SplFileInfo[] $files */
				$files = new RecursiveIteratorIterator(
				    new RecursiveDirectoryIterator($rootPath),
				    RecursiveIteratorIterator::LEAVES_ONLY
				);

				foreach ($files as $name => $file)
				{
				    // Skip directories (they would be added automatically)
				    if (!$file->isDir())
				    {
				        // Get real and relative path for current file
				        $filePath = $file->getRealPath();
				        $relativePath = substr($filePath, strlen($rootPath) + 1);

				        // Add current file to archive
				        $zip->addFile($filePath, $relativePath);
				    }
				}

				// Zip archive will be created only after closing object
				$zip->close();

				$filepath = $_SESSION['user_id'] . '.zip';
				$filesize = filesize($filepath);
				$path_parts = pathinfo($filepath);
				$filename = $path_parts['basename'];
				$extension = $path_parts['extension'];
				 
				header("Pragma: public");
				header("Expires: 0");
				header("Content-Type: application/octet-stream");
				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Transfer-Encoding: binary");
				header("Content-Length: $filesize");

				ob_clean();
				flush();
				readfile($filepath);

				echo '<p><a href="index.php">업로드 페이지로 돌아가기</p>';
			}

			else if ($mode == 'history') {
				$sql_query = "SELECT * FROM os_files WHERE id = '" . $_SESSION['user_id'] . "' AND filename = '" . $_GET['target'] . "';";
		        $result = $db_connect -> query($sql_query); 
				$num_result = $result -> num_rows;

				for ($i = 0; $i < $num_result; $i++) {
					$row = $result -> fetch_assoc();
					echo '<p class="main">';
					echo '<a href="process.php?mode=recovery&rev='.($i + 1).'&target='.$_GET['target'].'">';
					echo '<span class="button button-history"><i class="fa fa-history"></i><span class="button-label"> 되돌리기</span></span>';
					echo '</a> <strong>rev. ' . $row['rev'] . '</strong> : ' . $row['date'];
					if ($row['act'] == 'NEW') echo ' <i>(업로드)</i>';
					else if ($row['act'] == 'DEL') echo ' <i>(지움)</i>';
					echo '</p>';
				}
				echo '<p><a href="index.php">업로드 페이지로 돌아가기</a></p>';
			}

			else if ($mode == 'recovery') {
				copy('backup' . $_GET['target'] . '.' . $_GET['rev'], $_SESSION['user_route'] . $_GET['target']);
				echo '<p>rev. ' . $_GET['rev'] . '으로 되돌렸습니다!</p>';
				echo '<p><a href="index.php">업로드 페이지로 돌아가기</a></p>';
			}

			else if ($mode == 'view') {
				$target = $_GET['target'];
				show_source($_SESSION['user_route'].'/'.$target);
			}
		?>
	</div>
</body>