function poll() {
		var lastId = "";
		$.get('index.php?r=booking/longpoll').then(function(data) {
		        // the request ended, reload ajax
			   alert('NEW BOOKING');
			   $.pjax.reload({container:"#pjaxBookings", timeout: 5000});
		        
				poll();
		    }, function(){
		        // a HTTP error occurred (probable a timeout), just repoll
		        poll();
		    });
		}

$(document).ready(function() {
	poll();
});
