<?php
/**
 * @package     Shack Slides
 * @subpackage  Helper
 *
 * @copyright   Copyright (C) 2010 - 2015 Joomlashack. Meritage Assets.  All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
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

    public function __construct(Registry $params)
    {
        parent::__construct($params);

        $this->categoryId               = (int)$params->get('joomla_category', 0);
        $this->ordering                 = $params->get('ordering', 'ordering');
        $this->orderingDirection        = $params->get('ordering_dir', 'ASC');
        $this->limit                    = (int)$params->get('limit', 5);
        $this->featured                 = $params->get('featured', 'include');
        $this->joomla_image_source_type = $params->get('joomla_image_source_type', 'intro');

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

        if ($this->ordering == 'RAND()') {
            $this->ordering = $this->generateOrdering();
        }

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
    private function parseContentIntoProperties()
    {

        foreach ($this->content as $item) {
            // Setting image
            $itemImages = json_decode($item->images);

            if ($itemImages) {
                if ($this->joomla_image_source_type == 'intro') {
                    if ($itemImages->image_intro != '') {
                        $this->images[] = $itemImages->image_intro;
                    } else {
                        $this->images[] = $this->noimage;
                    }
                } elseif ($this->joomla_image_source_type == 'full') {
                    if ($itemImages->image_fulltext != '') {
                        $this->images[] = $itemImages->image_fulltext;
                    } else {
                        $this->images[] = $this->noimage;
                    }
                } elseif ($this->joomla_image_source_type == 'firstimage') {
                    $this->images[] = $this->getFirstImageFromContent($item->introtext);
                }
                // End setting image

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
