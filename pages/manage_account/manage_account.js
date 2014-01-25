$(document).ready(function() {
	
	$("#updateCoins").click(function() {
		data = {'action': 'getCredits', 'account_id': $(this).data("id")}
		
		$("#ajaxResponse").html("<div class='alert alert-info'><strong>Updating coins.....</strong></div>");
		
		$.post(window.AjaxURL, data, function(response) {
    			switch(response) {
    				case "1":
    					$("#ajaxResponse").html("<div class='alert alert-success'><strong>Coins updated successfully.</div>");
    				break;
    				case "2":
    					$("#ajaxResponse").html("<div class='alert alert-danger'><strong>Problem updating coins</div>")
    				break;
    				case "3":
    					$("#ajaxResponse").html("<div class='alert alert-danger'><strong>Session expired on account.</div>")
    				break;	
    				case "0":
    					$("#ajaxResponse").html("<div class='alert alert-danger'><strong>Problem with your AJAX Request.</div>")
    				break;
    			}
		});
	});
	
	$("#updateSession").click(function() {
		data = {'action': 'resetSession', 'account_id': $(this).data("id")}
		
		$("#ajaxResponse").html("<div class='alert alert-info'><strong>Updating session.....</strong></div>");
		
		$.post(window.AjaxURL, data, function(response) {
    			switch(response) {
    				case "1":
    					$("#ajaxResponse").html("<div class='alert alert-success'><strong>Session updated successfully.</div>");
    				break;
    				case "2":
    					$("#ajaxResponse").html("<div class='alert alert-danger'><strong>Problem updating session</div>")
    				break;
    				case "3":
    					$("#ajaxResponse").html("<div class='alert alert-danger'><strong>Failed to update database.</div>")
    				break;
    				case "4":
    					$("#ajaxResponse").html("<div class='alert alert-danger'><strong>Tampered with request.</div>")
    				break;	
    				case "0":
    					$("#ajaxResponse").html("<div class='alert alert-danger'><strong>Problem with your AJAX Request.</div>")
    				break;
    			}
		});
	});
	
});