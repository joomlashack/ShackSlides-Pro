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

use Joomla\Registry\Registry;

defined('_JEXEC') or die();

jimport('joomla.html.parameter');
JLoader::import('helpers.route', JPATH_SITE . '/components/com_content');

/**
 * Joomla Helper class
 *
 * @package     Shack Slides
 * @subpackage  Joomla Helper Class
 * @since       2.0
 */
class ModShackSlidesJoomlaHelper extends ModShackSlidesHelper
{
    /**
     * @var object[]
     */
    protected $content = null;

    /**
     * @var int
     */
    protected $categoryId = null;

    /**
     * @var string
     */
    protected $ordering = null;

    /**
     * @var string
     */
    protected $orderingDirection;

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var string
     */
    protected $featured;

    /**
     * @var string
     */
    protected $sourceType = null;

    public function __construct(Registry $params)
    {
        parent::__construct($params);

        $this->categoryId        = (int)$params->get('joomla_category', 0);
        $this->ordering          = $params->get('ordering', 'ordering');
        $this->orderingDirection = $params->get('ordering_dir', 'ASC');
        $this->limit             = (int)$params->get('limit', 5);
        $this->featured          = $params->get('featured', 'include');
        $this->sourceType        = $params->get('joomla_image_source_type', 'intro');

        $this->getContentFromDatabase();

        $this->parseContentIntoProperties();
    }

    /**
     * Reads content from Joomla tables and stores it in the helper properties
     *
     * @return  void
     */
    private function getContentFromDatabase()
    {
        $database = JFactory::getDbo();
        $now      = $database->quote(date('Y-m-d H:i:s'));
        $nullDate = $database->quote($database->getNullDate());

        $query = $database->getQuery(true)
            ->select('*')
            ->from('#__content')
            ->where(
                array(
                    'catid =' . $this->categoryId,
                    'state = 1',
                    sprintf('(publish_up = %s OR publish_up <= %s)', $nullDate, $now),
                    sprintf('(publish_down = %s OR publish_down >= %s)', $nullDate, $now)
                )
            )
            ->order($this->ordering . ' ' . $this->orderingDirection);

        if ($this->featured !== 'include') {
            $database->setQuery(
                $database->getQuery(true)
                    ->select('content_id')
                    ->from('#__content_frontpage')
            );
            if ($featuredItems = $database->loadColumn()) {
                $query->where(
                    sprintf(
                        'id %s IN (%s)',
                        ($this->featured == 'exclude') ? 'NOT ' : '',
                        implode(',', $featuredItems)
                    )
                );
            }
        }

        $database->setQuery($query, 0, $this->limit);
        $this->content = $database->loadObjectList();
    }

    /**
     * Parses the content from the DB and stores it into the specific class properties
     *
     * @return  void
     */
    protected function parseContentIntoProperties()
    {
        foreach ($this->content as $item) {
            if ($itemImages = json_decode($item->images, true)) {
                $itemImages = new Registry(array_filter($itemImages));
            }

            if ($itemImages) {
                switch ($this->sourceType) {
                    case 'intro':
                        $image = $itemImages->get('image_intro');
                        break;

                    case 'full':
                        $image = $itemImages->get('image_fulltext');
                        break;

                    case 'firstimage':
                        $image = $this->getFirstImageFromContent($item->introtext);
                        break;

                    default:
                        $image = null;
                }

                if (!empty($image)) {
                    $this->images[]   = $image;
                    $this->titles[]   = $this->getTitleFromContent($item->title);
                    $this->contents[] = $this->getTitleFromContent($item->introtext);
                    $item->slug       = $item->alias ? ($item->id . ':' . $item->alias) : $item->id;
                    $this->links[]    = JRoute::_(
                        ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language),
                        false
                    );
                }
            }
        }
    }
}
