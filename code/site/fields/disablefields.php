<?php
/**
* @version   1.x
* @package   ShackSlides
* @copyright (C) 2010 Joomlashack / Meritage Assets Corp
* @license   GNU/GPL http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldDisableFields extends JFormFieldList
{
	public $type = 'DisableFields';

	protected function getInput() {

		$doc = JFactory::getDocument();
		$doc->addScript(JUri::root(true) . '/modules/mod_jsshackslides/assets/slider/shackslides.disable.js');
		return parent::getInput();
	}

	protected function getOptions() {

		$options = array();

		if(strpos($this->name , "navigation") !== false)
		{
			$options []= JHtml::_('select.option', "true",  JText::_('AUTOMATICNAV'));
			$options []= JHtml::_('select.option', "false", JText::_('MANUALNAV'));
		}
		elseif (strpos($this->name , "effect_slide") !== false)
		{
			$options []= JHtml::_('select.option', "None", JText::_('EFFECT_NONE'));
			$options []= JHtml::_('select.option', "switch", JText::_('EFFECT_SWITCH'));
			$options []= JHtml::_('select.option', "rotateoverlap", JText::_('EFFECT_ROTATE_OVERLAP'));
			$options []= JHtml::_('select.option', "Rotate_Relay", JText::_('EFFECT_ROTATE_RELAY'));
			$options []= JHtml::_('select.option', "doors", JText::_('EFFECT_DOORS'));
			$options []= JHtml::_('select.option', "Rotate-in+-out-", JText::_('EFFECT_ROTATEIN+_ROTATEOUT-'));
			$options []= JHtml::_('select.option', "Fly-Twins", JText::_('EFFECT_FLYTWINS'));
			$options []= JHtml::_('select.option', "Rotatein-out+", JText::_('EFFECT_ROTATEINMIN_OUTPLUS'));
			$options []= JHtml::_('select.option', "Rotate_Axis_up_overlap", JText::_('EFFECT_ROTATE_AXIS_UP_OVERLAP'));
			$options []= JHtml::_('select.option', "Chess_Replace_TB", JText::_('EFFECT_CHESS_REPLACE_TB'));
			$options []= JHtml::_('select.option', "Chess_Replace_LR", JText::_('EFFECT_CHESS_REPLACE_LR'));
			$options []= JHtml::_('select.option', "Shift_TB", JText::_('EFFECT_SHIFT_TB'));
			$options []= JHtml::_('select.option', "Shift_LR", JText::_('EFFECT_SHIFT_LR'));
			$options []= JHtml::_('select.option', "Return_TB", JText::_('EFFECT_RETURN_TB'));
			$options []= JHtml::_('select.option', "Return_LR", JText::_('EFFECT_RETURN_LR'));
			$options []= JHtml::_('select.option', "Rotate_Axis_down", JText::_('EFFECT_ROTATE_AXIS_DOWN'));
			$options []= JHtml::_('select.option', "Extrude_Replace", JText::_('EFFECT_EXTRUDE_REPLACE'));
			$options []= JHtml::_('select.option', "Fade", JText::_('EFFECT_FADE'));
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
				$options [] = JHtml::_('select.option', "joomla", JText::_('SHACKSLIDE_SLIDESOURCE_FLEXI'));
			}
			if(file_exists($visionary_component_path))
			{
				$options [] = JHtml::_('select.option', "visionary", JText::_('SHACKSLIDE_SLIDESOURCE_VISIONARY'));
			}
		}
		
		return $options;
	}


}
