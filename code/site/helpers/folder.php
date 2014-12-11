<?php

/**
 * @version   1.x
 * @package   ShackSlides
 * @copyright (C) 2010 Joomlashack / Meritage Assets Corp
 * @license   GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die('Direct access to files is not permitted');

require_once(JPATH_ROOT.'/'.'modules'.'/'.'mod_jsshackslides'.'/'.'helper.php');

class ModShackSlidesFolderHelper extends ModShackSlidesHelper
{
	private $directory;
	private $folder;
	private $limit;
	private $xml = false;

	public function  __construct($params) 
	{
        parent::__construct($params);
		$this->folder = $params->get('folder_folder', 'modules'.'/'.'mod_jsshackslides'.'/'.'tmpl'.'/'.'demos');
		$this->directory =  JPATH_ROOT.'/'.$this->folder;
		$this->limit = $this->limit = $params->get('limit', '5');
		$this->ordering = $params->get('ordering', 'ordering');
		$this->ordering_direction = $params->get('ordering_dir', 'ASC');

		$this->loadImagesFromDirectory();

		$this->setBase(JURI::base().str_replace('\\', '/', $this->folder).'/');
	}

	private function loadImagesFromDirectory()
	{
		jimport('joomla.filesystem.folder');

		$images = JFolder::files($this->directory, '\.png$|\.gif$|\.jpg$|\.bmp$|\.jpeg$\.PNG$|\.GIF$|\.JPG$|\.BMP$|\.JPEG$');

		$images = $this->orderFilesOrderingDirection($images);

		$i = 0;
		$images_temp = array();
		while ($i < $this->limit)
		{
			$images_temp[] = array_shift($images);
			$i += 1;
		}

		$this->images = $images_temp;
	}

	private function orderFilesOrderingDirection($images)
	{	
		$images_temp = array();
		foreach ($images as $key => $value) 
		{
			$images_temp[] = strtolower($value); 
		}

		if($this->ordering == 'RAND()')
		{
			$i = mt_rand(0,1);
			if($i == 0)
			{
				$this->ordering = 'ordering';
			}
			else
			{
				$this->ordering = 'title';
			}
		}

		switch ($this->ordering) 
		{
			case 'ordering':

				if($this->ordering_direction == "ASC")
				{
					ksort($images_temp);
				}
				else
				{
					krsort($images_temp);
				}
				break;
			case 'title':

				if($this->ordering_direction == "ASC")
				{
					asort($images_temp);
				}
				else
				{
					arsort($images_temp);
				}
				break;
		}

		return $images_temp;
	}

}