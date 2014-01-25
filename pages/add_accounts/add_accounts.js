$(document).ready(function() {
	
	$('input[name="consoleOption"]:radio').change(function() {
		switch($('input[name=consoleOption]:checked').val()) {
			case "360":
				$('#selectedOption').val("360");
			break;
			case "ps3":
				$('#selectedOption').val("PS3");
			break;
		}
	});
	
	$('#addAccount').submit(function(event) {
		event.preventDefault();
		
		var EAEmail = $('#email').val();
		var EAPassword = $('#password').val();
		var EASecret = $('#secret').val();
		var Console = $('#selectedOption').val();
		
		if(EAEmail === "" || EAPassword === "" || EASecret === "") {
			$("#ajaxResponse").html("<div class='alert alert-info'><strong>All fields</strong> are required!</div>");
			return;
		}
		
		$("#ajaxResponse").html("<div class='alert alert-info'><strong>Adding account.....</strong></div>");
		
		data = {'action': 'submitAccount', 'email': EAEmail, 'password': EAPassword, 'secret': EASecret, 'console': Console}
		
		$.get(window.AjaxURL, data, function(response) {
    			switch(response) {
    				case "1":
    					$("#ajaxResponse").html("<div class='alert alert-success'><strong>Added account successfully.</div>");
    				break;
    				case "2":
    					$("#ajaxResponse").html("<div class='alert alert-danger'><strong>Invalid EA credentials.</div>")
    				break;
    				case "3":
    					$("#ajaxResponse").html("<div class='alert alert-danger'><strong>Error adding account.</div>")
    				break;	
    				case "0":
    					$("#ajaxResponse").html("<div class='alert alert-danger'><strong>Problem with your AJAX Request.</div>")
    				break;
    			}
		});
	});
	
});