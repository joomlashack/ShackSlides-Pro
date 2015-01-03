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
JHtml::script('mod_jsshackslides/shackslides.disable.js', false, true);

/**
 * Field just for loading javascript helper to hide fields on other fields dependencies
 *
 * @package     Wright
 * @subpackage  Parameters
 * @since       3.0
 */
class JFormFieldDisableFields extends JFormFieldSpacer
{
	public $type = 'DisableFields';

	/**
	 * Method to get the field label markup for a spacer.
	 *
	 * @return  string  The field label markup.
	 */
	protected function getLabel()
	{
		return ' ';
	}
}
