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

// Restrict Access to within Joomla
defined('_JEXEC') or die();

class ShackFormFieldSlider extends JFormField
{
    protected $type = 'Slider';

    protected function getInput()
    {
        // Initialize some field attributes.
        $class    = !empty($this->class) ? ' class="' . $this->class . '"' : '';
        $disabled = $this->disabled ? ' disabled' : '';

        // Initialize JavaScript field attributes.
        $onchange = $this->onchange ? ' onchange="' . $this->onchange . '"' : '';

        return '<input type="range" min="0" max="100" step="1"'
            . ' name="' . $this->name . '" id="' . $this->id . '" value="'
            . htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '"'
            . $class . $disabled . $onchange
            . 'oninput="document.getElementById(\'rangeshow-' . $this->id . '\').value = this.value"'
            . ' />'
            . '<input size="5" type="text"'
            . ' id="rangeshow-' . $this->id . '" name="rangeshow-' . $this->name . '" readonly="readonly"'
            . ' value="' . htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '"'
            . ' />';
    }
}
