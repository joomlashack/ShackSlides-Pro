<?php
/**
 * @version       1.x
 * @package       ShackSlides
 * @copyright (C) 2010 Joomlashack / Meritage Assets Corp
 * @license       GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldType('Text');

class ShackFormFieldTextFilter extends JFormFieldText
{
    public $type = 'TextFilter';

    protected function getInput()
    {
        return '<input type="text"'
            . ' name="' . $this->name . '"'
            . ' id="' . $this->id . '"'
            . ' value="' . $this->value . '"'
            . ' oninput="filterText(this.value, this.id)"'
            . '/>';
    }
}
