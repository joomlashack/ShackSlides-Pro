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

		if(strpos($this->name , "slide_autoplay") !== false)
		{
			$options []= JHtml::_('select.option', "true",  JText::_('AUTOMATICNAV'));
			$options []= JHtml::_('select.option', "false", JText::_('MANUALNAV'));
		}
		elseif (strpos($this->name , "slide_effect") !== false)
		{
			$options []= JHtml::_('select.option', "none", JText::_('EFFECT_NONE'));
			$options []= JHtml::_('select.option', "slide", JText::_('EFFECT_SLIDE_SLIDE'));
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
	}


}
