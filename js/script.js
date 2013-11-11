/** 
* Kattagami javascript files
* Author: Gilles Vauvarin
*
* This file should contain any js scripts you want to add to the site.
* Instead of calling it in the header or throwing it inside wp-head()
* this file will be called automatically in the footer so as not to 
* slow the page load.
*/


// Modernizr.load loading the right scripts only if you need them
Modernizr.load([
	{
	    // Let's see if we need to load css3-mediaqueries.min.js and selectivizr-1.0.3b.min.js
	    test : Modernizr.mq('only all and (min-width: 0px)'), // Media queries are supported by all browsers except IE6-8
	  
	    // Modernizr.load loads css3-mediaqueries.min.js and selectivizr-1.0.3b.min.js for IE6-8
	    nope : [ThemeJSPath.theme_js_path + '/library/css3-mediaqueries.min.js', ThemeJSPath.theme_js_path + '/library/selectivizr-1.0.3b.min.js']
	}
]);


jQuery(document).ready(function() {

		

    /* The code here is executed on page load */
 
    /*  
    * -------------------------- YOUR ATTENTION PLEASE! --------------------------
    *
    * If you load the WordPress jQuery script by the wp_enqueue_script() function 
    * use the identifier "jQuery" (in this file) instead of "$" to avoid conflict 
    * with WordPress. 
    * 
    * ----------------------------------------------------------------------------
    */

    // jQuery Scripts here !

    /** 
     * Javascript to load a larger image where necessary 
 	 *
 	 * Responsive Enhance - joshje 
 	 * https://github.com/joshje/Responsive-Enhance
     */
     if ( jQuery(window).width() > 960 ) {
     	responsiveEnhance(jQuery('.responsive-img-presentations'), 39);
     }

    /** 
    * Javascript to load the map
 	*
 	* Leaflet
 	* 
    */
    if ( yatta_map && yatta_map['address_data'] ) { 

    	// Default value (London)
    	var yatta_lat_center = 51.50;
    	var yatta_long_center = -0.09;

    	if ( yatta_map['address_data'][0]['address']['lat'] && yatta_map['address_data'][0]['address']['lat'] ) {
    		yatta_lat_center = parseFloat( yatta_map['address_data'][0]['address']['lat'] );
    		yatta_long_center = parseFloat( yatta_map['address_data'][0]['address']['long'] );
    	}

	    var map = L.map('map', {
	    	center: [ yatta_lat_center, yatta_long_center ],
	    	zoom: yatta_map['map_data']
		});

		L.tileLayer('http://otile1.mqcdn.com/tiles/1.0.0/map/{z}/{x}/{y}.png', {
		    attribution: '<a href="http://openstreetmap.org">OpenStreetMap</a> &mdash; <a href="http://www.mapquest.com/">MapQuest</a> &mdash; <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
		    maxZoom: 18
		}).addTo(map);

		if ( yatta_map['address_data'] ) {

			var LeafIcon = L.DivIcon.extend({
		    options: {
        		iconSize:     [45, 45],
		        iconAnchor:   [0, 0],
		        popupAnchor:  [22.5, 0]
		    }
			});

			var yatta_icon_class;
			var yatta_lat = 51.50;
	    	var yatta_long = -0.09;
	    	var yatta_bubble_title = '';
	    	var yatta_bubble_text = '';

			for ( var i in yatta_map['address_data'] ) {
				if ( yatta_map['address_data'][i]['address']['lat'] && yatta_map['address_data'][i]['address']['long'] && yatta_map['address_data'][i]['icon'] ) {
					yatta_icon_class = 'yatta-block-map-marker-' + yatta_map['address_data'][i]['icon'];
					var marker_sprite  = new LeafIcon( { iconUrl: yatta_map['images_uri'] + 'yatta-block-map-marker-s85cd50e289.png', className: yatta_icon_class } );
					yatta_lat = parseFloat( yatta_map['address_data'][i]['address']['lat'] );
					yatta_long = parseFloat( yatta_map['address_data'][i]['address']['long'] );
				}
				if ( yatta_map['address_data'][i]['bubble_title'] || yatta_map['address_data'][i]['bubble_text'] ) {
					if ( yatta_map['address_data'][i]['bubble_title'] ) {
						yatta_bubble_title = "<div class='leaflet-popup-bubble-title'>" + yatta_map['address_data'][i]['bubble_title'] + "</div>";
					}
					if ( yatta_map['address_data'][i]['bubble_text'] ) {
						yatta_bubble_text = "<div class='leaflet-popup-bubble-text'>" + yatta_map['address_data'][i]['bubble_text'] + "</div>";
					}
					L.marker( [ yatta_lat, yatta_long ] , { icon: marker_sprite } ).addTo( map ).bindPopup( "<div class='leaflet-popup-header-" + yatta_map['address_data'][i]['icon'] + "'>" + yatta_bubble_title + yatta_bubble_text + "</div>" );
				} else {
					L.marker( [ yatta_lat, yatta_long ] , { icon: marker_sprite } ).addTo( map );
				}
			}
		}
	}






    /**
    * 
    * call jRespond and add breakpoints
    *
    */
	var jRes = jRespond([
		{
			label: 'narrow',
			enter: 10,
			exit: 780
		},{
			label: 'large',
			enter: 781,
			exit: 10000
		}
	]);


	/**
    * 
    * jRespond - breakpoints - Large 
    *
    */
	jRes.addFunc({
		breakpoint: 'large',
		enter: function() {	
					

		    
			
		},
		exit: function() {

		}
	});

	/**
    * 
    * jRespond - breakpoints - Narrow 
    *
    */
	jRes.addFunc({
		breakpoint: 'narrow',
		enter: function() {

			/**
		    * 
		    * Responsive Menu: http://responsivenavigation.net/examples/multi-toggle/
		    *
		    */
			jQuery('body').addClass('js');
				var $menu = jQuery('#yatta-zone-nav-menu'),
				  	$menulink = jQuery('#yatta-zone-menu-link'),
				  	$menuTrigger = jQuery('.menu-item-has-children > a');

				$menulink.click(function(e) {
					e.preventDefault();
					$menulink.toggleClass('active');
					$menu.toggleClass('active');
				});

				$menuTrigger.click(function(e) {
					e.preventDefault();
					var $this = jQuery(this);
					$this.toggleClass('active').next('ul').toggleClass('active');
				});


		},
		exit: function() {

		}
	});


	
	
			






	




    /** 
    * iOS Viewport Scale Problem
    * http://jasonweaver.name/blog/ios-viewport-scale-problem/  
    */
	var viewport = jQuery('meta[name="viewport"]');
	var nua = navigator.userAgent;
	    if ((nua.match(/iPad/i)) || (nua.match(/iPhone/i)) || (nua.match(/iPod/i))) {
	        viewport.attr('content', 'width=device-width, minimum-scale=1.0, maximum-scale=1.0');
	    jQuery('body')[0].addEventListener("gesturestart", gestureStart, false);
	    }
	    function gestureStart() {
	        viewport.attr('content', 'width=device-width, minimum-scale=0.25, maximum-scale=1.6');
	    }

	    if (navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i)) {
	        var viewportmeta = document.querySelectorAll('meta[name="viewport"]')[0];
	        if (viewportmeta) {
	            viewportmeta.content = 'width=device-width, minimum-scale=1.0, maximum-scale=1.0';
	            document.body.addEventListener('gesturestart', function() {
	                viewportmeta.content = 'width=device-width, minimum-scale=0.25, maximum-scale=1.6';
	            }, false);
	        }
	    }


});