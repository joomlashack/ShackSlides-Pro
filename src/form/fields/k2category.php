<?php
/**
 * @package   ShackSlides
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @copyright 2010-2020 Joomlashack.com. All rights reserved
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
