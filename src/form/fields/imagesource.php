<?php
/**
 * @package     Shack Slides
 * @subpackage  Fields
 *
 * @copyright   Copyright (C) 2010 - 2015 Joomlashack. Meritage Assets.  All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die();

JFormHelper::loadFieldClass('list');

class ShackFormFieldImageSource extends JFormFieldList
{
    public $type = 'ImageSource';

    /**
     * Options of the field
     *
     * @return  array
     */
    protected function getOptions()
    {
        $options = array();

        $k2_element_path = JPATH_SITE . '/administrator/components/com_k2/elements/categories.php';
        $visionary_component_path = JPATH_SITE . '/administrator/components/com_jsvisionary/jsvisionary.php';

        $options [] = JHtml::_('select.option', "folder", JText::_('SHACKSLIDE_SLIDESOURCE_FOLDER'));
        $options [] = JHtml::_('select.option', "joomla", JText::_('SHACKSLIDE_SLIDESOURCE_JOOMLA'));

        if (file_exists($k2_element_path)) {
            $options[] = JHtml::_('select.option', "k2", JText::_('SHACKSLIDE_SLIDESOURCE_K2'));
        }

        if (file_exists($visionary_component_path)) {
            $options[] = JHtml::_('select.option', "visionary", JText::_('SHACKSLIDE_SLIDESOURCE_VISIONARY'));
        }

        return $options;
    }
}
