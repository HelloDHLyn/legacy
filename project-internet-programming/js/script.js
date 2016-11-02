// Functions for join.php page
function validateId() {
	var id = document.getElementById("join-id").value;
	var valid = true;

	// Comment
	if (id.length < 6) {
		setIdComment("아이디는 5글자보다 길어야 합니다.");
		valid = false;
	}
	else if (id.length > 10) {
		setIdComment("아이디는 11글자보다 짧아야 합니다.");
		valid = false;
	}
	else if (id.match(/\d+/) == null) {
		setIdComment("아이디에는 숫자가 있어야 합니다.");
		valid = false;
	}
	else if (id.match(/[A-Z]/) == null) {
		setIdComment("아이디에는 영어 대문자가 있어야 합니다.");
		valid = false;
	}
	else if (id.match(/^[0-9a-zA-Z_]*$/) == null) {
		setIdComment("아이디는 영문자와 숫자, 밑줄 기호(_)로만 이루어져야 합니다.");
		valid = false;
	}
	else {
		var checkUrl = "script/duplicate.php?id=" + id;
		var data;
		var result;

		$.ajax({	
			headers: {'Access-Control-Allow-Origin': '*'}, 
			dataType: "json",   
			url: checkUrl, 
			data: data, 
			success: function(data) { 
				result = data.isMember;
				if (result == "true") {
					setIdComment("이미 존재하는 아이디입니다.");
					document.getElementById("join-id-comment").style.color = "#c0392b";
					valid = false;
				}
				else valid = true;
			}   
		}).error(function(XMLHttpRequest, textStatus, errorThrown) { 

		}).complete(function() { 

		});								
	}

	// Color
	if (!valid) {
		document.getElementById("join-id-comment").style.color = "#c0392b";
		document.getElementById("join-submit").disabled = true;
	} else {
		setIdComment("사용할 수 있는 아이디입니다.");
		document.getElementById("join-id-comment").style.color = "#2e8ece";
		document.getElementById("join-submit").disabled = false;
	}
}

function validatePassword() {
	var id = document.getElementById("join-password").value;
	var valid = true;

	// Comment
	if (id.length < 6) {
		setPasswordComment("비밀번호는 5글자보다 길어야 합니다.");
		valid = false;
	}
	else if (id.length > 10) {
		setPasswordComment("비밀번호는 11글자보다 짧아야 합니다.");
		valid = false;
	}
	else {
		var count = Array(128);
		for (var i = 0; i < id.length; i++) {
			if (i >= 2 && id.charAt(i).charCodeAt(0) - id.charAt(i - 1).charCodeAt(0) == 1 
				&& id.charAt(i - 1).charCodeAt(0) - id.charAt(i - 2).charCodeAt(0) == 1
				|| id.charAt(i).charCodeAt(0) - id.charAt(i - 1).charCodeAt(0) == -1 
				&& id.charAt(i - 1).charCodeAt(0) - id.charAt(i - 2).charCodeAt(0) == -1) {
				setPasswordComment("세 개 이상 연속된 문자를 사용할 수 없습니다.");
				valid = false;
			}

			if (count[id.charAt(i).charCodeAt(0)] == null) {
				count[id.charAt(i).charCodeAt(0)] = 1;
			} else {
				count[id.charAt(i).charCodeAt(0)]++;
				if (count[id.charAt(i).charCodeAt(0)] >= 3) {
					setPasswordComment("동일한 문자를 세 번 이상 사용할 수 없습니다.");
					valid = false;
				}
			}
		}
	}

	// Color
	if (!valid) {
		document.getElementById("join-password-comment").style.color = "#c0392b";
		document.getElementById("join-submit").disabled = true;
	} else {
		setPasswordComment("사용할 수 있는 비밀번호입니다.");
		document.getElementById("join-password-comment").style.color = "#2e8ece";
		document.getElementById("join-submit").disabled = false;
	}
}

function validatePasswordConfirm() {
	if (document.getElementById("join-password").value
		!= document.getElementById("join-password-confirm").value) {
		document.getElementById("join-password-confirm-comment").style.color = "#c0392b";
		document.getElementById("join-password-confirm-comment").innerHTML = "비밀번호가 일치하지 않습니다.";
		document.getElementById("join-submit").disabled = true;
	} else {
		document.getElementById("join-password-confirm-comment").style.color = "#2e8ece";
		document.getElementById("join-password-confirm-comment").innerHTML = "비밀번호가 일치합니다.";
		document.getElementById("join-submit").disabled = false;
	}
}

function setIdComment(comment) {
	document.getElementById("join-id-comment").innerHTML = comment;
}

function setPasswordComment(comment) {
	document.getElementById("join-password-comment").innerHTML = comment;
}

// Functions for admin page
function deleteMemberByCode(code) {
	var url = "script/delete_member.php?code=" + code;
	var data;

	$.ajax({	
		headers: {'Access-Control-Allow-Origin': '*'}, 
		dataType: "json",   
		url: url, 
		data: data, 
		success: function(data) { 
			alert("완료되었습니다!")	;
		}   
	}).error(function(XMLHttpRequest, textStatus, errorThrown) { 

	}).complete(function() { 

	});

	window.location.reload();
}