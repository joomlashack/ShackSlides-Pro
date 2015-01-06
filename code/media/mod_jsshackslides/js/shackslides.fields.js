function autoplayDisable(){

	var slides_page = document.getElementById('jform_params_slide_items');
	var autoplay_select = document.getElementById('jform_params_slide_autoplay');
	var effectslide_select = document.getElementById('jform_params_slide_effect');
	var source_select = document.getElementById('jform_params_source');
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