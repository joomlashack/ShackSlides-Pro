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
		smartSpeed: $$slide_effect_masterspeed
		$$slides_animation
	};
	var $$container = jQuery("#$$container.jss-slider .owl-carousel").owlCarousel(options);
});
