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

jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

class ModShackSlidesFolderHelper extends ModShackSlidesHelper
{
    /**
     * @var string
     */
    protected $directory = null;

    /**
     * @var string
     */
    protected $folder;

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var string
     */
    protected $ordering = null;

    /**
     * @var string
     */
    protected $orderDirection = null;

    /**
     * ModShackSlidesFolderHelper constructor.
     *
     * @param Registry $params
     *
     * @return void
     * @throws Exception
     */
    public function __construct(Registry $params)
    {
        parent::__construct($params);

        $this->folder         = $params->get('folder_folder', 'modules/mod_jsshackslides/tmpl/demos');
        $this->directory      = JPATH_ROOT . '/' . $this->folder;
        $this->limit          = (int)$this->limit = $params->get('limit', 5);
        $this->ordering       = $params->get('ordering', 'ordering');
        $this->orderDirection = $params->get('ordering_dir', 'ASC');

        $this->loadImagesFromDirectory();

        $this->base = rtrim($this->base, '/') . '/' . trim($this->folder, '/') . '/';
    }

    /**
     * @return void
     */
    private function loadImagesFromDirectory()
    {
        $images = JFolder::files(
            $this->directory,
            '\.png$|\.gif$|\.jpg$|\.bmp$|\.jpeg$\.PNG$|\.GIF$|\.JPG$|\.BMP$|\.JPEG$'
        );

        $images = $this->orderFilesOrderingDirection($images);

        $this->images = array_slice($images, 0, $this->limit);

        $this->titles = array();
        foreach ($this->images as $image) {
            $info           = pathinfo($image);
            $this->titles[] = $info['filename'];
        }
    }

    /**
     * @param array $images
     *
     * @return array
     */
    private function orderFilesOrderingDirection($images)
    {
        $images_temp = array_values($images);


        switch ($this->ordering) {
            case 'ordering':
                if ($this->orderDirection == "ASC") {
                    ksort($images_temp);

                } else {
                    krsort($images_temp);
                }
                break;

            case 'title':
                if ($this->orderDirection == "ASC") {
                    asort($images_temp);

                } else {
                    arsort($images_temp);
                }
                break;
        }

        return $images_temp;
    }
}
