<?php
/**
 * @package   ShackSlides
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @copyright 2019-2020 Joomlashack.com. All rights reserved
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

JFormHelper::loadFieldClass('List');

class ShackFormFieldTemplatedesign extends JFormFieldList
{
    protected $templateDesigns = null;

    public function setup(\SimpleXMLElement $element, $value, $group = null)
    {
        if (parent::setup($element, $value, $group)) {
            $this->templateDesigns = $this->getTemplateDesigns();

            return (bool)$this->templateDesigns;
        }

        return false;
    }

    protected function getOptions()
    {
        $options = array();
        $options[] = JHtml::_('select.option', '0', 'Disabled');
        $options[] = JHtml::_('select.option', '1', 'Default');

        foreach ($this->templateDesigns as $name => $path) {
            $options[] = JHtml::_('select.option', $path, $name);
        }

        return $options;
    }

    /**
     * @return object[]
     */
    protected function getTemplateDesigns()
    {
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('element')
            ->from('#__extensions')
            ->where(
                array(
                    $db->quoteName('type') . '=' . $db->quote('template'),
                    $db->quoteName('client_id') . ' = 0'
                )
            );

        $templates = $db->setQuery($query)->loadColumn();
        $designs   = array();
        foreach ($templates as $template) {
            $templatePath = JPATH_SITE . '/templates/' . $template;
            $designPath   = $templatePath . '/shackslides.json';
            $manifestPath = $templatePath . '/templateDetails.xml';
            if (is_file($designPath) && is_file($manifestPath)) {
                if ($design = json_decode(file_get_contents($designPath))) {
                    // Valid template design settings found
                    $manifest = simplexml_load_file($manifestPath);
                    $name = $manifest->xpath('//name');
                    $name = (string)array_pop($name);

                    $designs[$name] = $designPath;
                }
            }
        }

        return $designs;
    }
}
