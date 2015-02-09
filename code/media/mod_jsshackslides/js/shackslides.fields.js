function autoplayDisable(){

	var slides_page = document.getElementById('jform_params_slide_items');
	var autoplay_select = document.getElementById('jform_params_slide_autoplay');
	var effectslide_select = document.getElementById('jform_params_slide_effect');
	var source_select = document.getElementById('jform_params_source');
	var navigation_show = document.getElementById('jform_params_navigation_show');
	var shape_theme_navigation = document.getElementById('jform_params_navigation_theme_shape');
	/*
	########################################################################
	################# Disable when saving changes ##########################
	########################################################################
	*/

	if (slides_page.value == "1"){
	 	document.getElementById("jform_params_slide_margin").parentNode.style.display = 'none';
	}
	else {
		document.getElementById("jform_params_slide_effect").parentNode.style.display = 'none';
	}

	if(autoplay_select.value == "false"){
		document.getElementById("jform_params_slide_delay").parentNode.style.display = 'none';
	}

	if(effectslide_select.value == "none" && slides_page.value == "1"){
		document.getElementById("jform_params_slide_effect_masterspeed").parentNode.style.display = 'none';
	}

	if(source_select.value == "visionary" || source_select.value == "k2" || source_select.value == "folder"){
		document.getElementById("jform_params_joomla_image_source_type").parentNode.style.display = 'none';
	}

	if(source_select.value == "visionary" || source_select.value == "folder"){
		document.getElementById("jform_params_featured").parentNode.style.display = 'none';
		document.getElementById("jform_params_ordering").options[2].setAttribute("disabled" , "disabled");
		document.getElementById("jform_params_ordering").options[3].setAttribute("disabled" , "disabled");
	}

	if(navigation_show.value == "0"){
		document.getElementById("jform_params_navigation_theme_shape").parentNode.style.display = 'none';
		document.getElementById("jform_params_navigation_shape_theme").parentNode.style.display = 'none';
		document.getElementById("jform[params][navigation_dots_color]").parentNode.style.display = 'none';
		document.getElementById("jform[params][navigation_dots_numbers_color]").parentNode.style.display = 'none';
	}

	if(shape_theme_navigation.value == "none"){
		document.getElementById("jform[params][navigation_dots_color]").parentNode.style.display = 'none';
	}
	/*
	########################################################################
	################# Disable when saving changes ##########################
	########################################################################
	*/

	slides_page.onblur =  function(){
		var val = parseInt(slides_page.value);
		if (val <= 0 || val == NaN) val = 1;
		slides_page.value = val;
		 if(slides_page.value == "1"){
		 	document.getElementById("jform_params_slide_margin").parentNode.style.display = 'none';
		 	document.getElementById("jform_params_slide_effect").parentNode.style.display = 'block';
			 if(effectslide_select.value == "none"){
			 	document.getElementById("jform_params_slide_effect_masterspeed").parentNode.style.display = 'none';
			 } else {
			 	document.getElementById("jform_params_slide_effect_masterspeed").parentNode.style.display = 'block';
			 }
		 }
		 else {
		 	document.getElementById("jform_params_slide_margin").parentNode.style.display = 'block';
			document.getElementById("jform_params_slide_effect").parentNode.style.display = 'none';
			document.getElementById("jform_params_slide_effect_masterspeed").parentNode.style.display = 'block';
		 }
	};
	autoplay_select.onchange =  function(){
		 if(autoplay_select.value == "false"){
		 	document.getElementById("jform_params_slide_delay").parentNode.style.display = 'none';
		 } else {
		 	document.getElementById("jform_params_slide_delay").parentNode.style.display = 'block';
		 }
	};
	effectslide_select.onchange = function(){
		 if(effectslide_select.value == "none"){
		 	document.getElementById("jform_params_slide_effect_masterspeed").parentNode.style.display = 'none';
		 } else {
		 	document.getElementById("jform_params_slide_effect_masterspeed").parentNode.style.display = 'block';
		 }
	};
	source_select.onchange = function(){
		 if(source_select.value == "joomla" || source_select.value == "flexi"){
		 	document.getElementById("jform_params_joomla_image_source_type").parentNode.style.display = 'block';
		 	document.getElementById("jform_params_featured").parentNode.style.display = 'block';
		 	document.getElementById("jform_params_ordering").options[2].removeAttribute("disabled");
		 	document.getElementById("jform_params_ordering").options[3].removeAttribute("disabled");
		 }
		 if(source_select.value == "folder" || source_select.value == "visionary"){
		 	document.getElementById("jform_params_featured").parentNode.style.display = 'none';
		 	document.getElementById("jform_params_ordering").options[2].setAttribute("disabled" , "disabled");
		 	document.getElementById("jform_params_ordering").options[3].setAttribute("disabled" , "disabled");
		 	document.getElementById("jform_params_joomla_image_source_type").parentNode.style.display = 'none';
		 }
		 if(source_select.value == "k2"){
		 	document.getElementById("jform_params_joomla_image_source_type").parentNode.style.display = 'none';
		 	document.getElementById("jform_params_featured").parentNode.style.display = 'block';
		 	document.getElementById("jform_params_ordering").options[2].removeAttribute("disabled");
		 	document.getElementById("jform_params_ordering").options[3].removeAttribute("disabled");
		 }
	};
	navigation_show.onchange = function(){
		 if(navigation_show.value == "0"){
		 	document.getElementById("jform_params_navigation_theme_shape").parentNode.style.display = 'none';
		 	document.getElementById("jform_params_navigation_effect_theme").parentNode.style.display = 'none';
		 	document.getElementById("jform[params][navigation_dots_color]").parentNode.style.display = 'none';
		 	document.getElementById("jform[params][navigation_dots_numbers_color]").parentNode.style.display = 'none';
		 }
		 else
		 {
		 	document.getElementById("jform_params_navigation_theme_shape").parentNode.style.display = 'block';
		 	document.getElementById("jform_params_navigation_effect_theme").parentNode.style.display = 'block';
		 	if(shape_theme_navigation.value != "none"){
		 		document.getElementById("jform[params][navigation_dots_color]").parentNode.style.display = 'block';
		 	}
		 	document.getElementById("jform[params][navigation_dots_numbers_color]").parentNode.style.display = 'block';
		 }
	};
	shape_theme_navigation.onchange = function(){
		 if(shape_theme_navigation.value == "none"){
		 	document.getElementById("jform[params][navigation_dots_color]").parentNode.style.display = 'none';
		 } else {
		 	document.getElementById("jform[params][navigation_dots_color]").parentNode.style.display = 'block';
		 }
	};
}

function addLoadEvent(func) { 
	  var oldonload = window.onload; 
	  if (typeof window.onload != 'function') { 
	    window.onload = func; 
	  } else { 
	    window.onload = function() { 
	      if (oldonload) { 
	        oldonload(); 
	      } 
	      func(); 
	    } 
	  } 
} 

addLoadEvent(autoplayDisable); 