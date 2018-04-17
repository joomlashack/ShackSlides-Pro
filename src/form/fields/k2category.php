<?php
/**
 * @version       1.x
 * @package       ShackSlides
 * @copyright (C) 2010 Joomlashack / Meritage Assets Corp
 * @license       GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('list');

class ShackFormFieldK2category extends JFormFieldList
{
    public $type = 'K2category';

    protected function getInput()
    {
        $k2_element_path = JPATH_SITE . '/administrator/components/com_k2/elements/categories.php';

        if (file_exists($k2_element_path)) {
            include_once($k2_element_path);

            return parent::getInput();
        }

        JHtml::_('stylesheet', 'mod_jsshackslides/admin.css', array('relative' => true));

        return '<div class="shackslides-not-installed">' . JText::_('K2_NOT_INSTALLED') . '</div>';
    }

    protected function getOptions()
    {
        $db = JFactory::getDBO();

        $query = $db->getQuery(true)
            ->select(
                array(
                    $db->quoteName('id') . ' AS ' . $db->quoteName('value'),
                    $db->quoteName('name') . ' AS ' . $db->quoteName('text')
                )
            )
            ->from('#__k2_categories')
            ->where('published = 1');

        $options = $db->setQuery($query)->loadObjectlist();

        return array_merge(parent::getOptions(), $options);
    }
}
