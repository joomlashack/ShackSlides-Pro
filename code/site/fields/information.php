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
	 * Method to get the field label markup for a spacer.
	 * Use the label text or name from the XML element as the spacer or
	 * Use a hr="true" to automatically generate plain hr markup
	 *
	 * @return  string  The field label markup.
	 */
	protected function getLabel()
	{
		return '';
	}

	/**
	 * Method to get the field input markup for a spacer.
	 * The spacer does not have accept input.
	 *
	 * @return  string  The field input markup.
	 */
	protected function getInput()
	{
		return '<br /><br />' . JText::_($this->description);
	}
}
