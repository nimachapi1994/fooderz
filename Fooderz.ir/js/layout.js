$(document).ready(function() {
	
	try {
        L.cedarmaps.accessToken = '2374c97ee766c2601aeb47a86129f09b50f4e675';
    } catch (err) {
        throw new Error('You need to get an access token to be able to use cedarmaps SDK. ' +
        'Send us an email to <info@cedar.ir>');
    }
	
	
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 100) {
            $('#main_header').addClass("fixed_header animated fadeInDown")
            $('#main_navbar').addClass("fixed_navbar")
			$('.sidebar-filter.grid-page').css('margin-top','75px')
            $('.fooderz-header').addClass("fixed animated fadeInDown")
        } else if ($(this).scrollTop() < 100) {
            $('#main_header').removeClass("fixed_header animated fadeInDown")
            $('#main_navbar').removeClass("fixed_navbar")
			$('.fooderz-header').removeClass("fixed animated fadeInDown")
			$('.sidebar-filter.grid-page').css('margin-top','0px')
        }
    });
	
	$('#toTop').click(function(){
		$('html, body').animate({
			scrollTop: $( $(this).attr('href') ).offset().top
		}, 700);
		return false;
	});
	
    $(".scroll").click(function(event) {
        event.preventDefault();
        $('html,body').animate({
            scrollTop: $(this.hash).offset().top
        }, 1000);
    });
	
	$().UItoTop({ easingType: 'easeOutQuart' });
	
	
    // function login_validate() {
    $('#login_submit').click(function() {
        $('#login-cont-form h6').html('شماره موبایل : ' + $('#login').val());
        $.post('logIn_ajax.php', {
            phone: $('#login').val()
        }, function(ex) {
            if (ex === '2') {
                $('#login-form').css('display', 'none');
                $('#confirm_code').css('display', 'block');
            } else if (ex == 'phone_exist') {
                $('#login-form').css('display', 'none');
                $('#login-cont-form').css('display', 'block');
            }
        });
    })
    $('#confirm_code_submit').click(function() {
        $.post('logIn_ajax.php', {
            cnfCode: $('#confirm_code_inp').val()
        }, function(ex) {
            if (ex == 'sms_confirmed') {
                $('#formFooter').css('display', 'none');
                $('#confirm_code').css('display', 'none');
                $('#signup-form').css('display', 'block');
            }
        });
    });

    function forgetpass() {
        $('.forgetpass-link').click(function() {
            $.post('logIn_ajax.php', {
                forget: 'pass'
            }, function(ex) {
            });

            $('#confirm_code').css('display', 'block');
            $('#login-form').css('display', 'none');
            $('#formFooter').css('display', 'none');
            $('#login-cont-form').css('display', 'none');
            $('#forgetpass h6').css('margin-top', '20px');
        })
        $('#forgetpass_submit').click(function() {
            $('#confirm_code').css('display', 'block');
            $('#forgetpass').css('display', 'none');
        })
        $('#signup_submit').click(function() {
            var pass = $('#pass').val();
            var rePass = $('#rePass').val();
            if (rePass == pass) {
                $.post('logIn_ajax.php', {
                    pass: $('#pass').val(),
                    rePass: $('#rePass').val()
                }, function(ex) {
                    if (ex === 'pass_saved') {
                        $('#signup-form').css('display', 'none');
                        $('#enter').html('<a href="user_panel.php">ورود به پنل</a>');
                    }
                });
            }
        })
        $('#signin_submit').click(function() {
            $.post('logIn_ajax.php', {
                enTpass: $('#login_pass').val(),
            }, function(ex) {
                alert(ex)
                if (ex=='login') {
	    	      $( location ).attr("href", 'index.php');
                };
            });
        })
    }
    forgetpass();
	
	
	$('#mobile-menu-icon').click(function(){
		var position = $('.mobile-menu').css('right');
		if (position === "-300px"){
			$('.menu_transparent_layer').css('display','block');
			var menu_tl = new TimelineMax();
			menu_tl
				.fromTo(".mobile-menu", .5, {right: "-300px"}, {right:"0px"})
				.fromTo(".menu_transparent_layer", .5, {autoAlpha: 0}, {autoAlpha:1},'-=.5')
			;
		}else if (position === "0px"){
			var menu_tl = new TimelineMax();
			menu_tl.fromTo(".mobile-menu", .5, {right: "0px"}, {right:"-300px"});
		}
	});
	$('.menu_transparent_layer').click(function(){
		var menu_tl = new TimelineMax();
		menu_tl
			.fromTo(".mobile-menu", .5, {right: "0px"}, {right:"-300px"})
			.fromTo(".menu_transparent_layer", .5, {autoAlpha: 1}, {autoAlpha:0},'-=.5')
		;
		$(this).css('display', 'none');
	});
	
	// panel dropdown toggle
	$('#user-panel-toggle').click(function(){
		var disp = $('#panel-dropdown').css('display');
		if(disp == "none"){
			$('#panel-dropdown').css('display', 'block');
		}else{
			$('#panel-dropdown').css('display', 'none');
		}
		//close this box when clicking outside of that
        var mouse_is_inside = false;
        $('#panel-dropdown').hover(function(){
            mouse_is_inside=true;
        }, function(){
            mouse_is_inside=false;
        });

        $("body").mouseup(function(){
            if(! mouse_is_inside){
                $('#panel-dropdown').css('display', 'none');
			}
        });
	});

    $('.fooderz-footer .namad').owlCarousel({
        loop: false,
        margin: 40,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            440: {
                items: 1,
                nav: false
            },
            768: {
                items: 3,
                nav: false
            },
            1000: {
                items: 2,
                nav: false,
            }
        }
    });
	
});