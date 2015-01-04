function autoplayDisable(){

	var slides_page = document.getElementById('jform_params_slide_items');
	var autoplay_select = document.getElementById('jform_params_slide_autoplay');
	var effectslide_select = document.getElementById('jform_params_slide_effect');
	var source_select = document.getElementById('jform_params_source');
	var showdots_select = document.getElementById('jform_params_showdots');
	var showarrows_select = document.getElementById('jform_params_navigationarrows');
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
		document.getElementById("jform_params_joomla_image_source_type").setAttribute("disabled" , "disabled");
	}

	if(source_select.value == "visionary" || source_select.value == "folder"){
		document.getElementById("jform_params_featured").setAttribute("disabled" , "disabled");
		document.getElementById("jform_params_ordering").options[2].setAttribute("disabled" , "disabled");
		document.getElementById("jform_params_ordering").options[3].setAttribute("disabled" , "disabled");
	}

	if(showdots_select.value == "0"){
		document.getElementById("jform_params_navigationnumbers").setAttribute("disabled" , "disabled");
		document.getElementById("jform_params_orientationdots").setAttribute("disabled" , "disabled");
		document.getElementById("jform_params_horizontalaligndots").setAttribute("disabled" , "disabled");
		document.getElementById("jform_params_verticalaligndots").setAttribute("disabled" , "disabled");
		document.getElementById("jform_params_horizontalpaddingdots").setAttribute("disabled" , "disabled");
		document.getElementById("jform_params_verticalpaddingdots").setAttribute("disabled" , "disabled");
		document.getElementById("slide_opacity_dots").setAttribute("disabled" , "disabled");
		document.getElementById("jform_params_navigationarrows_customdots").setAttribute("disabled" , "disabled");
	}

	if(showarrows_select.value == "0"){
		document.getElementById("slide_opacity_rows").setAttribute("disabled" , "disabled");
		document.getElementById("jform_params_navigationarrows_customrows").setAttribute("disabled" , "disabled");
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
		 	document.getElementById("jform_params_joomla_image_source_type").removeAttribute("disabled");
		 	document.getElementById("jform_params_featured").removeAttribute("disabled");
		 	document.getElementById("jform_params_ordering").options[2].removeAttribute("disabled");
		 	document.getElementById("jform_params_ordering").options[3].removeAttribute("disabled");
		 }
		 if(source_select.value == "folder" || source_select.value == "visionary"){
		 	document.getElementById("jform_params_featured").setAttribute("disabled" , "disabled");
		 	document.getElementById("jform_params_ordering").options[2].setAttribute("disabled" , "disabled");
		 	document.getElementById("jform_params_ordering").options[3].setAttribute("disabled" , "disabled");
		 	document.getElementById("jform_params_joomla_image_source_type").setAttribute("disabled" , "disabled");
		 }
		 if(source_select.value == "k2"){
		 	document.getElementById("jform_params_joomla_image_source_type").setAttribute("disabled" , "disabled");
		 	document.getElementById("jform_params_featured").removeAttribute("disabled");
		 	document.getElementById("jform_params_ordering").options[2].removeAttribute("disabled");
		 	document.getElementById("jform_params_ordering").options[3].removeAttribute("disabled");
		 }
	};
	showdots_select.onchange = function(){
		  if(showdots_select.value == "0"){
	  		document.getElementById("jform_params_navigationnumbers").setAttribute("disabled" , "disabled");
	  		document.getElementById("jform_params_orientationdots").setAttribute("disabled" , "disabled");
	  		document.getElementById("jform_params_horizontalaligndots").setAttribute("disabled" , "disabled");
	  		document.getElementById("jform_params_verticalaligndots").setAttribute("disabled" , "disabled");
	  		document.getElementById("jform_params_horizontalpaddingdots").setAttribute("disabled" , "disabled");
	  		document.getElementById("jform_params_verticalpaddingdots").setAttribute("disabled" , "disabled");
	  		document.getElementById("slide_opacity_dots").setAttribute("disabled" , "disabled");
	  		document.getElementById("jform_params_navigationarrows_customdots").setAttribute("disabled" , "disabled");
		  } else {
		  	document.getElementById("jform_params_navigationnumbers").removeAttribute("disabled");
	  		document.getElementById("jform_params_orientationdots").removeAttribute("disabled");
	  		document.getElementById("jform_params_horizontalaligndots").removeAttribute("disabled");
	  		document.getElementById("jform_params_verticalaligndots").removeAttribute("disabled");
	  		document.getElementById("jform_params_horizontalpaddingdots").removeAttribute("disabled");
	  		document.getElementById("jform_params_verticalpaddingdots").removeAttribute("disabled");
	  		document.getElementById("slide_opacity_dots").removeAttribute("disabled");
	  		document.getElementById("jform_params_navigationarrows_customdots").removeAttribute("disabled");
		  }
	};
	showarrows_select.onchange = function(){
		if(showarrows_select.value == "0"){
			document.getElementById("slide_opacity_rows").setAttribute("disabled" , "disabled");
			document.getElementById("jform_params_navigationarrows_customrows").setAttribute("disabled" , "disabled");
		} else {
			document.getElementById("slide_opacity_rows").removeAttribute("disabled");
			document.getElementById("jform_params_navigationarrows_customrows").removeAttribute("disabled");
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