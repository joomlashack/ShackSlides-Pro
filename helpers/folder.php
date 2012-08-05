<?php

/**
 * @version   1.x
 * @package   ShackSlides
 * @copyright (C) 2010 Joomlashack / Meritage Assets Corp
 * @license   GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die('Direct access to files is not permitted');

require_once(JPATH_ROOT.DS.'modules'.DS.'mod_shackslides'.DS.'helper.php');

class ModShackSlidesFolderHelper extends ModShackSlidesHelper
{
	private $directory;
	private $folder;
	private $limit;
	private $xml = false;

	public function  __construct($params) {
        parent::__construct($params);
		$this->folder = $params->get('folder_folder', 'modules'.DS.'mod_shackslides'.DS.'tmpl'.DS.'demos');
		$this->directory =  JPATH_ROOT.DS.$this->folder;
		$this->limit = $this->limit = $params->get('limit', '5');

		if (is_file($this->directory.DS.'images.xml')) $this->xml = simplexml_load_file($this->directory.DS.'images.xml');

		if ($this->xml)
		{
			$this->loadImagesFromXML();
		}
		else
		{
			$this->loadImagesFromDirectory();
		}

		$this->setBase(JURI::base().str_replace('\\', '/', $this->folder).'/');
	}

	private function loadImagesFromXML()
	{
		$i = 0;
		foreach ($this->xml->xpath('//slide') as $slide)
		{
			if ($i < $this->limit) {
				$this->images[] = $slide->image;
				$this->links[] = (isset($slide->link)) ? $slide->link : false;
				$this->titles[] = (isset($slide->title)) ? $slide->title : false;
			}
			$i++;
		}
	}

	private function loadImagesFromDirectory()
	{
		jimport('joomla.filesystem.folder');

		$images = JFolder::files($this->directory, '\.png$|\.gif$|\.jpg$|\.bmp$|\.jpeg$');

        sort($images);

		while (count($images) > $this->limit)
		{
			array_pop($images);
		}

		$this->images = $images;
	}
}