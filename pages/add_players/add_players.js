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
	
	$('#addPlayer').submit(function(event) {
		event.preventDefault();
		
		var PlayerID = $('#player_id').val();
		if(PlayerID === "") {
			$("#ajaxResponse").html("<div class='alert alert-info'><strong>Player</strong> not selected!</div>");
			return;
		}
		
		data = {'action': 'submitPlayer', 'info': $(this).serialize()}
		
		$.post(window.AjaxURL, data, function(response) {
    			switch(response) {
    				case "1":
    					$("#ajaxResponse").html("<div class='alert alert-success'><strong>Player account successfully.</div>");
    				break;
    				case "3":
    					$("#ajaxResponse").html("<div class='alert alert-danger'><strong>Error adding player.</div>")
    				break;	
    				case "0":
    					$("#ajaxResponse").html("<div class='alert alert-danger'><strong>Problem with your AJAX Request.</div>")
    				break;
    			}
		});
		
	});
	
	function get_level_display(level){
		switch(level) {
			case 0:
				return 'gold';
			break;
			case 1:
				return 'silver';
			break;
			case 2:
				return 'bronze';
			break;
		}
	}
	
	homepagesearch = $('#player_search');
	homepagesearch.focus();
	homepagesearch.keydown(function () {
    		homepagesearch.css('background-image', 'None');
	})
	homepagesearch.autocomplete({
    		autoFocus: true,
    		minLength: 3,
    		delay: 500,
    		source: '/api/',
    		select: function (event, ui) {
        		var url = ui.item.nation_image;
			var cluburl = ui.item.club_image;
			var nationid = ((url.split(".")[2]).split("/"))[4];
			var clubid = ((cluburl.split(".")[2]).split("/"))[5];
        		$('#player_id').val(ui.item.player_id);
        		$('#player_name').val(ui.item.full_name);
        		$('#club_id').val(clubid);
        		$('#nation_id').val(nationid);
        		$('#rating').val(ui.item.rating);
        		switch(ui.item.revision_type) {
        			case null:
        				$('#revision_type').val("normal");
        			break;
        			default:
        				$('#revision_type').val(ui.item.revision_type);
        			break;
        		}
        		$('#attr1').val(ui.item.attr1);
        		$('#attr2').val(ui.item.attr2);
        		$('#attr3').val(ui.item.attr3);
        		$('#attr4').val(ui.item.attr4);
        		$('#attr5').val(ui.item.attr5);
        		$('#attr6').val(ui.item.attr6);
        		$('#level').val(get_level_display(ui.item.level));
        		$('#player_search').hide();
        		$('#name_display').show();
        		$('#name_display').val(ui.item.full_name);
        		
        		return false;
    		}
	}).data("ui-autocomplete")._renderItem = function (ul, item) {
    		$(ul).addClass("quicksearch short");
    		var rating_color = get_level_display(item.level);
    		var revision = item.revision_type ? item.revision_type.toLowerCase() : '';
    		return $("<li></li>").data("item.autocomplete", item).append('<a data-id="' + item.id + '" data-slug="' + item.slug + '"><img class="clubpicture" src="' + item.club_image + '" /><img class="nationpicture" src="' + item.nation_image + '" /><span class="name">' + item.short_name + '</span> (' + item.position + ') <span class="rating ' + rating_color + ' ' + revision + '">' + item.rating + '</span></a>').appendTo(ul);
	};
	
});