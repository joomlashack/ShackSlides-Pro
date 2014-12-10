function autoplayDisable(){
	var autoplay_select = document.getElementById('jform_params_navigation');
	var effectslide_select = document.getElementById('jform_params_effect_slide');
	var source_select = document.getElementById('jform_params_source');

	/*
	########################################################################
	################# Disable when saving changes ##########################
	########################################################################
	*/

	if(autoplay_select.value == "false"){
		document.getElementById("jform_params_slide_delay").setAttribute("disabled" , "disabled");
	}

	if(effectslide_select.value == "None"){
		document.getElementById("jform_params_effect_masterspeed").setAttribute("disabled" , "disabled");
	}

	if(source_select.value == "visionary" || source_select.value == "k2" || source_select.value == "folder"){
		document.getElementById("jform_params_joomla_image_source_type").setAttribute("disabled" , "disabled");
	}
	/*
	########################################################################
	################# Disable when saving changes ##########################
	########################################################################
	*/
	
	autoplay_select.onchange =  function(){
		 if(autoplay_select.value == "false"){
		 	document.getElementById("jform_params_slide_delay").setAttribute("disabled" , "disabled");
		 } else {
		 	document.getElementById("jform_params_slide_delay").removeAttribute("disabled");
		 }
	};
	effectslide_select.onchange = function(){
		 if(effectslide_select.value == "None"){
		 	document.getElementById("jform_params_effect_masterspeed").setAttribute("disabled" , "disabled");
		 } else {
		 	document.getElementById("jform_params_effect_masterspeed").removeAttribute("disabled");
		 }
	};
	source_select.onchange = function(){
		 if(source_select.value == "joomla" || source_select.value == "flexi"){
		 	document.getElementById("jform_params_joomla_image_source_type").removeAttribute("disabled");
		 } else {
		 	document.getElementById("jform_params_joomla_image_source_type").setAttribute("disabled" , "disabled");
		 }
	};
}

window.onload = autoplayDisable;	