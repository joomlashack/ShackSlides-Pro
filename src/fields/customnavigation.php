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

class JFormFieldCustomNavigation extends JFormFieldList
{
    public $type = 'CustomNavigation';

    protected function getInput()
    {
        $doc = JFactory::getDocument();
        $doc->addScript(JUri::root(true) . '/modules/mod_jsshackslides/assets/slider/change.customnavigation.js');
        $id = '';

        if (strpos($this->name, "navigationarrows_customrows") !== false) {
            $id = 'customrows_img';
        } else {
            $id = 'customdots_img';
        }

        return parent::getInput() . '<div style="float:left;background-color: rgb(139, 139, 139);">' .
                                   '<img id="' . $id . '" src="' . JUri::root(true) . '/modules/mod_jsshackslides/tmpl/images/' . $this->element['default'] . '.png' . '" />' .
                                   '</div>';
    }

    protected function getOptions()
    {
        $options = array();
        if (strpos($this->name, "navigationarrows_customrows") !== false) {
            $options[] = JHtml::_('select.option', "d01",  "D01");
            $options[] = JHtml::_('select.option', "d02",  "D02");
            $options[] = JHtml::_('select.option', "d03",  "D03");
            $options[] = JHtml::_('select.option', "d06",  "D06");
            $options[] = JHtml::_('select.option', "d07",  "D07");
            $options[] = JHtml::_('select.option', "d10",  "D10");
            $options[] = JHtml::_('select.option', "d11",  "D11");
            $options[] = JHtml::_('select.option', "d12",  "D12");
            $options[] = JHtml::_('select.option', "d13",  "D13");
            $options[] = JHtml::_('select.option', "d14",  "D14");
            $options[] = JHtml::_('select.option', "d15",  "D15");
            $options[] = JHtml::_('select.option', "d16",  "D16");
            $options[] = JHtml::_('select.option', "d17",  "D17");
            $options[] = JHtml::_('select.option', "d19",  "D19");
            $options[] = JHtml::_('select.option', "d20",  "D20");
            $options[] = JHtml::_('select.option', "d21",  "D21");
        } elseif (strpos($this->name, "navigationarrows_customdots") !== false) {
            $options[] = JHtml::_('select.option', "n02",  "D01");
            $options[] = JHtml::_('select.option', "n03",  "D02");
            $options[] = JHtml::_('select.option', "n05",  "D03");
            $options[] = JHtml::_('select.option', "n06",  "D06");
            $options[] = JHtml::_('select.option', "n07",  "D07");
            $options[] = JHtml::_('select.option', "n10",  "D10");
            $options[] = JHtml::_('select.option', "n11",  "D11");
            $options[] = JHtml::_('select.option', "n12",  "D12");
            $options[] = JHtml::_('select.option', "n13",  "D13");
            $options[] = JHtml::_('select.option', "n14",  "D14");
            $options[] = JHtml::_('select.option', "n16",  "D15");
            $options[] = JHtml::_('select.option', "n17",  "D16");
            $options[] = JHtml::_('select.option', "n18",  "D17");
            $options[] = JHtml::_('select.option', "n20",  "D19");
            $options[] = JHtml::_('select.option', "n21",  "D20");
        }

        return $options;
    }
}
