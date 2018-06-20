<?php
/**
 * @version       1.x
 * @package       Shack Slides
 * @copyright (C) 2010 Joomlashack / Meritage Assets Corp
 * @license       GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die();

JFormHelper::loadFieldClass('list');

class ShackFormFieldCollection extends JFormFieldList
{
    public $type = 'VisionaryCollection';

    protected function getInput()
    {
        $visionary_component_path = JPATH_SITE . '/administrator/components/com_jsvisionary/jsvisionary.php';

        if (file_exists($visionary_component_path)) {
            return parent::getInput();
        } else {
            JHtml::_('stylesheet', 'mod_jsshackslides/admin.css', array('relative' => true));

            return '<div class="shackslides-not-installed">' . JText::_('VISIONARY_NOT_INSTALLED') . '</div>';
        }
    }

    protected function getOptions()
    {
        $db = JFactory::getDBO();

        $query = $db->getQuery(true)
            ->select(
                array(
                    'jsvisionary_collection_id AS ' . $db->quoteName('value'),
                    'title AS ' . $db->quoteName('text')
                )
            )
            ->from('#__jsvisionary_collections')
            ->where('enabled = 1');

        $options = $db->setQuery($query)->loadObjectList();

        return array_merge(parent::getOptions(), $options);
    }
}
