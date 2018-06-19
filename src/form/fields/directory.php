<?php

/**
 * @version       1.x
 * @package       Shack Slides
 * @copyright (C) 2010 Joomlashack / Meritage Assets Corp
 * @license       GNU/GPL http://www.gnu.org/copyleft/gpl.html
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
