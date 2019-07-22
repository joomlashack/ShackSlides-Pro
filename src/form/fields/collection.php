<?php
/**
 * @package   ShackSlides
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @copyright 2010-2019 Joomlashack.com. All rights reserved
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
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
 * along with ShackSlides.  If not, see <http://www.gnu.org/licenses/>.
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
