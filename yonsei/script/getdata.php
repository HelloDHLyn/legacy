<?php
	if (!isset($_GET['hakno'])) exit("Forbidden Access");
	$hakno = $_GET['hakno'];
	$class = $_GET['class'];
	$exer = $_GET['exer'];
	$html = file_get_contents("http://ysweb.yonsei.ac.kr:8888/curri120601/curri_pop_simul.jsp?domain=H1&hyhg=20152&hakno=" . $hakno . "&bb=" . $class . "&sbb=" . $exer);
	$file = '../data/' . $hakno . '-' . $class . '-' . $exer . '.dt';
	if (($fd = fopen($file, "w+")) !== false) { 
		fwrite($fd, iconv("EUC-KR", "UTF-8", $html)); 
		fclose($fd); 
	}
?>