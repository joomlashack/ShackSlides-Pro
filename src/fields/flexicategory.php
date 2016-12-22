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
JFormHelper::loadFieldClass('category');

class JFormFieldFlexicategory extends JFormFieldCategory
{
    public $type = 'Flexicategory';

    protected function getInput()
    {
        $flexi_path = JPATH_SITE . '/components/com_flexicontent/classes/flexicontent.categories.php';
        if (!file_exists($flexi_path)) {
            $doc = JFactory::getDocument();
            $doc->addStyleSheet(JURI::root() . 'media/mod_jsshackslides/css/admin.css');
            return '<div class="shackslides-not-installed">' . JText::_('FLEXICONTENT_NOT_INSTALLED') . '</div>';
        } else {
            return parent::getInput();
        }
    }
}
