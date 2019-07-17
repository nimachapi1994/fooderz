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

        // initilizing map into div#map
        var map = L.cedarmaps.map('map', tileJSONUrl, {
            scrollWheelZoom: true
        }).setView([35.757448286487595, 51.40876293182373], 15);

        /**
         * Initilizing Direction
         */
        var direction = L.cedarmaps.direction();

        // Points should be separated by a semicolon. e.g.: lat,lng;lat,lng;lat,lng....
        // You can provide up to 100 stops (including start, middle and end points) for a direction request. Here we provided 3.
        direction.route('cedarmaps.driving', '35.764335,51.365622;35.7604311,51.3939486;35.7474946,51.2429727', function(err, json) {
                var RouteGeometry = json.result.routes[0].geometry;

                var RouteLayer = L.geoJSON(RouteGeometry, {
                    // for more styling options check out: https://leafletjs.com/reference-1.3.0.html#path-option
                    style: function(feature) {
                        return {
                            color: 'red',
                            weight: 5
                        }
                    }
                }).addTo(map);

                map.fitBounds(RouteLayer.getBounds());
        });
			
        
	
	
	
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
	
	$('.input-holder input,.input-holder textarea').focus(function(){
		var parent = $(this).parent();
		var label = parent[0].childNodes[1];
		$(label).css('top','-15px')
	})
	
	$('.paying-method').click(function(){
		$('.paying-method').removeClass("active");
		$(this).addClass("active");
	});
	$('.checkout-box .address').click(function(){
		$('.checkout-box .address').removeClass("selected");
		$(this).addClass("selected");
	})
		
	
});