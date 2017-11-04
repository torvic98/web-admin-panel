$(document).ready(function(){
	$("a.mobile").click(function(){
		$(".sidebar").slideToggle("fast");
	});

	window.onresize = function (event) {
		if($(window).width() > 767){
			$(".sidebar").show();
		}
	}

	$('.spoiler .box-top').click(function(e) {  
		var collapse = $(this).parent().children(".box-panel");
		$(this).toggleClass("icon-drop-down");
		$(this).toggleClass("icon-drop-up");
		$(collapse).slideToggle("fast");
	});
});