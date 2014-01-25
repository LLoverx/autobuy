$(document).ready(function() {
	
	$("#autoupdate").change(function() {
  		switch($(this).val()) {
  			case "0":
  				$('#max_bin').show();
  				$('#sell_bin').show();
  			break;
  			case "1":
  				$('#max_bin').hide();
  				$('#sell_bin').hide();
  			break;
  		}
	});
	
	$("#updatePlayer").submit(function(event) {
		event.preventDefault();
		
		data = {'action': 'updatePlayer', 'data': $(this).serialize()}
		
		$.get(window.AjaxURL, data, function(response) {
    			switch(response) {
    				case "1":
    					$("#ajaxResponse").html("<div class='alert alert-success'><strong>Player updated successfully.</div>");
    				break;
    				case "2":
    					$("#ajaxResponse").html("<div class='alert alert-danger'><strong>Failed to update player.</div>")
    				break;
    				case "0":
    					$("#ajaxResponse").html("<div class='alert alert-danger'><strong>Problem with your AJAX Request.</div>")
    				break;
    			}
		});
	});
	
});