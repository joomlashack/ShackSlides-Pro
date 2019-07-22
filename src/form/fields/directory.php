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

jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

JFormHelper::loadFieldType('list');

class ShackFormFieldDirectory extends JFormFieldList
{
    public $type = 'Directory';

    protected function getOptions()
    {
        if ($this->element['directory']) {
            $path = (string)$this->element['directory'];

        } else {
            $mediaParams = JComponentHelper::getComponent('com_media')->getParams();
            $path = $mediaParams->get('mage_path');
        }
        $path = JPATH_ROOT . '/' . ltrim($path, '/');


        $filter  = $this->element['filter'];

        $folders = JFolder::folders($path, $filter, true, true);

        $options = array();
        foreach ($folders as $folder) {
            $folder = str_replace(JPATH_ROOT, '', $folder);

            $folder = ltrim($folder, "/\\");

            $options[] = JHTML::_('select.option', $folder, $folder);
        }

        array_unshift($options, JHTML::_('select.option', '', '- ' . JText::_('Use demo') . ' -'));

        return array_merge(parent::getOptions(), $options);
    }
}
