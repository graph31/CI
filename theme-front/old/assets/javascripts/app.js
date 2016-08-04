;(function($, window, document, undefined) {
	'use strict';

	var $win = $(window);
	var $doc = $(document);

	$doc.ready(function() {

		// Foundation Init
		$(document).foundation();

		// Fullscreener
		$('.fullscreener img').fullscreener();

		// Progressbar
		$('.progressbar-inner').each(function() {
			var width = $(this).data('progress');

			$(this).width(width + '%');
		});

		// Slider Intro
		$('.slider-intro .slides').owlCarousel({
			loop: true,
			autoplay: true,
			autoplayHoverPause : true,
			autoplayTimeout: 5000,
			smartSpeed: 500,
			nav: true,
			navContainer: '.slider-intro .slider-actions',
			navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
			items: 1,
			margin: 0
		});

		// Slider Featured
		$('.slider-featured .slides').owlCarousel({
			loop: true,
			nav: true,
			navContainer: '.slider-featured .slider-actions',
			navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
			items: 1,
			autoWidth: true,
			margin: 30,
			responsive: {
				320: {
					items: 1
				},
				768: {
					items: 2
				},
				1024: {
					items: 3
				},
				1200: {
					items: 4
				}
			}
		});

		// Slider Sponsor
		$('.slider-sponsor .slides').owlCarousel({
			loop: true,
			nav: true,
			smartSpeed: 500,
			navContainer: '.slider-sponsor .slider-actions',
			navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
			items: 1
		});

		// Slider News
		$('.slider-news .slides').owlCarousel({
			loop: true,
			nav: true,
			navContainer: '.slider-news .slider-actions',
			navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
			items: 1
		});

		// Slider Staff
		$('.slider-staff .slides').owlCarousel({
			loop: true,
			mouseDrag: false,
			touchDrag: false,
			nav: true,
			smartSpeed: 500,
			navContainer: '.slider-staff .slider-actions',
			navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
			items: 1
		});

		// Slider Testimonials
		$('.slider-testimonials .slides').owlCarousel({
			loop: true,
			dots: true,
			autoplay: true,
			autoplayTimeout: 5000,
			smartSpeed: 500,
			items: 1
		});

		// Slider Widgets
		$('.slider-widget .slides').owlCarousel({
			loop: true,
			dots: true,
			smartSpeed: 500,
			items: 1,
			margin: 30,
		});

		// Post Format Gallery Slider
		$('.format-gallery .post-image ul').owlCarousel({
			loop: true,
			nav: true,
			smartSpeed: 500,
			navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
			items: 1
		});

		// Mobile Navigation
		var $nav = $('.nav');

		$nav.find('li').each(function() {
			if ( $(this).children('ul').length ) {
				$(this).append('<span>+</span>')
			}
		});

		$nav.find('li > span').on('click', function(e) {
			e.preventDefault();
			
			$(this).text( $(this).text() == "+" ? "-" : "+");
			$(this).siblings('ul').slideToggle(300);
		});

		$('.button-burger').on('click', function (event) {
			$(this).toggleClass('active');  
			
			$nav.slideToggle(300);
			event.preventDefault();
		});


		// Custom Input Number
		$('input[type=number]').number();


		// Map
		if ($('#event-map').length) {
			google.maps.event.addDomListener(window, 'load', initialize);
		}

	});

	function initialize() {
		var address = $('#event-map').data('address');

		var geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(50, 50);
		var mapOptions = {
			zoom: 11,
			center: latlng,
			scrollwheel: false,
			disableDefaultUI: true
		};


		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new MarkerWithLabel({
						map: map,
						position: results[0].geometry.location,
						icon: ' ',
						labelContent: '<i class="fa fa-map-marker"></i>',
						labelAnchor: new google.maps.Point(7, 28),
						labelClass: 'labels'
				});
				latlng = new google.maps.LatLng(results[0].geometry.location.k, results[0].geometry.location.D);
			}
		});

		var map = new google.maps.Map(document.getElementById('event-map'), mapOptions);
		
	}

})(jQuery, window, document);
