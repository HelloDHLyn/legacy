<?php
	if (isset($_GET['mode'])) {
		$db_connect = mysqli_connect("localhost", "sting_db", "sting2015!", "open_server");
		if(mysqli_connect_error()) {
			echo 'Fail to connect database.';
		}
		mysqli_set_charset($db_connect, 'utf8');

		if ($_GET['mode'] == "festival") {
			$sql_query = "SELECT * FROM sting_festival WHERE x = '" . $_GET['mapx'] . "';";
			$result = $db_connect -> query($sql_query);
			$num_result = $result -> num_rows;

			if ($num_result == 0) {
				$sql_query = "INSERT INTO sting_festival VALUES ('', '".$_GET['title']."', '".$_GET['startDate']."', '".$_GET['endDate']."', '".$_GET['mapx']."', '".$_GET['mapy']."', '".$_GET['address']."');";
				$result = $db_connect -> query($sql_query);
			}
		}

		else if ($_GET['mode'] == "route") {
			$name = array();
			$lng = array();
			$lat = array();

			$vianum = $_GET['vianum'];
			for ($i = 0; $i < 4; $i++) {
				if ($i <= $vianum + 1) {
					$name[$i] = $_GET['name' . $i];
					$lng[$i] = $_GET['lng' . $i];
					$lat[$i] = $_GET['lat' . $i];
				}
				else {
					$name[$i] = 0;
					$lng[$i] = 0;
					$lat[$i] = 0;
				}
			}
			date_default_timezone_set('Asia/Seoul');
			$timestamp = date("Y-m-d H:i:s",time());

			$sql_query = "INSERT INTO sting_route VALUES ('', '".$_COOKIE['member_num']."', '".$_GET['name']."', $vianum, '".$name[0]."', '".$lng[0]."', '".$lat[0]."', '".$name[1]."', '".$lng[1]."', '".$lat[1]."', '".$name[2]."', '".$lng[2]."', '".$lat[2]."', '".$name[3]."', '".$lng[3]."', '".$lat[3]."', '".$name[4]."', '".$lng[4]."', '".$lat[4]."', 0, '". $timestamp."');";
			$result = $db_connect -> query($sql_query);
		}
	}
?>