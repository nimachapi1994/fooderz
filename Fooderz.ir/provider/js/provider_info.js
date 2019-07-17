$(document).ready(function() {
	try {
        L.cedarmaps.accessToken = '2374c97ee766c2601aeb47a86129f09b50f4e675';
    } catch (err) {
        throw new Error('You need to get an access token to be able to use cedarmaps SDK. ' +
        'Send us an email to <info@cedar.ir>');
    }
	
	/**
         * Initilizing Map View
         */

        // Getting maps info from a tileJSON source
        var tileJSONUrl = 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=' + L.cedarmaps.accessToken;

        // initilizing map into div
        var map = L.cedarmaps.map('map', tileJSONUrl, {
            scrollWheelZoom: true,
            zoomControl: false,
            minZoom: 7,
            maxZoom: 17,
            maxBounds: [[25.064, 44.039],[39.771, 63.322]],  // Iran's bounding box
        }).setView([35.757448286487595, 51.40876293182373], 2);

        var zoomControl = new L.Control.Zoom({position:'topleft'});
        zoomControl.addTo(map);
        /**
         * Adding a Leaflet marker with custom image
         */

        var myIcon = L.icon({
            iconUrl: '../images/logo.png',
            iconSize: [34, 46],
            iconAnchor: [17, 41],
            popupAnchor: [-3, -46],
        });

        var marker = new L.marker([35.757448286487595, 51.40876293182373], {
            icon: myIcon
        }).addTo(map);

        var popupOptions = {
            offset: new L.Point(2, 14),
            closeButton: false,
            autoPan: false
        };
        marker.bindPopup('رستوران صوفی', popupOptions).openPopup();
	
	//dropdown function
	$(".dropdown").click(function(){
		$(".drop-menu").toggleClass("showMenu");
		$(".drop-menu > li").click(function(){
			$(".dropdown > p").html($(this).html());
			$(".drop-menu").removeClass("showMenu");
		});
	});
	
	//panel pages sidebar open & close
	function close_menu(){
		var menu_tl = new TimelineMax();
		menu_tl
			.fromTo(".mobile-menu", .5, {right: "0px"}, {right:"-300px"})
			.fromTo(".menu_transparent_layer", .5, {autoAlpha: 1}, {autoAlpha:0},'-=.5')
		;
	}
	$('.panel_menu_btn').click(function(){
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
		close_menu();
		$(this).css('display', 'none');
	});


	
	//provider panel tabs selection
	$('#manager_info_tab').click(function(){
		$('.panel_sidebar nav ul li').removeClass("active")
		$(this).addClass("active");
		$('.panel_bar').removeClass("active");
		$('#manager_info_panel').addClass("active");
	});
	$('#manager_info_tab2').click(function(){
		$('.panel_bar').removeClass("active");
		$('#manager_info_panel').addClass("active");
		close_menu();
	});
	$('#restaurant_info_tab').click(function(){
		$('.panel_sidebar nav ul li').removeClass("active")
		$(this).addClass("active");
		$('.panel_bar').removeClass("active");
		$('#restaurant_info_panel').addClass("active");
	});
	$('#restaurant_info_tab2').click(function(){
		$('.panel_bar').removeClass("active");
		$('#restaurant_info_panel').addClass("active");
		close_menu();
	});
	$('#peyk_tab').click(function(){
        $('.panel_sidebar nav ul li').removeClass("active")
        $(this).addClass("active");
        $('.panel_bar').removeClass("active");
        $('#peyk_panel').addClass("active");
    });
	$('#peyk_tab2').click(function(){
        $('.panel_bar').removeClass("active");
        $('#peyk_panel').addClass("active");
		close_menu();
    });
    $('#gift_tab').click(function(){
        $('.panel_sidebar nav ul li').removeClass("active")
        $(this).addClass("active");
        $('.panel_bar').removeClass("active");
        $('#gift_panel').addClass("active");
    });
	$('#gift_tab2').click(function(){
        $('.panel_bar').removeClass("active");
        $('#gift_panel').addClass("active");
		close_menu();
    });
    $('#report_tab, #see_new_order').click(function(){
        $('.panel_sidebar nav ul li').removeClass("active")
        $(this).addClass("active");
        $('.panel_bar').removeClass("active");
        $('#report_panel').addClass("active");
		$('.popup_back_layer').css("display", "none");
        // order_list();
    });
	$('#report_tab2').click(function(){
        $('.panel_bar').removeClass("active");
        $('#report_panel').addClass("active");
		close_menu();
        // order_list();
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
	
	$('.popup .close').click(function(){
		$('.popup_back_layer').css("display", "none");
	});
	
	
	
});