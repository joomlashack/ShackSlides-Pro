<?php

/**
 * @package   ShackSlides
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @copyright 2010-2021 Joomlashack.com. All rights reserved
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

use Joomla\Registry\Registry;

defined('_JEXEC') or die();

class ModShackSlidesFolderHelper extends ModShackSlidesHelper
{
    /**
     * @var string
     */
    protected $directory = null;

    /**
     * @var string
     */
    protected $folder = null;

    /**
     * @var int
     */
    protected $limit = null;

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
    protected function loadImagesFromDirectory()
    {
        $dir = new DirectoryIterator($this->directory);

        $images = [];
        foreach ($dir as $file) {
            if ($this->isImageFile($file->getRealPath())) {
                $images[] = $file->getBasename();
            }
        }

        $images = $this->sortImages($images);

        $this->images = array_slice($images, 0, $this->limit);

        $this->titles = array();
        foreach ($this->images as $image) {
            $info           = pathinfo($image);
            $this->titles[] = $info['filename'];
        }
    }

    /**
     * @param string $filePath
     *
     * @return bool
     */
    protected function isImageFile($filePath)
    {
        if (is_file($filePath)) {
            if (is_callable('mime_content_type')) {
                return stripos(mime_content_type($filePath), 'image/') === 0;
            }

            $pathInfo = pathinfo($filePath);
            if (!empty($pathInfo['extension'])) {
                return in_array(
                    strtolower($pathInfo['extension']),
                    array('png', 'gif', 'jpg', 'bmp', 'jpeg')
                );
            }
        }

        return false;
    }

    /**
     * @param string[] $images
     *
     * @return string[]
     */
    protected function sortImages($images)
    {
        switch ($this->ordering) {
            case 'hits':
            case 'ordering':
                /*
                 * We're interpreting 'ordering' as whatever order the
                 * file system provided them in. Since 'hits' makes no
                 * sense for folders, we'll treat it as the same as 'ordering'
                 */

                if ($this->orderDirection == 'DESC') {
                    $images = array_reverse($images);
                }
                break;

            case 'created':
                /*
                 * Technically, on *nix systems there is no creation time
                 * but filectime() gives us the inode change time, which is
                 * about as good as it gets. Windows systems will provide
                 * the creation time.
                 */
                $directory      = $this->directory;
                $directionValue = $this->orderDirection == 'ASC' ? 1 : -1;

                usort(
                    $images,
                    function ($a, $b) use ($directory, $directionValue) {
                        $created_a = filectime($directory . '/' . $a);
                        $created_b = filectime($directory . '/' . $b);
                        return $created_a > $created_b
                            ? $directionValue
                            : ($created_a == $created_b ? 0 : 0 - $directionValue);
                    }
                );
                break;

            case 'title':
                natsort($images);
                if ($this->orderDirection == 'DESC') {
                    $images = array_reverse($images);
                }
                break;

            case 'RAND()':
                shuffle($images);
                break;

        }

        return array_values($images);
    }
}
