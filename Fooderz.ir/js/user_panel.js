$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 0) {
            $('.pages_header').addClass("fixed_header")
            $('#main_navbar').addClass("fixed_navbar")
        } else if ($(this).scrollTop() < 0) {
            $('.pages_header').removeClass("fixed_header")
            $('#main_navbar').removeClass("fixed_navbar")
        }
    });
    $(".scroll").click(function(event) {
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
    $().UItoTop({
        easingType: 'easeOutQuart'
    });
    $('input, textarea').focus(function() {
        var parent = $(this).parent();
        var label = parent[0].childNodes[1];
        $(label).css('top', '-15px')
    })
    var info_tl = new TimelineMax().repeat(-1);
    info_tl.fromTo("#user_svg_circle", 25, {
        rotation: 0,
        transformOrigin: "center center"
    }, {
        rotation: 360
    });
    var pen_tl = new TimelineMax().repeat(-1).yoyo(true);
    pen_tl.to("#user_svg_pen", 1, {
        x: "-20px"
    }, "-=25").to("#user_svg_pen", 1, {
        x: "20px"
    }, "-=24");
    const items = document.querySelectorAll(".order_accordion header");

    function toggleAccordion() {
        x = $(this).parent().children('.content.factor')
        pid = x.attr('PID')
        $.post('cus_order_detail_modal_ajax.php', {pid: pid}, function(ex) {
            x.html(ex)

        });
        this.classList.toggle('active');
        this.nextElementSibling.classList.toggle('active');

        // $("header").click(function() {
        // });
    }
    items.forEach(item => item.addEventListener('click', toggleAccordion));
    $('.panel_slider .tabs button').click(function() {
        $('.panel_slider .tabs button').removeClass("active");
        $(this).addClass("active");
        $('.user_tab_content').css('display', 'none');
    });
    $('#user_info_tab').click(function() {
        $('#user_info').css('display', 'block');
    });
    $('#wallet_tab').click(function() {
        $('#wallet').css('display', 'block');
    });
    $('#recent_orders_tab').click(function() {
        $('#recent_orders').css('display', 'block');
    });
    $('#addresses_tab').click(function() {
        $('#addresses').css('display', 'block');
    });
    $('#liked_restaurants_tab').click(function() {
        $('#liked_restaurants').css('display', 'block');
    });
    var wallet_tl = new TimelineMax().repeat(-1);
    wallet_tl.to("#wallet-icon", .2, {
        fill: "yellow"
    })
	
	
	$('#save').click(function()
	{
		// alert($('#info_ajax').serialize())
		$.post('user_panel_ajax.php', $('#info_ajax').serialize(), function(data, sts) {
			alert(data)
		});
	});
	$('#addressBtn').click(function(){
		$.post('address_ajax.php', $('#addressForm').serialize(), function(data, sts) {
			$('#addresses .info').html(data)
		});
		$('#address-modal').modal("hide");
	});
	$(document).ready(function() {
		$.post('address_ajax.php', {}, function(ex)
		{
			$('#addresses .info').html(ex)
		});
	});
	$("#liked_restaurants_tab").click(function(){
		$.post('favorite_ajax.php', {}, function(ex,s) {
       		$("#item_ajax").html(ex);
        });
	});
	$(document).ready(function() {
		$.post('favorite_ajax.php', {}, function(data) {
			$("#item_ajax").html(data);
		});
	});
	
});