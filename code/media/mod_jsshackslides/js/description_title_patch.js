function set_Height(){
	var half_height = jQuery("#$$container.jss-slider").height() / 2;
	var title = jQuery("#$$container.jss-slider .owl-carousel .jss-title-description .jss-title");
	var description = jQuery("#$$container.jss-slider .owl-carousel .jss-title-description .jss-description");

	title.css("height" , half_height);
	description.css("height" , half_height);
}

jQuery(window).ready(function() {
	set_Height();
});

jQuery(window).load(function() {
	set_Height();
});