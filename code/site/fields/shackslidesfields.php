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

// Load jQuery
if (version_compare(JVERSION, '3.0', '<') == 1)
{
	// Load local file if Joomla < 3
	if (!JFactory::getApplication()->get('jquery'))
	{
		JFactory::getApplication()->set('jquery', true);
		$doc = JFactory::getDocument();

		JHtml::script('mod_jsshackslides/jquery-1.11.2.min.js', false, true);
		JHtml::script('mod_jsshackslides/jquery-noconflict.js', false, true);
	}
}
else
{
	// Load jQuery Framework if Joomla >= 3
	JHTML::_('jquery.framework');
}

JHtml::script('mod_jsshackslides/shackslides.fields.js', false, true);

/**
 * Field just for loading javascript helper to hide fields on other fields dependencies
 *
 * @package     Wright
 * @subpackage  Parameters
 * @since       3.0
 */
class JFormFieldShackslidesFields extends JFormFieldSpacer
{
	public $type = 'ShackslidesFields';

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
