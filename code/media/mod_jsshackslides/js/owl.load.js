var $$container = null;
jQuery(document).ready(function(){
	var options = {
		items: $$slide_items,
		margin: $$slide_margin,
		loop: true,
		center: $$slide_center,
		autoplay: $$slide_autoplay,
		autoplayTimeout: $$slide_delay,
		autoplayHoverPause: $$slide_onhoverstop,
		nav: $$navigation_buttons_show,
		navContainer: '#$$container.jss-slider .jss-navigation .jss-navigation-buttons',
		dots: $$navigation_show,
		dotsContainer: '#$$container.jss-slider .jss-navigation .jss-navigation-dots',
		autoHeight: $$slide_autoheight,
		lazyLoad: false,
		navText: [ ' ', ' ' ],
		smartSpeed: $$slide_effect_masterspeed,
		onInitialize: jssInit_$$container,
		onInitialized: jssInitEnd_$$container
		$$slides_animation
	};
	$$container = jQuery("#$$container.jss-slider .owl-carousel").owlCarousel(options);
	$$animation_events
});

jQuery(window).load(function() {
	$$container.data('owl.carousel').refresh();
});
