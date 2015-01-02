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

	/*protected function getOptions() {

		$options = array();

		if(strpos($this->name , "slide_autoplay") !== false)
		{
			$options []= JHtml::_('select.option', "true",  JText::_('JYES'));
			$options []= JHtml::_('select.option', "false", JText::_('JNO'));
		}
		elseif (strpos($this->name , "slide_effect") !== false)
		{
			$options []= JHtml::_('select.option', "none", JText::_('EFFECT_EFFECT_NONE'));
			$options []= JHtml::_('select.option', "slide", JText::_('EFFECT_EFFECT_SLIDE'));
		}
		elseif(strpos($this->name , "source") !== false)
		{
			$k2_element_path = JPATH_SITE.'/administrator/components/com_k2/elements/categories.php';
			$flexi_path = JPATH_SITE.'/components/com_flexicontent/classes/flexicontent.categories.php';
			$visionary_component_path = JPATH_SITE.'/administrator/components/com_jsvisionary/jsvisionary.php';

			$options [] = JHtml::_('select.option', "folder", JText::_('SHACKSLIDE_SLIDESOURCE_FOLDER'));
			$options [] = JHtml::_('select.option', "joomla", JText::_('SHACKSLIDE_SLIDESOURCE_JOOMLA'));

			if(file_exists($k2_element_path))
			{
				$options [] = JHtml::_('select.option', "k2", JText::_('SHACKSLIDE_SLIDESOURCE_K2'));
			}
			if(file_exists($flexi_path))
			{
				$options [] = JHtml::_('select.option', "flexi", JText::_('SHACKSLIDE_SLIDESOURCE_FLEXI'));
			}
			if(file_exists($visionary_component_path))
			{
				$options [] = JHtml::_('select.option', "visionary", JText::_('SHACKSLIDE_SLIDESOURCE_VISIONARY'));
			}
		}
		elseif (strpos($this->name , "showdots") !== false)
		{
			$options []= JHtml::_('select.option', "2", JText::_('ALWAYS_DOTS'));
			$options []= JHtml::_('select.option', "0", JText::_('NO_DOTS'));
			$options []= JHtml::_('select.option', "1", JText::_('ONHOVER_DOTS'));
		}

		return $options;
	}*/
}
