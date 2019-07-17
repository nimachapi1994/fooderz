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
	
	
	/* select provider restaurant location on map  */
	// get user location with GPS
        var xx = [];
        var yy = [];
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("error!")
            }

        }
        function showPosition(position) {
            var phi = position.coords.latitude;
            var landa = position.coords.longitude;
            xx.push(position.coords.latitude);
            yy.push(position.coords.longitude);
            //show position with custom marker on map
            var marker = new L.marker([phi, landa], {
                icon: myIcon
            }).addTo(map).bindPopup('موقعیت شما!').openPopup();
			
			//get coordinates of selected location
			map.on('click', function(e){
			  var coord = e.latlng;
			  // restaurant's latitude
			  var lat = coord.lat;
			  // restaurant's longitude
			  var lng = coord.lng;
			  if (marker != undefined) {
				  map.removeLayer(marker);
			  }else{
				var i =1;
			  }
			  marker = L.marker([lat,lng], {
				icon: myIcon
			  }).addTo(map).bindPopup('رستوران صوفی').openPopup();
			  
			  //convert lat_lon to x y UTM
				var coordinates = fromLatLon(lat, lng);
				xUTM = coordinates.easting;
				yUTM = coordinates.northing;
				
				var location_coords = {
					phi: lat,
					landa: lng,
					x: xUTM,
					y: yUTM,
				}
				
				$('#hidden_coords').val(JSON.stringify(location_coords));
				
			});
        }
        getLocation();



        /**
         * Initilizing Map View
         */

        // Getting maps info from a tileJSON source
        var tileJSONUrl = 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=' + L.cedarmaps.accessToken;

        // initilizing map into div#map
        var map = L.cedarmaps.map('map', tileJSONUrl, {
            scrollWheelZoom: true,
            zoomControl: false,
            minZoom: 7,
            maxZoom: 17,
            maxBounds: [[25.064, 44.039],[39.771, 63.322]],  // Iran's bounding box
        }).setView([0, 0], 17);

        var zoomControl = new L.Control.Zoom({position:'topleft'});
        zoomControl.addTo(map);
        /**
         * Adding a Leaflet marker with custom image
         */

        // see: http://leafletjs.com/reference.html#marker
        var myIcon = L.icon({
            iconUrl: 'images/logo.png',
            iconSize: [34, 46],
            iconAnchor: [17, 41],
            popupAnchor: [-3, -46],
        });
		
		
		
		
		
		
		

	
	
		
	
});