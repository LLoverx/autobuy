jQuery(document).ready(function() {
		
		var pusher = new Pusher('13a9585f5ff61142ee1e');
		var channel = pusher.subscribe('ab_event');
		channel.bind('notification', function(data) {
			jQuery.gritter.add({title: data.title,text: data.message,sticky: false});
		});
			
});