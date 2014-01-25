$(document).ready(function() {

	$('#loginForm').submit(function(event) {
		event.preventDefault();
		
		var Email = $('#email').val();
		var Password = $('#password').val();
		
		if(Email == "" || Password == "") {
			$("#ajaxResponse").html("<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>X</button><strong>Email</strong> and <strong>Password</strong> is required!</div>");
			return;
		}
		
	
		data = {'action': 'login', 'email': Email, 'password': Password}
		
		$.ajax({
			type: "GET",
			url: window.AjaxURL,
			data: data,
			success: function(data) {
				switch(data) {
					case "0":
						$("#ajaxResponse").html("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>X</button><strong>Error: </strong> A problem occured in the AJAX!</div>");
					break;
					case "1":
						$("#ajaxResponse").html("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>X</button><strong>Login Successful</strong> redirecting.....</div>");
						window.setTimeout(function() {window.location.href = '/dashboard';}, 2000);
					break;
					case "2":
						$("#ajaxResponse").html("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>X</button><strong>Email</strong> or <strong>Password</strong> is incorrect!</div>");
					break;
					default:
						alert(data);
					break;
				}
			},
			error: function() {
				$("#ajaxResponse").html("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>X</button><strong>Error: </strong> A problem occured in the AJAX!</div>");
			}
		});
	});
	
});