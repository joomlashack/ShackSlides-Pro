<?php
/**
 * @package   ShackSlides
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @copyright 2010-2021 Joomlashack.com. All rights reserved
 * @license   https://www.gnu.org/licenses/gpl.html GNU/GPL
 *
 * This file is part of ShackSlides.
 *
 * ShackSlides is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * ShackSlides is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ShackSlides.  If not, see <https://www.gnu.org/licenses/>.
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

        return array_merge(parent::getOptions(), $options);
    }
}
