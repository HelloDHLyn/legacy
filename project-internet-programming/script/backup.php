<?php
	header("Content-Type: text/html; charset=UTF-8");

	$db_connect = mysql_connect("localhost", "u2014147575", "u2014147575") or die("fail");
	mysql_set_charset($db_connect, "utf8");
	mysql_select_db("db_u2014147575", $db_connect);

	$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
	$root_element = "members"; //fruits
	$xml .= "<$root_element>";

	//select all items in table
	$query = "SELECT * FROM db_member";
	 
	$result = mysql_query($query);
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}

	$config['table_name'] = "member";

	if(mysql_num_rows($result) > 0) {
		while($result_array = mysql_fetch_assoc($result)) {
			$xml .= "<".$config['table_name'].">";
			foreach($result_array as $key => $value) {
				$xml .= "<$key>";
				$xml .= "<![CDATA[$value]]>";
				$xml .= "</$key>";
			}
			$xml .= "</" . $config['table_name'] . ">";
		}
	}

	echo '<textarea style="border: none; width: 100%; height: 100%;">';
	echo $xml;
	echo '</textarea>';
?>