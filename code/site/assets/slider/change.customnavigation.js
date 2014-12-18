function changeImage(){
	var customrows_select = document.getElementById('jform_params_navigationarrows_customrows');
	var customdots_select = document.getElementById('jform_params_navigationarrows_customdots');
	var customrows_image = document.getElementById('customrows_img');
	var customdots_image = document.getElementById('customdots_img');

	customrows_image.src = customrows_image.src.substring(0, customrows_image.src.lastIndexOf('/') + 1) + customrows_select.value + '.png';
	customdots_image.src = customdots_image.src.substring(0, customdots_image.src.lastIndexOf('/') + 1) + customdots_select.value + '.png';

	customrows_select.onchange =  function(){
		 customrows_image.src = customrows_image.src.substring(0, customrows_image.src.lastIndexOf('/') + 1) + customrows_select.value + '.png';
	};

	customdots_select.onchange =  function(){
		 customdots_image.src = customdots_image.src.substring(0, customdots_image.src.lastIndexOf('/') + 1) + customdots_select.value + '.png';
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

addLoadEvent(changeImage); 