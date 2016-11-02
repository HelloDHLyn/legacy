<?php
$db_connect = mysqli_connect("localhost", "root", "MOregairu519!", "lynlab");
mysqli_set_charset($db_connect, "utf8");

require_once ('simple_html_dom.php');

for ($j = 1; $j <= 9; $j++) {
	$code = '';
	if ($j < 10) $code = '0';
	$code .= $j;

	$table = file_get_html('../courses/rli' . $code . '.table');

	$i = 0;

	$grade = "";
	$point = "";
	$course = "";
	$class = "";
	$professor = "";
	$exercise = "";
	$name = "";
	$time = "";

	foreach($table -> find('td') as $td){ // Foreach row in the table!
		if ($i % 11 == 0) {
			$grade = "";
			$point = "";
			$course = "";
			$class = "";
			$professor = "";
			$exercise = "";
			$name = "";
			$time = "";
		}
		if ($i % 11 == 1) $grade = $td->plaintext;
		if ($i % 11 == 3) {
			$hakno = $td->plaintext;
			$course = substr($hakno, 0, 7);
			$class = substr($hakno, 8, 2);
			$exercise = substr($hakno, 11, 2);
		}
		if ($i % 11 == 4) $point = $td->plaintext;
		if ($i % 11 == 5) $name = $td->plaintext;
		if ($i % 11 == 6) $professor = $td->plaintext;
		if ($i % 11 == 7) $time = $td->plaintext;
		if ($i % 11 == 10) {
			$j--;
			$sql_query = "INSERT INTO ys_course VALUES ('', '$course', '$class', '$exercise', '$name', '$professor', '$time', '$grade', '$point', '23', '$j', '');"; // Do your insert query here!
			$sql_result = $db_connect -> query($sql_query);
			$j++;
		}
		$i++;
	}
}
?>