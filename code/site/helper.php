<?php
/**
 * @package     Shackslides
 * @subpackage  Functions
 *
 * @copyright   Copyright (C) 2010 - 2015 Joomlashack. Meritage Assets.  All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Restrict Access to within Joomla
defined('_JEXEC') or die('Restricted access');

/**
 * Main Shackslides Helper class
 *
 * @package     Shackslides
 * @subpackage  Main Helper Class
 * @since       2.0
 */
abstract class ModShackSlidesHelper
{
	protected $images;

	protected $titles;

	protected $links;

	protected $base;

	protected $menu;

	protected $contents;

	/**
	 * Helper construct
	 *
	 * @param   string  $params  Initialization parameters
	 */
	public function __construct($params)
	{
		$this->menu = JMenu::getInstance('site')->getMenu();
		$this->setBase(JURI::base());
	}

	/**
	 * Gets the saved images
	 *
	 * @return  array
	 */
	public function getImages()
	{
		return $this->images;
	}

	/**
	 * Sets the images to present
	 *
	 * @param   array/string  $images  Array of images or single image
	 *
	 * @return  void
	 */
	protected function setImages($images)
	{
		if (is_array($images))
		{
			$this->images = $images;
		}
		else
		{
			$this->images[] = $images;
		}
	}

	/**
	 * Gets the arrays of links
	 *
	 * @return  array
	 */
	public function getLinks()
	{
		return $this->links;
	}

	/**
	 * Sets the links
	 *
	 * @param   array/string  $links  Array of links or single link
	 *
	 * @return  void
	 */
	public function setLinks($links)
	{
		if (is_array($links))
		{
			$this->links = $links;
		}
		else
		{
			$this->links[] = $links;
		}
	}

	/**
	 * Gets the site base
	 *
	 * @return  string
	 */
	public function getBase()
	{
		return $this->base;
	}

	/**
	 * Sets the site base
	 *
	 * @param   string  $base  Site base
	 *
	 * @return  void
	 */
	protected function setBase($base)
	{
		$this->base = $base;
	}

	/**
	 * Gets the images titles
	 *
	 * @return  array
	 */
	public function getTitles()
	{
		return $this->titles;
	}

	/**
	 * Sets the titles
	 *
	 * @param   array/string  $titles  Array of titles or single title
	 *
	 * @return  void
	 */
	public function setTitles($titles)
	{
		if (is_array($titles))
		{
			$this->titles = $titles;
		}
		else
		{
			$this->titles[] = $titles;
		}
	}

	/**
	 * Gets the images contents
	 *
	 * @return  array
	 */
	public function getContents()
	{
		return $this->contents;
	}

	/**
	 * Sets the contents
	 *
	 * @param   array/string  $contents  Array of contents or single content
	 *
	 * @return  void
	 */
	public function setContents($contents)
	{
		if (is_array($contents))
		{
			$this->contents = $contents;
		}
		else
		{
			$this->contents[] = $contents;
		}
	}

	/**
	 * Gets the first image found in a certain string
	 *
	 * @param   string  $content  Content to parse
	 *
	 * @return  string
	 */
	protected function getFirstImageFromContent($content)
	{
		preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $content, $matches);

		if (isset($matches[1]))
		{
			$image = $matches[1];

			return $image;
		}
		else
		{
			return 'modules/mod_jsshackslides/images/noimagefound.png';
		}
	}

	/**
	 * Gets the title (using a tag parse) from a certain string
	 *
	 * @param   string  $content  Content to parse
	 *
	 * @return  string
	 */
	protected function getTitleFromContent($content)
	{
		$title = strip_tags($content, '<p><h1><h2><h3><h4><h5><h6><span><b><i><u><strong><em><br>');

		if (trim($title) == '')
		{
			return '';
		}

		return $title;
	}

	/**
	 * Compare a query string using and separating its fields
	 *
	 * @param   array  $fields  Fields
	 *
	 * @return  boolean
	 */
	protected function compareQuery($fields)
	{
		foreach ($this->menu as $item)
		{
			$diff = array_diff_assoc($fields, $item->query);

			if (!count($diff))
			{
				return $item->id;
			}

			continue;
		}

		return false;
	}
}
