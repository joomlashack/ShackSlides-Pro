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

if (!defined('JPATH_ADMIN_JSVISIONARY')) {
    define('JPATH_ADMIN_JSVISIONARY', JPATH_ADMINISTRATOR . '/components/com_jsvisionary');
}
if (!defined('JPATH_SITE_JSVISIONARY')) {
    define('JPATH_SITE_JSVISIONARY', JPATH_SITE . '/components/com_jsvisionary');
}

class ModShackSlidesVisionaryHelper extends ModShackSlidesHelper
{
    /**
     * @var int
     */
    protected $collection;

    /**
     * @var object[]
     */
    protected $content;

    /**
     * @var string
     */
    protected $ordering;

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
     * ModShackSlidesVisionaryHelper constructor.
     *
     * @param Registry $params
     *
     * @return void
     * @throws Exception
     */
    public function __construct(Registry $params)
    {
        parent::__construct($params);

        $this->collection = (int)$params->get('visionary_collection', 0);
        $this->ordering   = $params->get('ordering', 'ordering');
        switch (strtolower($this->ordering)) {
            case 'created':
                $this->ordering = 'created_on';
                break;
        }

        $this->orderingDirection = $params->get('ordering_dir', 'ASC');
        $this->limit             = (int)$params->get('limit', '5');
        $this->featured          = $params->get('featured', 'include');

        $this->getContentFromDatabase();
        $this->parseContentIntoProperties();
    }

    /**
     * @return void
     */
    protected function getContentFromDatabase()
    {
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__jsvisionary_slides')
            ->where(
                array(
                    'enabled = 1',
                    'collection_id =' . $this->collection
                )
            )
            ->order($this->ordering . ' ' . $this->orderingDirection);

        $this->content = $db->setQuery($query, 0, $this->limit)->loadObjectList();
    }

    /**
     * @return void
     */
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
        $path = JPath::clean($path);

        $markers = $this->getMarkers();

        if (!preg_match('/\[.+\]/', $path)) {
            $path = '[DIR_JSSSSLIDE_IMAGE]' . $path;
        }

        // DIR SPECIFIC FOLDERS (Starts with DIR... )
        foreach ($markers as $marker => $pathStr) {
            if (substr($marker, 0, 3) == 'DIR') {
                $path = preg_replace('/\[' . $marker . '\]/', $pathStr, $path);
            }
        }

        // OTHER MARKERS
        foreach ($markers as $marker => $pathStr) {
            if (substr($marker, 0, 3) != 'DIR') {
                $path = preg_replace('/\[' . $marker . '\]/', $pathStr, $path);
            }
        }

        $path = preg_replace('/\[.+\]/', '', $path);  // Clean tags if remains

        //convert absolute server path to URL
        $url = JUri::root() . str_replace(JPATH_BASE . '/', '', $path);

        return $url;
    }

    /**
     * @return array
     */
    protected function getMarkers()
    {
        $configMedias = JComponentHelper::getParams('com_media');
        $config       = JComponentHelper::getParams('com_jsvisionary');

        $markers = array(
            'DIR_JSSSSLIDE_IMAGE' => $config->get('upload_dir_jsssslide_image', JPATH_SITE) . '/',
            'DIR__TRASH'          => $config->get('trash_dir', JPATH_ADMIN_JSVISIONARY . '/images/trash') . '/',
            'COM_ADMIN'           => JPATH_ADMIN_JSVISIONARY,
            'ADMIN'               => JPATH_ADMINISTRATOR,
            'COM_SITE'            => JPATH_SITE_JSVISIONARY,
            'IMAGES'              => JPATH_SITE . '/' . $config->get('image_path', 'images') . '/',
            'MEDIAS'              => JPATH_SITE . '/' . $configMedias->get('file_path', 'images') . '/',
            'ROOT'                => JPATH_SITE
        );

        return $markers;
    }
}
