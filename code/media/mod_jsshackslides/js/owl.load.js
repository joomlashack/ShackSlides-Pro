jQuery(document).ready(function(){
	var options = {
		items: $$slide_items,
		loop: true,
		center: true,
		autoplay: $$slide_autoplay,
		autoplayTimeout: $$slide_delay,
		autoplayHoverPause: $$slide_onhoverstop,
		nav: false,
		dots: false,
		autoHeight: true,
		lazyLoad: false,
		navText: [ '&lt;', '&gt;' ]
	};
	var jss = jQuery(".owl-carousel").owlCarousel(options);
});
