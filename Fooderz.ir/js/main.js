$(window).load(function() {
    $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider) {
            $('body').removeClass('loading');
        }
    });
});
$(document).ready(function() {
	function sind(angle) {return Math.sin(angle/180*Math.PI);};
	function cosd(angle) {return Math.cos(angle/180*Math.PI);};
	
	function load_search_map(){
		user_phi = [];
		user_landa = [];
		// get user location with GPS
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("متاسفانه اطلاعاتی از موقعیت یاب دستگاه شما دریافت نگردید!")
            }

        }
        function showPosition(position) {
				/**
			 * Initializing Map View
			 */

			// Getting maps info from a tileJSON source
			var tileJSONUrl = 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=' + L.cedarmaps.accessToken;
			
            var phi = position.coords.latitude;
            var landa = position.coords.longitude;
            user_phi.push(phi);
			user_landa.push(landa);
			
			// initializing map into div#search_map
			var map = L.cedarmaps.map('search_map', tileJSONUrl, {
				scrollWheelZoom: true,
				zoomControl: false,
				minZoom: 7,
				maxZoom: 17,
				maxBounds: [[25.064, 44.039],[39.771, 63.322]],  // Iran's bounding box
			}).setView([30, 50],15);
			
			var zoomControl = new L.Control.Zoom({position:'topleft'});
			zoomControl.addTo(map);
			/**
			 * Adding a marker with custom image
			 */

			
			var myIcon = L.icon({
				iconUrl: 'images/logo.png',
				iconSize: [34, 46],
				iconAnchor: [17, 41],
				popupAnchor: [-3, -46],
			});
			
             console.log(phiLanda)
            //show position with custom marker on map
            var marker2 = new L.marker([phi+0.0008, landa+0.008], {
                icon: myIcon
            }).addTo(map).bindPopup('<a href="restaurant-list.php">رستوران صوفی</a>').openPopup();
            var marker3 = new L.marker([phi-0.006, landa-0.006], {
                icon: myIcon
            }).addTo(map).bindPopup('<a href="restaurant-list.php">فست فود رایز</a>').openPopup();
            var marker = new L.marker([phi, landa], {
                icon: myIcon
            }).addTo(map).bindPopup('موقعیت شما!').openPopup();
			
			
			//convert lat_lon to x y UTM
			var coordinates = fromLatLon(phi, landa);
			xUTM = coordinates.easting;
			yUTM = coordinates.northing;
			alert(JSON.stringify(coordinates));
        }
        getLocation();
		
	}
	
	
	$('.page-loading').css('display', 'none');
	
    
    $("#owl-demo").owlCarousel({
        items: 5,
        lazyLoad: true,
        autoPlay: true,
        pagination: true,
    });
    $('.site_carousel').owlCarousel({
        loop: false,
        margin: 20,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: false
            },
			375: {
                items: 3,
                nav: false
            },
            480: {
                items: 4,
                nav: false
            },
            800: {
                items: 6,
                nav: false
            },
            1000: {
                items: 8,
                nav: true,
            }
        }
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
    // mobile app download links
    var items = document.querySelectorAll('.circle a');
    for (var i = 0, l = items.length; i < l; i++) {
        items[i].style.left = (50 - 35 * Math.cos(-0.5 * Math.PI - 2 * (1 / l) * i * Math.PI)).toFixed(4) + "%";
        items[i].style.top = (50 + 35 * Math.sin(-0.5 * Math.PI - 2 * (1 / l) * i * Math.PI)).toFixed(4) + "%";
    }
	
	
	document.querySelector('.menu-button').onclick = function(e) {
	   e.preventDefault(); document.querySelector('.circle').classList.toggle('open');
	}
	
	
	/* gallery animations */
	var controller = new ScrollMagic.Controller();
    new ScrollMagic.Scene({
        duration: 10,
        offset: 100,
    })
        .on('enter', function() {
            var tl = new TimelineMax();
			tl
				.fromTo("#gallery1", .8, {y:-200, autoAlpha:0, ease:Power4.easeOut}, {y: 0, autoAlpha:1},'+=0')
				.fromTo("#gallery2", .8, {y:400, autoAlpha:0, ease:Power4.easeOut}, {y: 0, autoAlpha:1},'-=.2')
				.fromTo("#gallery3", .8, {x:400, autoAlpha:0, ease:Power4.easeOut}, {x: 0, autoAlpha:1})
			;
        })
        .reverse(false)
        .addTo(controller)
    ;

	$('.location-input').select2({
		placeholder: "... جستجوی منطقه",
		allowClear: true
	});
	$('.select2-dropdown').addClass("animated fadeIn")
	
	
	// init search box map
	$('#search_locator').click(function(){
		$('.search_map_popup').css('display','block');
		load_search_map();
        $.post('ajax/near_res_ajax.php', {}, function(ex) 
        {
            phiLanda = ex;
            console.log(phiLanda);
        });
	});
	
	
	
});
$("#smsApp").click(function(){
    var phone = $("#smsPhone").val()
    $.post('js/appSmsAjax.php', {phone: phone}, function(ex) {
    });
    $("#app_get_modal").modal('hide')
});



