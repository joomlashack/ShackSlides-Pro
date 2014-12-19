<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.form.formfield');
 
class JFormFieldRangeSlider extends JFormField {
 
	protected $type = 'RangeSlider';
 
	public function getInput() {
		$doc = JFactory::getDocument();
		$doc->addScript(JUri::root(true) . '/modules/mod_jsshackslides/assets/slider/rangeslider.js');

		if(strpos($this->name , "rangesliderrows") !== false)
		{
			$function_slider = "updateSliderRows(this.value)";
			$div_id = "range_number_rows";
			$input_id = "slide_opacity_rows";
			$input_id_hidden = "slide_opacity_rowsh";
		}
		elseif(strpos($this->name , "rangesliderdots") !== false)
		{
			$function_slider = "updateSliderDots(this.value)";
			$div_id = "range_number_dots";
			$input_id = "slide_opacity_dots";
			$input_id_hidden = "slide_opacity_dotsh";
		}

		$code = '<div id="range_slider">'.
		       '<input id="'.$input_id.'" type="range"'.
		       'min="0" max="100" step="1" value="'.$this->value.'"'.
		       'onchange="'.$function_slider.'" />'.
		       '<div id="'.$div_id.'" style="float:left;">0%</div>'.
		       '</div>'.
		       '<input type="hidden" id="'.$input_id_hidden.'" name="'.$this->name.'" value="'.$this->value.'" />'; 
		return $code;
	}
}