// JavaScript Document
jQuery(document).ready(function() {
	"use strict";
	var map;
	var myLatLng = new google.maps.LatLng(51.49470893019127, -0.10170936584472656)
	//Initialize MAP
	var myOptions = {
	zoom: 17,
	center: myLatLng,
	disableDefaultUI: true,
	zoomControl: true,
	mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	
	map = new google.maps.Map(document.getElementById('map_canvas-2'),myOptions);

	//End Initialize MAP
	//Set Marker
	var marker = new google.maps.Marker({
	position: map.getCenter(),
	map: map
	});
	marker.getPosition();
	//End marker
	//Set info window
	var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">Address</h1>'+
      '<div id="bodyContent">'+
      '<p> <i class="icon-map-marker"></i> Via Ludovisi 39-45, Rome, 54267, New York city<br>' +
      '<i class="icon-mobile-phone"></i> 1.234.345.567<br>'+
      '<i class="icon-envelope"></i> info@company.org<br>'+
      '</p>'+
      '</div>'+
      '</div>';
	
	var infowindow = new google.maps.InfoWindow({
	content: contentString,
	position: myLatLng
	});
	infowindow.open(map);
	
	
	window.onload=function(){
	// Run code
		$('.hideme').hide();
	};
});

jQuery(document).ready(function() {
		"use strict";
	var map;
	var myLatLng = new google.maps.LatLng(51.49470893019127, -0.10170936584472656)
	//Initialize MAP
	var myOptions = {
	zoom: 17,
	center: myLatLng,
	disableDefaultUI: true,
	zoomControl: true,
	mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById('map_canvas-3'),myOptions);
	//End Initialize MAP
	//Set Marker
	var marker = new google.maps.Marker({
	position: map.getCenter(),
	map: map
	});
	marker.getPosition();
	//End marker
	//Set info window
	var infowindow = new google.maps.InfoWindow({
	content: '',
	position: myLatLng
	});
	infowindow.open(map);
});

jQuery(document).ready(function() {
	"use strict";
	var map;
	var myLatLng = new google.maps.LatLng(51.49470893019127, -0.10170936584472656)
	//Initialize MAP
	var myOptions = {
	zoom: 17,
	center: myLatLng,
	disableDefaultUI: true,
	zoomControl: true,
	mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById('map_canvas-4'),myOptions);
	//End Initialize MAP
	//Set Marker
	var marker = new google.maps.Marker({
	position: map.getCenter(),
	map: map
	});
	marker.getPosition();
	//End marker
	//Set info window
	var infowindow = new google.maps.InfoWindow({
	content: '',
	position: myLatLng
	});
	infowindow.open(map);
});

jQuery(document).ready(function() {
	"use strict";
	var map;
	var myLatLng = new google.maps.LatLng(51.49470893019127, -0.10170936584472656)
	//Initialize MAP
	var myOptions = {
	zoom: 17,
	center: myLatLng,
	disableDefaultUI: true,
	zoomControl: true,
	mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById('map_canvas-5'),myOptions);
	//End Initialize MAP
	//Set Marker
	var marker = new google.maps.Marker({
	position: map.getCenter(),
	map: map
	});
	marker.getPosition();
	//End marker
	//Set info window
	var infowindow = new google.maps.InfoWindow({
	content: '',
	position: myLatLng
	});
	infowindow.open(map);
});
//Toggle Map Function
function click_toggle(post_id){
	//Find and Show this
	if(jQuery('#map_canvas-'+post_id).hasClass('hideme')){
		jQuery('#map_canvas-'+post_id ).slideDown();
		jQuery('#map_canvas-'+post_id ).addClass('active');
		jQuery('#map_canvas-'+post_id ).removeClass('hideme');
	}else{
		jQuery('#map_canvas-'+post_id ).slideUp();
		jQuery('#map_canvas-'+post_id ).removeClass('active');
		jQuery('#map_canvas-'+post_id ).addClass('hideme');
	}
} 