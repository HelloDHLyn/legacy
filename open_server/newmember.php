<?php
	header("Content-Type: text/html; charset=UTF-8");
?>

<?php
	$db_connect = mysqli_connect("localhost", "root", "MOregairu519!", "lynlab");

	if(mysqli_connect_error()) {
		echo "Fail to connect database.";
	}
	mysqli_set_charset($db_connect, 'utf8');

	$uname = $_POST['uname'];
	$uid = $_POST['uid'];
	$upw1 = $_POST['upw1'];

	$uroute = generateRandomString(10);

	$sql_push = "INSERT INTO os_member value ('$uid', '$uname', '$upw1', '$uroute');";
	$result_push = mysqli_query($db_connect, $sql_push) or die(mysql_error());

	copydir("default", $uid);
	mkdir($uid."/".$uroute, 01777);

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

	function generateRandomString($length) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
}

	echo "<meta http-equiv='refresh' content='0; url=http://server2.lynlab.co.kr/open_server/'>"
?>
