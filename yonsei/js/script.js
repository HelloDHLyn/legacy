function setTable(id, value) {
	document.getElementById(id).innerHTML = value;
}

function search() {
	var redir = document.getElementById("user-hakno").value;
	var match = redir.match(/^[A-Z]{3}[0-9]{4}-[0-9]{2}-[0-9]{2}$/);
	if (match != null && match[0] == redir) {
		var course = redir.substring(0, 7);
		var classNo = redir.substring(8, 10);
		var exeNo = redir.substring(11, 13);
		location.replace("search.php?hakno=" + course + "&class=" + classNo + "&exer=" + exeNo);
	}
	else alert("올바른 형식의 학정 번호가 아닙니다.");
}

var data;
var name;
var value;
var value_p;
var ctx;
var ctx_p;
function initData() {
	
	value = {
		labels: ["0 ~ 3", "4 ~ 7", "8 ~ 11", "12 ~ 15", "16 ~ 19", "20 ~ 23", "24 ~ 26", "28 ~ 31", "32 ~ 35", "36"],
		datasets: [{
			fillColor: "rgba(151,187,205,0.2)",
	        strokeColor: "rgba(151,187,205,1)",
	        pointColor: "rgba(151,187,205,1)",
	        pointStrokeColor: "#fff",
	        pointHighlightFill: "#fff",
	        pointHighlightStroke: "rgba(151,187,205,1)",
			data: []
		}]
	};

	value_p = [
		{ label: "1학년", color: "#222222", highlight: "#111111", value: 0 },
		{ label: "2학년", color: "#555555", highlight: "#333333", value: 0 },
		{ label: "3학년", color: "#888888", highlight: "#777777", value: 0 },
		{ label: "4학년", color: "#AAAAAA", highlight: "#999999", value: 0 },
		{ label: "5학년+", color: "#CCCCCC", highlight: "#BBBBBB", value: 0 }
		//{ label: "5학기", color: "#AAAAAA", highlight: "#AAAAAA", value: 0 },
		//{ label: "6학기", color: "#CCCCCC", highlight: "#CCCCCC", value: 0 },
		//{ label: "7학기", color: "#DDDDDD", highlight: "#DDDDDD", value: 0 },
		//{ label: "8학기+", color: "#EEEEEE", highlight: "#EEEEEE", value: 0 },
	];

	ctx = $("#myChart").get(0).getContext("2d");
	ctx_p = $("#pChart").get(0).getContext("2d");
}

// 회원 가입
function validId() {
	var $form = $('.ui.form');
	var id = $form.form('get value', 'id');

	var valid = true;
	var errorComment = "";
	if (id.length < 5) {
		errorComment = "아이디는 5글자 이상입니다.";
		valid = false;
	}

	$('.id-error').remove();
	if(!valid) {
		$('#id-field').addClass('error');
		$('#id-field').append(
			"<div class=\"ui pointing label id-error\">" + errorComment + "</div>"
			);
	}
	else {
		$('#id-field').removeClass('error');
	}
}

function validPassword() {
	var $form = $('.ui.form');
	var password = $form.form('get value', 'password');

	var valid = true;
	var errorComment = "";
	if (password.length < 5) {
		errorComment = "비밀번호는 5글자 이상입니다.";
		valid = false;
	}

	$('.password-error').remove();
	if(!valid) {
		$('#password-field').addClass('error');
		$('#password-field').append(
			"<div class=\"ui pointing label password-error\">" + errorComment + "</div>"
			);
	}
	else {
		$('#password-field').removeClass('error');
	}
}

function validPasswordRe() {
	var $form = $('.ui.form');
	var password = $form.form('get value', 'password');
	var password_re = $form.form('get value', 'password-re');

	var valid = true;
	var errorComment = "";
	if (password !== password_re) {
		errorComment = "비밀번호가 일치하지 않습니다.";
		valid = false;
	}

	$('.password-re-error').remove();
	if(!valid) {
		$('#password-re-field').addClass('error');
		$('#password-re-field').append(
			"<div class=\"ui pointing label password-re-error\">" + errorComment + "</div>"
			);
	}
	else {
		$('#password-re-field').removeClass('error');
	}
}

function validStudentId() {
	var $form = $('.ui.form');
	var sid = $form.form('get value', 'student-id');

	var valid = true;
	var errorComment = "";
	if (sid.length != 10) {
		errorComment = "학번 형식이 일치하지 않습니다.";
		valid = false;
	}
	else if (sid.substring(4, 5) != "1") {
		errorComment = "죄송합니다. 이 서비스는 신촌/국제캠퍼스만 제공됩니다.";
		valid = false;	
	}

	$('.student-id-error').remove();
	if(!valid) {
		$('#student-id-field').addClass('error');
		$('#student-id-field').append(
			"<div class=\"ui pointing label student-id-error\">" + errorComment + "</div>"
			);
	}
	else {
		$('#student-id-field').removeClass('error');
	}
}

function login() {
	$('.small.modal')
		.modal({blurring: true})
		.modal('show')
	;
}

function setTableSample() {
	$('#cell-14').html("<strong>선형대수와그응용</strong><br/>공B042");
	$('#cell-14').attr("rowspan", "2");
	$('#cell-14').attr("bgcolor", "#eeeeee");
	$('#cell-15').remove();
	$('#cell-18').html("<strong>프로그래밍언어구조론</strong><br/>공A658");
	$('#cell-18').attr("bgcolor", "#eeeeee");
	$('#cell-18').attr("rowspan", "2");
	$('#cell-19').remove();
	$('#cell-28').html("<strong>논리회로설계</strong><br/>공A528");
	$('#cell-28').attr("bgcolor", "#eeeeee");
	$('#cell-35').html("<strong>프로그래밍언어구조론</strong><br/>공A658");
	$('#cell-35').attr("bgcolor", "#eeeeee");
	$('#cell-37').html("<strong>연극의이해</strong><br/>백양관강당");
	$('#cell-37').attr("bgcolor", "#eeeeee");
	$('#cell-45').html("<strong>논리회로설계</strong><br/>공A528");
	$('#cell-45').attr("bgcolor", "#eeeeee");
	$('#cell-45').attr("rowspan", "2");
	$('#cell-46').remove();
	$('#cell-49').html("<strong>선형대수와그응용</strong><br/>공B042");
	$('#cell-49').attr("bgcolor", "#eeeeee");
	$('#cell-49').attr("rowspan", "2");
	$('#cell-410').remove();
	$('#cell-54').html("<strong>이산구조</strong><br/>공B039");
	$('#cell-54').attr("bgcolor", "#eeeeee");
	$('#cell-54').attr("rowspan", "3");
	$('#cell-55').remove();
	$('#cell-56').remove();
	$('#cell-57').html("<strong>연극의이해</strong><br/>백양관강당");
	$('#cell-57').attr("bgcolor", "#eeeeee");
	$('#cell-57').attr("rowspan", "2");
	$('#cell-58').remove();
}