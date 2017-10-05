<?php
/**
 * @package     ShackSlides
 * @subpackage  Helper
 *
 * @copyright   Copyright (C) 2010 - 2015 Joomlashack. Meritage Assets.  All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Restrict Access to within Joomla
defined('_JEXEC') or die('Restricted access');

require_once JPATH_ROOT . '/modules/mod_jsshackslides/helper.php';

jimport('joomla.html.parameter');
JLoader::import('helpers.route', JPATH_SITE . '/components/com_content');


/**
 * Joomla Helper class
 *
 * @package     ShackSlides
 * @subpackage  Joomla Helper Class
 * @since       2.0
 */
class ModShackSlidesJoomlaHelper extends ModShackSlidesHelper
{
    private $content;

    private $category_id;

    private $ordering;

    private $ordering_direction;

    private $limit;

    private $featured;

    /**
     * Helper construct
     *
     * @param   string  $params  Joomla-related Initialization parameters
     */
    public function __construct($params)
    {
        parent::__construct($params);
        $this->category_id              = $params->get('joomla_category', 0);
        $this->ordering                 = $params->get('ordering', 'ordering');
        $this->ordering_direction       = $params->get('ordering_dir', 'ASC');
        $this->limit                    = $params->get('limit', '5');
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
        $database              = JFactory::getDBO();
        $user                  = JFactory::getUser();
        $featured_items        = '';
        $contentConfig         = JComponentHelper::getParams('com_content');
        $access                = !$contentConfig->get('shownoauth');
        $aid                   = $user->get('aid', 0);
        $now                   = date('Y-m-d H:i:s');
        $nullDate              = $database->getNullDate();

        if ($this->featured !== 'include') {
            $featured_query = "SELECT content_id FROM #__content_frontpage";
            $database->setQuery($featured_query);
            $featured_items = $database->loadResultArray();

            if (!is_array($featured_items) || !count($featured_items)) {
                $featured_items = '';
            } else {
                $featured_items = ' AND id ' . (($this->featured == 'exclude') ? 'NOT ' : '') . 'IN (' . implode(",", $featured_items) . ')';
            }
        }

        if ($this->ordering == 'RAND()') {
            $this->ordering = $this->generateOrdering();
        }

        $query = 'SELECT * FROM #__content' .
            ' WHERE catid =' . $this->category_id . $featured_items .
            ' AND state = 1' .
            ' AND (publish_up = ' . $database->Quote($nullDate) . ' OR publish_up <= ' . $database->Quote($now) . ')' .
            ' AND (publish_down = ' . $database->Quote($nullDate) . ' OR publish_down >= ' . $database->Quote($now) . ')' .
            ' ORDER BY ' . $this->ordering . ' ' . $this->ordering_direction .
            ' LIMIT ' . $this->limit;

        $database->setQuery($query);
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
            $item_images = json_decode($item->images);

            if ($item_images) {
                if ($this->joomla_image_source_type == 'intro') {
                    if ($item_images->image_intro != '') {
                        $this->images[] = $item_images->image_intro;
                    } else {
                        $this->images[] = NOIMAGEFOUND_IMG;
                    }
                } elseif ($this->joomla_image_source_type == 'full') {
                    if ($item_images->image_fulltext != '') {
                        $this->images[] = $item_images->image_fulltext;
                    } else {
                        $this->images[] = NOIMAGEFOUND_IMG;
                    }
                } elseif ($this->joomla_image_source_type == 'firstimage') {
                    $this->images[] = $this->getFirstImageFromContent($item->introtext);
                }
                // End setting image

                $this->titles[]   = $this->getTitleFromContent($item->title);
                $this->contents[] = $this->getTitleFromContent($item->introtext);
                $item->slug       = $item->alias ? ($item->id . ':' . $item->alias) : $item->id;
                $this->links[]    = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language), false);
            }
        }
    }
}
