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

JFormHelper::loadFieldClass('list');
JHtml::script('mod_jsshackslides/shackslides.disable.js', false, true);

/**
 * Item list, capable of disabling options (via Javascript) depending on some dependencies with other fields
 *
 * @package     Wright
 * @subpackage  Parameters
 * @since       3.0
 */
class JFormFieldDisableFields extends JFormFieldList
{
	public $type = 'DisableFields';
}
