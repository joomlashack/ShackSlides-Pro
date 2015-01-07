<?php
/**
 * @package     Shackslides
 * @subpackage  Module
 *
 * @copyright   Copyright (C) 2010 - 2015 Joomlashack. Meritage Assets.  All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Restrict Access to within Joomla
defined('_JEXEC') or die('Restricted access');

require_once dirname(__FILE__) . '/helpers/' . $params->get('source', 'folder') . '.php';

$doc = JFactory::getDocument();

$helperClass = 'ModShackSlides' . ucfirst($params->get('source', 'folder')) . 'Helper';
$helper = new $helperClass($params);

$images = $helper->getImages();
$links = $helper->getLinks();
$titles = $helper->getTitles();
$contents = $helper->getContents();
$base = $helper->getBase();

if (!$images)
{
	// If there are no images set, there is nothing to be shown
	echo "<img src=" . $base . NOIMAGEFOUND_IMG . " />";

	return;
}

$defaults = array(
	// BASIC CONFIGURATION OPTIONS
	// Container height
	'height' => '250',
	// Height adjustment
	'height_adjustment' => 'adjust',
	// Auto height (depends on the height adjustment)
	'slide_autoheight' => 'true',
	// Transition delay
	'slide_delay' => '5000',
	// Show descriptions
	'description' => 'yes',
	// Transition speed
	'slide_effect_masterspeed' => '300',
	// Effect for slides
	'slide_effect' => 'slide',
	// Stop on mouse hover
	'slide_onhoverstop' => '1',
	// Number of items per slide page
	'slide_items' => '1',
	// Margin between slides when using multiple per page
	'slide_margin' => '10',
	// Autoplay on or off
	'slide_autoplay' => '1',

	// SLIDE SOURCES
	// Where the link target will point at
	'anchor_target' => 'self',

	// DESCRIPTION OPTIONS
	// Title and description position
	'title_description_position' => 'bottom',
	// Title and description alignment
	'title_description_alignment' => 'left',
	// Title and description vertical padding
	'title_description_padding_vertical' => '10',
	// Title and description horizontal padding
	'title_description_padding_horizontal' => '10',
	// Show title flag
	'title_show' => '1',
	// Title width
	'title_width' => '300',
	// Title height
	'title_height' => '50',
	// Title color flag
	'title_bgcolor_flag' => '1',
	// Title color
	'title_color' => '#FFFFFF',
	// Title background color flag
	'title_color_flag' => '1',
	// Title background color
	'title_bgcolor' => '#000000',
	// Title background opacity
	'title_bgcolor_opacity' => '70',
	// Title effect
	'title_effect' => 'none',
	// Title tag
	'title_tag' => 'h4',
	// Show description flag
	'description_show' => '1',
	// Description width
	'description_width' => '300',
	// Description height
	'description_height' => '100',
	// Description color flag
	'description_color_flag' => '1',
	// Description color
	'description_color' => '#FFFFFF',
	// Description background color flag
	'description_bgcolor_flag' => '1',
	// Description background color
	'description_bgcolor' => '#000000',
	// Description background opacity
	'description_bgcolor_opacity' => '70',
	// Description effect
	'description_effect' => 'none',
	// Description tag
	'description_tag' => 'p',

	// NAVIGATION OPTIONS
	// Show the navigation always, never, on hover
	'navigation_show' => '2',
	// Navigation theme
	'navigation_theme' => 'default',
	// Show slide numbers in navigation
	'navigation_shownumbers' => '0',
	// Orientation
	'navigation_orientation' => 'horizontal',
	// Horizontal alignment
	'navigation_align_horizontal' => 'center',
	// Vertical alignment
	'navigation_align_vertical' => 'bottom',
	// Horizontal padding
	'navigation_padding_horizontal' => '10',
	// Vertical padding
	'navigation_padding_vertical' => '10',
	// Opacity
	'navigation_opacity' => '100',
	// Custom nav dot
	'navigation_custom_dot' => '',
	// Custom active nav dot
	'navigation_custom_dotactive' => '',
	// Show the navigation buttons always, never, on hover
	'navigation_buttons_show' => '2',
	// Buttons opacity
	'navigation_buttons_opacity' => '100',
	// Custom previous button
	'navigation_buttons_custom_previous' => '',
	// Custom next button
	'navigation_buttons_custom_next' => '',

	// ADVANCED OPTIONS
	// id for the slider container
	'container' => '',
	// Include JQuery
	'includejquery' => 'off'
);

$settings = Array();

// Sets all keys from settings in $settings array
foreach ($defaults as $key => $default)
{
	$settings[$key] = $params->get($key, $default);
}

// Load jQuery
if (version_compare(JVERSION, '3.0', '<') == 1)
{
	// Load local file if Joomla < 3
	if (!JFactory::getApplication()->get('jquery'))
	{
		JFactory::getApplication()->set('jquery', true);

		if ($settings['includejquery'] == 'on')
		{
			JHtml::script('mod_jsshackslides/jquery-1.11.2.min.js', false, true);
			JHtml::script('mod_jsshackslides/jquery-noconflict.js', false, true);
		}
	}
}
else
{
	// Load jQuery Framework if Joomla >= 3
	JHTML::_('jquery.framework');
}

JHtml::stylesheet('mod_jsshackslides/owl.carousel.min.css', array(), true);
JHtml::stylesheet('mod_jsshackslides/animate.min.css', array(), true);
JHtml::stylesheet('mod_jsshackslides/jsshackslides.css', array(), true);
JHtml::script('mod_jsshackslides/owl.carousel.min.js', false, true);

// Setting container ID
if ($settings['container'] == '')
{
	$settings['container'] = $helper->generateContainerID();
}

// Default effect masterspeed = 1ms (CSS3 won't work with 0 to avoid the effect)
$effectMasterSpeed = '1';

// Sets the masterspeed for the selected effect
if ($settings['slide_effect'] != 'none')
{
	$effectMasterSpeed = $settings['slide_effect_masterspeed'];
}

$settings['slides_animation'] = $helper->convertAnimation($settings['slide_effect']);
$settings['slide_center'] = ($settings['slide_items'] == 1 ? 'true' : 'false');
$settings['slide_effect_masterspeed'] = $effectMasterSpeed;

$doc->addStyleDeclaration('
	#' . $settings['container'] . '.owl-carousel .owl-item,
	#' . $settings['container'] . '.owl-carousel .animated {
			-webkit-animation-duration:' . $effectMasterSpeed . 'ms;
			animation-duration:' . $effectMasterSpeed . 'ms;
		}'
);

// Defined height in case of adjustment (to set a max height for the slider)
if ($settings['height_adjustment'] == 'adjust')
{
	$height = (int) $settings['height'];

	if ($height > 0)
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.owl-carousel .owl-item .jss-image {
				max-height: ' . $height . 'px;
			}'
		);
	}
}
elseif ($settings['height_adjustment'] == 'crop')
{
	$settings['slide_autoheight'] = 'false';
	$doc->addStyleDeclaration('
		#' . $settings['container'] . '.owl-carousel .owl-item .jss-image {
			width: 100%;
			height: ' . $settings['height'] . 'px;
		}'
	);
}

// Description styles
if ($settings['description_show'])
{
	// Description color
	if ($settings['description_color_flag'])
	{
		$doc->addStyleDeclaration(
			'#' . $settings['container'] . '.owl-carousel .owl-item .jss-description > * {
				color: #' . $settings['description_color'] . ';
			}'
		);
	}

	// Description background
	if ($settings['description_bgcolor_flag'])
	{
		$settings['description_bgcolor'] = implode(',', $helper->hexToRGB($settings['description_bgcolor']));
		$doc->addStyleDeclaration(
			'#' . $settings['container'] . '.owl-carousel .owl-item .jss-description {
				background-color: rgba(' . $settings['description_bgcolor'] . ', ' . ($settings['description_bgcolor_opacity'] / 100) . ')
			}'
		);
	}

	// Description width
	if ($settings['title_description_position'] == 'left'
		|| $settings['title_description_position'] == 'right'
		|| $settings['title_description_position'] == 'left_outside'
		|| $settings['title_description_position'] == 'right_outside')
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.owl-carousel .owl-item .jss-description {
				width: ' . (int) $settings['description_width'] . 'px;
			}'
		);
	}

	// Description height
	if ($settings['title_description_position'] == 'top' || $settings['title_description_position'] == 'bottom')
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.owl-carousel .owl-item .jss-description {
				min-height: ' . (int) $settings['description_height'] . 'px;
			}'
		);
	}

	// Left outside description
	if ($settings['title_description_position'] == 'left_outside')
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.owl-carousel .jss-image {
				padding-left: ' . (int) $settings['description_width'] . 'px;
			}'
		);
	}

	// Right outside title
	if ($settings['title_description_position'] == 'right_outside')
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.owl-carousel .jss-image {
				padding-right: ' . (int) $settings['description_width'] . 'px;
			}'
		);
	}
}

// Title styles
if ($settings['title_show'])
{
	// Title color
	if ($settings['title_color_flag'])
	{
		$doc->addStyleDeclaration(
			'#' . $settings['container'] . '.owl-carousel .owl-item .jss-title > * {
				color: #' . $settings['title_color'] . ';
			}'
		);
	}

	// Title background
	if ($settings['title_bgcolor_flag'])
	{
		$settings['title_bgcolor'] = implode(',', $helper->hexToRGB($settings['title_bgcolor']));
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.owl-carousel .owl-item .jss-title {
				background-color: rgba(' . $settings['title_bgcolor'] . ', ' . ($settings['title_bgcolor_opacity'] / 100) . ')
			}'
		);
	}

	// Title width
	if ($settings['title_description_position'] == 'left'
		|| $settings['title_description_position'] == 'right'
		|| $settings['title_description_position'] == 'left_outside'
		|| $settings['title_description_position'] == 'right_outside')
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.owl-carousel .jss-image .jss-title {
				width: ' . (int) $settings['title_width'] . 'px;
			}'
		);
	}

	// Title height
	if ($settings['title_description_position'] == 'top' || $settings['title_description_position'] == 'bottom')
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.owl-carousel .jss-image .jss-title {
				min-height: ' . (int) $settings['title_height'] . 'px;
			}'
		);
	}

	// Left outside title
	if ($settings['title_description_position'] == 'left_outside')
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.owl-carousel .jss-image {
				padding-left: ' . (int) $settings['title_width'] . 'px;
			}'
		);
	}

	// Right outside title
	if ($settings['title_description_position'] == 'right_outside')
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.owl-carousel .jss-image {
				padding-right: ' . (int) $settings['title_width'] . 'px;
			}'
		);
	}
}

// Title and Description padding (shared setting)
if ($settings['description_show'] || $settings['title_show'])
{
	$doc->addStyleDeclaration('
		#' . $settings['container'] . '.owl-carousel .jss-image .jss-title-description .jss-title,
		#' . $settings['container'] . '.owl-carousel .jss-image .jss-title-description .jss-description {
			padding: ' . (int) $settings['title_description_padding_vertical'] . 'px ' . (int) $settings['title_description_padding_horizontal'] . 'px;
		}'
	);
}

// Navigation
if ($settings['navigation_show'] != '0')
{
	// Navigation is shown - always or just on hover (default by css)
	$doc->addStyleDeclaration('
		#' . $settings['container'] . '.owl-carousel' . (($settings['navigation_show'] == '1') ? ':hover' : '') . ' .owl-dots {
			opacity: ' . (((int) $settings['navigation_opacity']) / 100) . ';
		}'
	);

	$settings['navigation_show'] = 'true';
	$verticalPosition = '';
	$horizontalPosition = '';
	$dotsWidth = 30;
	$dotsHeight = 30;
	$dotsPadding = 5;
	$buttonsPrevHeight = 40;
	$buttonsPrevWidth = 40;
	$buttonsNextHeight = 40;
	$buttonsNextWidth = 40;

	switch ($settings['navigation_align_vertical'])
	{
		case 'center':
			$verticalPosition = 'top: 0; bottom: 0';
			break;
		case 'top':
			$verticalPosition = 'top: 0';
			break;
		case 'bottom':
			$verticalPosition = 'bottom: 0';
			break;
	}

	switch ($settings['navigation_align_horizontal'])
	{
		case 'center':
			$horizontalPosition = 'left: 0; right: 0';
			break;
		case 'left':
			$horizontalPosition = 'left: 0';
			break;
		case 'right':
			$horizontalPosition = 'right: 0';
			break;
	}

	// Navigation settings
	$doc->addStyleDeclaration('
		#' . $settings['container'] . '.owl-carousel .owl-dots {
			padding: ' . (int) $settings['navigation_padding_vertical'] . 'px ' . (int) $settings['navigation_padding_horizontal'] . 'px;
			' . $verticalPosition . ';
			' . $horizontalPosition . ';
		}
		#' . $settings['container'] . '.owl-carousel .owl-dots .owl-dot {
			display: inline-block;
			*display: inline;
		}
		#' . $settings['container'] . '.owl-carousel .owl-dots .owl-dot > div {
			height: ' . $dotsHeight . 'px;
			width: ' . $dotsWidth . 'px;
		}'
	);

	switch ($settings['navigation_orientation'])
	{
		case 'horizontal':
			$doc->addStyleDeclaration('
				#' . $settings['container'] . '.owl-carousel .owl-dots {
					width: ' . ((($dotsWidth + $dotsPadding * 2) * sizeof($images)) + (2 * (int) $settings['navigation_padding_horizontal'])) . 'px;
					height: ' . ((2 * (int) $settings['navigation_padding_vertical']) + $dotsHeight) . 'px;
				}
				#' . $settings['container'] . '.owl-carousel .owl-dots .owl-dot {
					display: inline-block;
					*display: inline;
					margin: 0 ' . $dotsPadding . 'px;
				}'
			);
			break;
		case 'vertical':
			$doc->addStyleDeclaration('
				#' . $settings['container'] . '.owl-carousel .owl-dots {
					height: ' . ((($dotsHeight + $dotsPadding) * sizeof($images)) - $dotsPadding + (2 * (int) $settings['navigation_padding_vertical'])) . 'px;
					width: ' . ((2 * (int) $settings['navigation_padding_horizontal']) + $dotsWidth) . 'px;
				}
				#' . $settings['container'] . '.owl-carousel .owl-dots .owl-dot {
					display: block;
				}
				#' . $settings['container'] . '.owl-carousel .owl-dots .owl-dot > div {
					margin: 0 0 ' . $dotsPadding . 'px 0;
				}
				#' . $settings['container'] . '.owl-carousel .owl-dots .owl-dot:first-child > div {
					margin-top: 0;
				}'
			);
			break;
	}

	// Slide numbers in navigation
	$doc->addStyleDeclaration('
		#' . $settings['container'] . '.owl-carousel .owl-dots .owl-dot span {
			opacity: ' . ($settings['navigation_shownumbers'] ? '1' : '0') . '
		}'
	);
}
else
{
	$settings['navigation_show'] = 'false';
}

// Navigation
if ($settings['navigation_buttons_show'] != '0')
{
	// Navigation is shown - always or just on hover (default by css).  Height adjustment
	$doc->addStyleDeclaration('
		#' . $settings['container'] . '.owl-carousel' . (($settings['navigation_buttons_show'] == '1') ? ':hover' : '') . ' .owl-nav {
			opacity: ' . (((int) $settings['navigation_buttons_opacity']) / 100) . ';
		}
		#' . $settings['container'] . '.owl-carousel .owl-nav {
			height: ' . max($buttonsNextHeight, $buttonsPrevHeight) . 'px;
		}
		#' . $settings['container'] . '.owl-carousel .owl-nav .owl-prev {
			width: ' . $buttonsPrevWidth . 'px;
			height: ' . $buttonsPrevHeight . 'px;
		}
		#' . $settings['container'] . '.owl-carousel .owl-nav .owl-next {
			width: ' . $buttonsNextWidth . 'px;
			height: ' . $buttonsNextHeight . 'px;
		}'
	);

	$settings['navigation_buttons_show'] = 'true';
}
else
{
	$settings['navigation_buttons_show'] = 'false';
}

// Loads theme css
if (($settings['navigation_show'] || $settings['navigation_buttons_show']) && $settings['navigation_theme'] != 'none')
{
	$themeCss = file_get_contents(JPATH_BASE . '/media/mod_jsshackslides/css/themes/' . $settings['navigation_theme'] . '.css');

	foreach ($settings as $key => $value)
	{
		$themeCss = str_replace('$$' . $key, '#' . $value, $themeCss);
	}

	$doc->addStyleDeclaration($themeCss);
}

// Loads slider Javascript
$sliderLoader = file_get_contents(JPATH_BASE . '/media/mod_jsshackslides/js/owl.load.js');

// Replaces all slider variables in loader
foreach ($settings as $key => $value)
{
	$sliderLoader = str_replace('$$' . $key, $value, $sliderLoader);
}

// Loads slider (Javascript)
$doc->addScriptDeclaration($sliderLoader);

require JModuleHelper::getLayoutPath('mod_jsshackslides');
