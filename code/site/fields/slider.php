<?php
/**
 * @package     Shackslides
 * @subpackage  Fields
 *
 * @copyright   Copyright (C) 2010 - 2015 Joomlashack. Meritage Assets.  All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Restrict Access to within Joomla
defined('_JEXEC') or die('Restricted access');

$doc = JFactory::getDocument();

/**
 * Slider field
 *
 * @package     Shackslides
 * @subpackage  Fields
 * @since       3.0
 */
class JFormFieldSlider extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 */
	protected $type = 'Slider';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 */
	protected function getInput()
	{
		// Initialize some field attributes.
		$class = !empty($this->class) ? ' class="' . $this->class . '"' : '';
		$disabled = $this->disabled ? ' disabled' : '';

		// Initialize JavaScript field attributes.
		$onchange = $this->onchange ? ' onchange="' . $this->onchange . '"' : '';

		return '<input type="range" min="0" max="100" step="1" name="' . $this->name . '" id="' . $this->id . '" value="'
			. htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '"' . $class . $disabled . $onchange
			. 'oninput="document.getElementById(\'rangeshow-' . $this->id . '\').value = this.value"'
			. ' />'
			. '<input size="5" type="text" id="rangeshow-' . $this->id . '" name="rangeshow-' . $this->name . '" readonly="readonly" value="'
			. htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '" />';
	}
}
