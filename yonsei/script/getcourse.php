<?php
	$db_connect = mysqli_connect("localhost", "root", "MOregairu519!", "lynlab");
	mysqli_set_charset($db_connect, "utf8");

	$sql_query = "SELECT * FROM ys_course";

	$sql_result = $db_connect -> query($sql_query);
	$row_num = $sql_result -> num_rows;

	$arr = array();

	for ($i = 0; $i < $row_num; $i++) {
		$row = $sql_result -> fetch_assoc();
		$course_name = $row['name'];
		$course_code = $row['course'] . '-';
		$class_code = '';
		$exer_code = '';
		if ($row['class'] < 10) $class_code .= '0';
		$class_code .= $row['class'];
		$course_code .= $class_code . '-';
		if ($row['exercise'] < 10) $exer_code .= '0';
		$exer_code .= $row['exercise'];
		$course_code .= $exer_code;
		
		$description = '';
		if ($row['professor'] != '') $description .= $row['professor'] . ' 교수님 | ';
		$description .= $row['time'];

		
		$url = './search.php?hakno=' . $row['course'] . '&class=' . $class_code . '&exer=' . $exer_code;
		array_push($arr, array('title' => $course_name, 'url' => $url, 'description' => $description));
	}

	$dataset = array('results' => $arr);
	echo json_encode($dataset);
?>