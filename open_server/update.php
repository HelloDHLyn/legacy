<?php
	header("Content-Type: text/html; charset=UTF-8");

	session_start();
	$uid = $_SESSION['user_id'];

	copydir("default", $uid);

	function copydir($source, $destination) {
		if(!is_dir($destination)){
			echo "make directory ".$destination;
			$oldumask = umask(0); 
			mkdir($destination, 01777); // so you get the sticky bit set 
			umask($oldumask);
		}
		$dir_handle = @opendir($source) or die("Unable to open");
		while ($file = readdir($dir_handle)) {
			if($file!="." && $file!=".." && !is_dir("$source/$file"))
			copy("$source/$file", "$destination/$file");
		}
		closedir($dir_handle);
	}

	echo '<script>alert("완료되었습니다.")</script>';
	echo "<meta http-equiv='refresh' content='0; url=./".$uid."/'>";
?>