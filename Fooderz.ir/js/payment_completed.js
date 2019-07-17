$(document).ready(function() {
    $('.delay_btn').click(function(){
		var disp = $('.delay_message').css('display');
		if(disp === "none"){
			$('.delay_message').css('display','block');
		} else if(disp === "block"){
			$('.delay_message').css('display','none');
		}
	});
});