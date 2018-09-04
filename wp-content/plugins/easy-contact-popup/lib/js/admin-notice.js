;(function($){
	$(document).ready(function(){
		$('.notice-dismiss').on('click', function(){
			var url = new URL( location.href );
			url.searchParams.append('dismissed', 'yes');
			location.href = url;
		});
	});
})(jQuery)
