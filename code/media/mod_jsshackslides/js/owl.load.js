jQuery(document).ready(function(){
	var options = {
		items: $$slide_items,
		margin: $$slide_margin,
		loop: true,
		center: $$slide_center,
		autoplay: $$slide_autoplay,
		autoplayTimeout: $$slide_delay,
		autoplayHoverPause: $$slide_onhoverstop,
		nav: false,
		dots: false,
		autoHeight: true,
		lazyLoad: false,
		navText: [ '&lt;', '&gt;' ],
		smartSpeed: $$slide_effect_masterspeed
		$$slides_animation
	};
	var $$container = jQuery("#$$container.owl-carousel").owlCarousel(options);
});
