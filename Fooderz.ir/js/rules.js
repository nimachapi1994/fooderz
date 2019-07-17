$(document).ready(function() {
	$(window).scroll(function () {
		if($(this).scrollTop() >= 0) {
			$('.pages_header').addClass("fixed_header")
			$('#main_navbar').addClass("fixed_navbar")
		}else if($(this).scrollTop() < 0){
			$('.pages_header').removeClass("fixed_header")
			$('#main_navbar').removeClass("fixed_navbar")
		}
	});
	
	$(".scroll").click(function (event) {
		event.preventDefault();
		$('html,body').animate({
			scrollTop: $(this.hash).offset().top
		}, 1000);
	});
	/*
	var defaults = {
	containerID: 'toTop', // fading element id
	containerHoverID: 'toTopHover', // fading element hover id
	scrollSpeed: 1200,
	easingType: 'linear' 
	};
	*/
	$().UItoTop({ easingType: 'easeOutQuart' });
	
	$('.rules-box').prepend("<i class='fa fa-book'></i>")
		
	
});