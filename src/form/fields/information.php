<?php
/**
 * @package     Shack Slides
 * @subpackage  Fields
 *
 * @copyright   Copyright (C) 2010 - 2015 Joomlashack. Meritage Assets.  All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die();

JFormHelper::loadFieldClass('spacer');

class ShackFormFieldInformation extends JFormFieldSpacer
{
    public $type = 'Information';

    protected function getLabel()
    {
        return '';
    }

    protected function getInput()
    {
        return JText::_($this->description);
    }
}
