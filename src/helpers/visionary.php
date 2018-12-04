<?php

/**
 * @version       1.x
 * @package       Shack Slides
 * @copyright (C) 2010 Joomlashack / Meritage Assets Corp
 * @license       GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die();

if (!defined('JPATH_ADMIN_JSVISIONARY')) {
    define('JPATH_ADMIN_JSVISIONARY', JPATH_ADMINISTRATOR . '/components/com_jsvisionary');
}
if (!defined('JPATH_SITE_JSVISIONARY')) {
    define('JPATH_SITE_JSVISIONARY', JPATH_SITE . '/components/com_jsvisionary');
}

jimport('joomla.application.component.helper');

class ModShackSlidesVisionaryHelper extends ModShackSlidesHelper
{
    protected $collection;
    protected $content;
    protected $ordering;
    protected $ordering_direction;
    protected $limit;
    protected $featured;

    public function __construct($params)
    {
        parent::__construct($params);

        $this->collection = $params->get('visionary_collection', 0);
        if ($this->collection != 'None') {
            $this->ordering = $params->get('ordering', 'ordering');
            if ($this->ordering == 'RAND()') {
                $this->ordering = $this->generateOrdering(1);
            }
            if ($this->ordering == 'created') {

                //fix column name for Visionary
                $this->ordering = 'created_on';
            }

            $this->ordering_direction = $params->get('ordering_dir', 'ASC');
            $this->limit              = $params->get('limit', '5');
            $this->featured           = $params->get('featured', 'include');

            $this->getContentFromDatabase();
            $this->parseContentIntoProperties();
        }
    }

    protected function getContentFromDatabase()
    {
        $db    = JFactory::getDbo();
        $user  = JFactory::getUser();
        $query = 'SELECT * FROM `#__jsvisionary_slides` WHERE enabled = 1 AND collection_id =' . $this->collection;
        $query .= ' ORDER BY ' . $this->ordering . ' ' . $this->ordering_direction;
        $query .= ' LIMIT ' . $this->limit;
        $db->setQuery($query);
        $this->content = $db->loadObjectList();
    }

    protected function parseContentIntoProperties()
    {
        foreach ($this->content as $item) {
            $this->images []  = $this->createImageUrl($item->image);
            $this->titles []  = $item->title;
            $this->contents[] = $item->description;
            $this->links []   = $item->url;
        }

        $this->base = '';
    }


    protected function createImageUrl($path)
    {


        // Protect against back dir
        if ('/' == "\\") {
            $ds = "\\\\";
        } else {
            $ds = "\/";
        }

        $path = preg_replace("/\.\." . $ds . "/", "", $path);

        $markers = $this->getMarkers();

        if (!preg_match("/\[.+\]/", $path)) {
            $path = '[DIR_JSSSSLIDE_IMAGE]' . $path;
        }

        //DIR SPECIFIC FOLDERS (Starts with DIR... )
        foreach ($markers as $marker => $pathStr) {
            if (substr($marker, 0, 3) == "DIR") {
                $path = preg_replace("/\[" . $marker . "\]/", $pathStr, $path);
            }
        }

        //OTHER MARKERS
        foreach ($markers as $marker => $pathStr) {
            if (substr($marker, 0, 3) != "DIR") {
                $path = preg_replace("/\[" . $marker . "\]/", $pathStr, $path);
            }
        }


        $path = preg_replace("/\[.+\]/", "", $path);  // Clean tags if remains

        //convert absolute server path to URL
        $url = JURI::root() . str_replace(JPATH_BASE . '/', '', $path);

        return $url;
    }


    protected function getMarkers()
    {
        $configMedias = JComponentHelper::getParams('com_media');
        $config       = JComponentHelper::getParams('com_jsvisionary');

        $markers = array(
            'DIR_JSSSSLIDE_IMAGE' => $config->get("upload_dir_jsssslide_image", JPATH_SITE) . '/',
            'DIR__TRASH'          => $config->get("trash_dir",
                    JPATH_ADMIN_JSVISIONARY . '/' . "images" . '/' . "trash") . '/',

            'COM_ADMIN' => JPATH_ADMIN_JSVISIONARY,
            'ADMIN'     => JPATH_ADMINISTRATOR,
            'COM_SITE'  => JPATH_SITE_JSVISIONARY,
            'IMAGES'    => JPATH_SITE . '/' . $config->get('image_path', 'images') . '/',
            'MEDIAS'    => JPATH_SITE . '/' . $configMedias->get('file_path', 'images') . '/',
            'ROOT'      => JPATH_SITE
        );


        return $markers;
    }
}
