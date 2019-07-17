$(document).ready(function() {
	//dropdown function
	$(".dropdown").click(function(){
		$(".drop-menu").toggleClass("showMenu");
		$(".drop-menu > li").click(function(){
			$(".dropdown > p").html($(this).html());
			$(".drop-menu").removeClass("showMenu");
		});
	});
	
	//panel pages sidebar open & close
	$('.panel_menu_btn').click(function(){
		var side_height = $('.panel_sidebar').css('height');
		if(side_height == "1px"){
			$('.panel_sidebar').animate({height:"333px"},500);
		}else{
			$('.panel_sidebar').animate({height:"1px"},500);
		}
        //close this box when clicking outside of that
        var mouse_is_inside = false;
        $('.panel_sidebar').click(function(){
            mouse_is_inside=true;
        }, function(){
            mouse_is_inside=false;
        });

        $("body").mouseup(function(){
            if(! mouse_is_inside){
                $('.panel_sidebar').animate({height:"1px"},500);
			}
        });
	})


	
	//provider panel tabs selection
	$('#manager_info_tab').click(function(){
		$('.panel_sidebar nav ul li').removeClass("active")
		$(this).addClass("active");
		$('.panel_bar').removeClass("active");
		$('#manager_info_panel').addClass("active");
	});
	$('#restaurant_info_tab').click(function(){
		$('.panel_sidebar nav ul li').removeClass("active")
		$(this).addClass("active");
		$('.panel_bar').removeClass("active");
		$('#restaurant_info_panel').addClass("active");
	});
    $('#gift_tab').click(function(){
        $('.panel_sidebar nav ul li').removeClass("active")
        $(this).addClass("active");
        $('.panel_bar').removeClass("active");
        $('#gift_panel').addClass("active");
    });
    $('#report_tab').click(function(){
        $('.panel_sidebar nav ul li').removeClass("active")
        $(this).addClass("active");
        $('.panel_bar').removeClass("active");
        $('#report_panel').addClass("active");
    });
	
	
	// providers panel page internal tabs
	$('.panel_main_tabs .tabs').click(function(){
		$('.panel_main_tabs .tabs').removeClass("active");
		$(this).addClass("active");
	})
	
	$('#restaurant_inform_tab').click(function(){
		$('.internal_tab_form').css('display','none');
		$('#restaurant_info_form').css('display','block');
	})
	
	$('#add_menu_tab').click(function(){
		$('.internal_tab_form').css('display','none');
		$('#add_menu_form').css('display','block');
	})
	
	//add menu accordion
	$('.nested-accordion').find('.comment').slideUp();
	$('.nested-accordion').find('h3').click(function(){
	  $(this).next('.comment').slideToggle(100);
	  $(this).toggleClass('selected');
	});

	
	$('.menu-box .category_title').prepend("<i class='fas fa-utensils'></i>");
});