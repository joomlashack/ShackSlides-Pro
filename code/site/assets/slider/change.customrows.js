function changeImage(){
	var customrows_select = document.getElementById('jform_params_navigationarrows_custom');
	var customrows_image = document.getElementById('customrows_img');

	customrows_image.src = customrows_image.src.substring(0, customrows_image.src.lastIndexOf('/') + 1) + customrows_select.value + '.png';

	customrows_select.onchange =  function(){
		 customrows_image.src = customrows_image.src.substring(0, customrows_image.src.lastIndexOf('/') + 1) + customrows_select.value + '.png';
	};
}

window.onload = changeImage;	