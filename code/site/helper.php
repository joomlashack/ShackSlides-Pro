<?php
/**
 * @package     Shackslides
 * @subpackage  Helper
 *
 * @copyright   Copyright (C) 2010 - 2015 Joomlashack. Meritage Assets.  All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Restrict Access to within Joomla
defined('_JEXEC') or die('Restricted access');

define("NOIMAGEFOUND_IMG", "media/mod_jsshackslides/images/noimagefound.png");

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
			return NOIMAGEFOUND_IMG;
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

	/**
	 * Convert animation output
	 *
	 * @param   string  $animation  Animation input to convert in options for Owl Carousel
	 *
	 * @return  boolean
	 */
	public function convertAnimation($animation)
	{
		$animationIn = '';
		$animationOut = '';
		$finalAnimation = '';

		switch ($animation)
		{
			// LTR effects
			case 'bounced_slide':
				$animationIn = 'bounceInRight';
				$animationOut = 'bounceOutLeft';
				break;
			case 'faded_slide':
				$animationIn = 'fadeInRight';
				$animationOut = 'fadeOutLeft';
				break;

			// RTL effects
			case 'slide_rtl':
				$animationIn = 'slideInLeft';
				$animationOut = 'slideOutRight';
				break;
			case 'bounced_slide_rtl':
				$animationIn = 'bounceInLeft';
				$animationOut = 'bounceOutRight';
				break;
			case 'faded_slide_rtl':
				$animationIn = 'fadeInLeft';
				$animationOut = 'fadeOutRight';
				break;

			// TTB effects
			case 'slide_ttb':
				$animationIn = 'slideInDown';
				$animationOut = 'slideOutDown';
				break;
			case 'bounced_slide_ttb':
				$animationIn = 'bounceInDown';
				$animationOut = 'bounceOutDown';
				break;
			case 'faded_slide_ttb':
				$animationIn = 'fadeInDown';
				$animationOut = 'fadeOutDown';
				break;

			// BTT effects
			case 'slide_btt':
				$animationIn = 'slideInUp';
				$animationOut = 'slideOutUp';
				break;
			case 'bounced_slide_btt':
				$animationIn = 'bounceInUp';
				$animationOut = 'bounceOutUp';
				break;
			case 'faded_slide_btt':
				$animationIn = 'fadeInUp';
				$animationOut = 'fadeOutUp';
				break;

			// In place effects
			case 'fade':
				$animationIn = 'fadeIn';
				$animationOut = 'fadeOut';
				break;
			case 'bounce':
				$animationIn = 'zoomIn';
				$animationOut = 'bounceOut';
				break;
			case 'roll':
				$animationIn = 'rollIn';
				$animationOut = 'rollOut';
				break;
			case 'zoom':
				$animationIn = 'zoomIn';
				$animationOut = 'zoomOut';
				break;
			case 'switch':
				$animationIn = 'slideInUp';
				$animationOut = 'fadeOutDown';
				break;
			case 'flip_horizontal':
				$animationIn = 'flipInYFaded';
				$animationOut = 'flipOutY';
				break;
			case 'flip_vertical':
				$animationIn = 'flipInXFaded';
				$animationOut = 'flipOutX';
				break;

			// Rotate effects
			case 'rotate':
				$animationIn = 'rotateIn';
				$animationOut = 'rotateOut';
				break;
			case 'rotate_downleft':
				$animationIn = 'rotateInDownLeft';
				$animationOut = 'rotateOutDownLeft';
				break;
			case 'rotate_downright':
				$animationIn = 'rotateInDownRight';
				$animationOut = 'rotateOutDownRight';
				break;
			case 'rotate_upleft':
				$animationIn = 'rotateInUpLeft';
				$animationOut = 'rotateOutUpLeft';
				break;
			case 'rotate_upright':
				$animationIn = 'rotateInUpRight';
				$animationOut = 'rotateOutUpRight';
				break;

			// No special effects
			default:
				$animationIn = $animationOut = '';
		}

		if ($animationIn != '')
		{
			$finalAnimation .= ', animateIn: \'' . $animationIn . '\'';
		}

		if ($animationOut != '')
		{
			$finalAnimation .= ', animateOut: \'' . $animationOut . '\'';
		}

		return $finalAnimation;
	}

	/**
	 * Generate random container ID
	 *
	 * @param   string  $prefix  Prefix to add to the container id
	 * @param   int     $length  ID length
	 *
	 * @return  string
	 */
	public function generateContainerID($prefix = 'jss_', $length = 10)
	{
		$randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length);

		return $prefix . $randomString;
	}

	/**
	 * Generate random ordering 
	 *
	 * @param   int  $number  Range for getting the random number
	 *
	 * @return  string
	 */
	public function generateOrdering($number = 4)
	{
		$random = mt_rand(0, $number);
		$ordering = '';

		switch ($random)
		{
			case 1:
				$ordering = 'title';
				break;
			case 2:
				$ordering = 'created';
				break;
			case 3:
				$ordering = 'hits';
				break;
			default:
				$ordering = 'ordering';
				break;
		}

		return $ordering;
	}

	/**
	 * Convert Hex color to RGB array
	 *
	 * @param   string  $hex  Hex color string
	 *
	 * @return  array
	 */
	public function hexToRGB($hex)
	{
		$hex = str_replace("#", "", $hex);

		if (strlen($hex) == 3)
		{
			$r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
			$g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
			$b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
		}
		else
		{
			$r = hexdec(substr($hex, 0, 2));
			$g = hexdec(substr($hex, 2, 2));
			$b = hexdec(substr($hex, 4, 2));
		}

		$rgb = array($r, $g, $b);

		return $rgb;
	}

	/**
	 * Set up dot images when uploading an image file
	 *
	 * @param   string  $image     Path of the image in media
	 * @param   string  $css_rule  Css rule that will be applied according to the case
	 * @param   string  $doc       Joomla Document
	 *
	 * @return  array
	 */
	public function applyingCustomImages($image, $css_rule, $doc)
	{
		$image_dots = JUri::root(true) . '/' . $image;
		list($width, $height) = getimagesize(JUri::root() . '/' . $image);
		$doc->addStyleDeclaration('
			' . $css_rule . ' {
				background: url(' . $image_dots . ') no-repeat;
				width:' . $width . 'px;
				height:' . $height . 'px;
			}'
		);

		return array($width, $height);
	}
}
