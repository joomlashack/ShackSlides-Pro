function autoplayDisable(){
	var autoplay_select = document.getElementById('jform_params_navigation');
	var effectslide_select = document.getElementById('jform_params_effect_slide');

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
}

window.onload = autoplayDisable;	