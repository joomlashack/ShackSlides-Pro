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

class JFormFieldCustomRows extends JFormFieldList
{
	public $type = 'CustomRows';

	protected function getInput() {

		$doc = JFactory::getDocument();
		$doc->addScript(JUri::root(true) . '/modules/mod_jsshackslides/assets/slider/change.customrows.js');
		return parent::getInput().'<img id="customrows_img" src="'.JUri::root(true).'/modules/mod_jsshackslides/tmpl/images/'.$this->element['default'].'.png'.'" style= "filter: alpha(opacity=50); background-color: rgba(0, 0, 0, 0.5)" />';

	}

	protected function getOptions() {

		$options = array();

		$options []= JHtml::_('select.option', "d01",  "D01");
		$options []= JHtml::_('select.option', "d02",  "D02");
		$options []= JHtml::_('select.option', "d03",  "D03");
		$options []= JHtml::_('select.option', "d06",  "D06");
		$options []= JHtml::_('select.option', "d07",  "D07");
		$options []= JHtml::_('select.option', "d10",  "D10");
		$options []= JHtml::_('select.option', "d11",  "D11");
		$options []= JHtml::_('select.option', "d12",  "D12");
		$options []= JHtml::_('select.option', "d13",  "D13");
		$options []= JHtml::_('select.option', "d14",  "D14");
		$options []= JHtml::_('select.option', "d15",  "D15");
		$options []= JHtml::_('select.option', "d16",  "D16");
		$options []= JHtml::_('select.option', "d17",  "D17");
		$options []= JHtml::_('select.option', "d19",  "D19");
		$options []= JHtml::_('select.option', "d20",  "D20");
		$options []= JHtml::_('select.option', "d21",  "D21");

		return $options;
	}


}
