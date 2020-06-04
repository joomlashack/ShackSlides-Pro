<?php

/**
 * @package   ShackSlides
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @copyright 2010-2020 Joomlashack.com. All rights reserved
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

use Joomla\Registry\Registry;

defined('_JEXEC') or die();

class ModShackSlidesK2Helper extends ModShackSlidesHelper
{
    protected $content;
    protected $category_id;
    protected $ordering;
    protected $ordering_direction;
    protected $limit;
    protected $featured;

    public function __construct(Registry $params)
    {
        parent::__construct($params);
        $this->category_id        = $params->get('k2_category', 0);
        $this->ordering           = $params->get('ordering', 'ordering');
        $this->ordering_direction = $params->get('ordering_dir', 'ASC');
        $this->limit              = $params->get('limit', '5');
        $this->featured           = $params->get('featured', 'include');

        $this->getContentFromDatabase();

        $this->parseContentIntoProperties();
    }

    protected function getContentFromDatabase()
    {
        $database = JFactory::getDBO();
        $user     = JFactory::getUser();
        $now      = $database->quote(date('Y-m-d H:i:s'));
        $nullDate = $database->quote($database->getNullDate());
        $aid      = $user->getAuthorisedViewLevels();

        $query = $database->getQuery(true)
            ->select('*')
            ->from('#__k2_items')
            ->where(
                array(
                    'catid =' . $this->category_id,
                    sprintf('access IN (%s)', join(',', $aid)),
                    'published = 1',
                    'trash = 0',
                    sprintf('(publish_up = %s OR publish_up <= %s)', $nullDate, $now),
                    sprintf('(publish_down = %s OR publish_down >= %s)', $nullDate, $now)
                )
            )
            ->order($this->ordering . ' ' . $this->ordering_direction);

        if ($this->featured !== 'include') {
            $query->where(
                ($this->featured == 'exclude')
                    ? 'featured != 1'
                    : 'featured = 1'
            );
        }

        $database->setQuery($query, 0, $this->limit);
        $this->content = $database->loadObjectList();
    }

    protected function parseContentIntoProperties()
    {
        foreach ($this->content as $item) {
            $itemImage = sprintf('media/k2/items/src/%s.jpg', md5("Image" . $item->id));
            if (is_file(JPATH_SITE . '/' . $itemImage)) {
                $this->images[] = $itemImage;

            } else {
                $this->images[] = $this->getFirstImageFromContent($item->introtext);
            }

            $this->titles[]   = $this->getTitleFromContent($item->title);
            $this->contents[] = $this->getTitleFromContent($item->introtext);

            $this->addLink($this->buildLink($item->id));
        }
    }

    protected function buildLink($id)
    {
        $fields = array(
            'option' => 'com_k2',
            'view'   => 'item',
            'layout' => 'item',
            'id'     => $id
        );
        $index  = $this->compareQuery($fields);

        if ($index != false) {
            $link = $this->menu[$index]->link . '&Itemid=' . $this->menu[$index]->id;

        } else {
            $link = 'index.php?option=com_k2&view=item&layout=item&id=' . $id;
        }

        return $link;
    }
}
