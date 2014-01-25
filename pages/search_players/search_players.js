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
	
	$('#searchPlayer').submit(function(event) {
		event.preventDefault();
		
		$('#loadingHolder').css( "display", "block");
		
		var Id = $('#fid').val();
		var Level = $('#flevel').val();
		var Rating = $('#frating').val();
		var Nation = $('#fnation').val();
		var Club = $('#fclub').val();
		var Position = $('#player_position').val();
		var Console = $('#selectedOption').val();
		
		if(Id === "") {
			$("#ajaxResponse").html("<div class='alert alert-info'><strong>Player</strong> not selected!</div>");
			return;
		}
		
		data = {'action': 'getPlayer', 'level': Level, 'id': Id, 'rating': Rating, 'nation': Nation, 'club': Club, 'position': Position, 'console': Console}
		
		$.get(window.AjaxURL, data, function(response) {
    			$('#loadingHolder').css( "display", "none");
    			$('#responseResult').html(response);
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
			$('#fdisplay').val(ui.item.full_name);
			$('#fname').val(ui.item.full_name);
			$('#flevel').val(get_level_display(ui.item.level));
			$('#frating').val(ui.item.rating);
			$('#fid').val(ui.item.player_id);
			$('#fclub').val(clubid);
        		$('#fnation').val(nationid);
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