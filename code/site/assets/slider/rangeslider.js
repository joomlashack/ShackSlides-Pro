function updateSliderRows(value){
	var range_number_div = document.getElementById('range_number_rows');
	var customrows_image = document.getElementById('customrows_img');
	range_number_div.innerHTML = value+"%";
	customrows_img.style.opacity = (value/100);
	customrows_img.style.filter = "alpha(opacity="+value+")";
	document.getElementById('slide_opacity_rows').value = value;
	document.getElementById('slide_opacity_rowsh').value = value;
}

function updateSliderDots(value){
	var range_number_div = document.getElementById('range_number_dots');
	var customdots_image = document.getElementById('customdots_img');
	range_number_div.innerHTML = value+"%";
	customdots_img.style.opacity = (value/100);
	customdots_img.style.filter = "alpha(opacity="+value+")";
	document.getElementById('slide_opacity_dots').value = value;
	document.getElementById('slide_opacity_dotsh').value = value;
}

function onloadItems(){
	var range_number_divd = document.getElementById('range_number_dots');
	var range_number_divr = document.getElementById('range_number_rows');
	var customdots_image = document.getElementById('customdots_img');
	var customrows_image = document.getElementById('customrows_img');

	range_number_divd.innerHTML = document.getElementById('slide_opacity_dots').value+"%";
	range_number_divr.innerHTML = document.getElementById('slide_opacity_rows').value+"%";
	customdots_image.style.opacity = (document.getElementById('slide_opacity_dots').value/100);
	customrows_image.style.opacity = (document.getElementById('slide_opacity_rows').value/100);
	customdots_img.style.filter = "alpha(opacity="+document.getElementById('slide_opacity_dots').value+")";
	customrows_img.style.filter = "alpha(opacity="+document.getElementById('slide_opacity_rows').value+")";
}

function returnValue(id){
	return document.getElementById(id).value;
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

addLoadEvent(onloadItems); 