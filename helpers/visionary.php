<?php

/**
 * @version   1.x
 * @package   ShackSlides
 * @copyright (C) 2010 Joomlashack / Meritage Assets Corp
 * @license   GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die('Direct access to files is not permitted');

require_once(JPATH_ROOT.DS.'modules'.DS.'mod_shackslides'.DS.'helper.php');

class ModShackSlidesVisionaryHelper extends ModShackSlidesHelper {


	private $collection;
	private $content;
	private $ordering;
	private $ordering_direction;
	private $limit;
	private $featured;

	public function __construct($params) {

		parent::__construct($params);

		$this->collection = $params->get('visionary_collection', 0);
		$this->ordering = $params->get('ordering', 'ordering');
		$this->ordering_direction = $params->get('ordering_direction', 'ASC');
		$this->limit = $params->get('limit', '5');
		$this->featured = $params->get('featured', 'include');

		$this->getContentFromDatabase();
		$this->parseContentIntoProperties();

	}

	private function getContentFromDatabase() {


		$db = JFactory::getDbo();
		$user = JFactory::getUser();

		$query = 'SELECT * FROM `#__jsvisionary_jsssslide` WHERE published = 1 AND slider =' . $this->collection;

		if ($this->ordering != 'ordering') {

			$query .= ' ORDER BY ';
			switch ($this->ordering) {
				case 'title':
					$query .= ' title ';
					break;
				case ' ordering ':
					$query .= ' ordering ';
					break;
				case 'created'
					$query .= ' creation_date ';
					break;
			}

			$query .= ' ' . $this->ordering_direction;

		}

		$query .= ' LIMIT ' . $this->limit;

		$db->setQuery($query);
		$this->content = $db->loadObjectList();

	}

	private function parseContentIntoProperties() {

		foreach($this->content as $item) {

			$this->images []= $item->image;
			$this->titles []= $item->title;
			$this->links []= $item->url;

		}

	}




}