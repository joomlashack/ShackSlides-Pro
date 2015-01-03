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

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');

JFormHelper::loadFieldClass('spacer');

/**
 * Field just for loading javascript helper to hide fields on other fields dependencies
 *
 * @package     Wright
 * @subpackage  Parameters
 * @since       3.0
 */
class JFormFieldInformation extends JFormFieldSpacer
{
	public $type = 'Information';

	/**
	 * Method to get the field input markup for a spacer.
	 * The spacer does not have accept input.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput()
	{
		return '<p>' . JText::_($this->description) . '</p>';
	}
}
