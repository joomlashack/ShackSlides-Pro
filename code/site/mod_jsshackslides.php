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

if (!class_exists('Browser'))
{
	require_once dirname(__FILE__) . '/includes/browser.php';
}

$doc = JFactory::getDocument();

$browser = new Browser;

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
	// Transition speed for text effects
	'slide_text_effect_masterspeed' => '500',
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
	'title_color' => 'FFFFFF',
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
	// Navigation theme shape
	'navigation_theme_shape' => 'round',
	// Navigation theme effect
	'navigation_effect_theme' => 'theme0',
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
	// Dots color
	'navigation_dots_color' => 'FFFFFF',
	// Active dots color
	'navigation_activedots_color' => '000000',
	// Dots numbers color
	'navigation_dots_numbers_color' => '777',
	// Opacity
	'navigation_opacity' => '50',
	// Custom nav dot
	'navigation_custom_dot' => '',
	// Custom hover nav dot
	'navigation_custom_dothover' => '',
	// Custom active nav dot
	'navigation_custom_dotactive' => '',
	// Show the navigation buttons always, never, on hover
	'navigation_buttons_show' => '2',
	// Buttons theme
	'buttons_theme' => 'theme2',
	// Buttons color
	'navigation_buttons_color' => '666666',
	// Buttons hover color
	'navigation_buttonshover_color' => 'FFFFFF',
	// Buttons opacity
	'navigation_buttons_opacity' => '70',
	// Custom previous button
	'navigation_buttons_custom_previous' => '',
	// Custom previous hover button
	'navigation_buttons_custom_previoushover' => '',
	// Custom next button
	'navigation_buttons_custom_next' => '',
	// Custom next hover button
	'navigation_buttons_custom_nexthover' => '',

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
			$doc->addScriptDeclaration('jQuery.noConflict();');
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

if (($browser->getBrowser() == Browser::BROWSER_IE && $browser->getVersion() < 11)
	|| $browser->getBrowser() == Browser::BROWSER_SAFARI)
{
	$description_Title_Patch = file_get_contents(JPATH_BASE . '/media/mod_jsshackslides/js/description_title_patch.js');

	// Replaces all slider variables to patch
	foreach ($settings as $key => $value)
	{
		$description_Title_Patch = str_replace('$$' . $key, $value, $description_Title_Patch);
	}

	// Loads patch (Javascript)
	$doc->addScriptDeclaration($description_Title_Patch);
}
else
{
	$doc->addStyleDeclaration('
		#' . $settings['container'] . '.jss-slider .owl-carousel .jss-title-description .jss-title,
		#' . $settings['container'] . '.jss-slider .owl-carousel .jss-title-description .jss-description {
				-webkit-flex-grow: 1;
				-moz-flex-grow: 1;
				-ms-flex-grow: 1;
				-o-flex-grow: 1;
				flex-grow: 1;
			}'
	);
}

// Default effect masterspeed = 1ms (CSS3 won't work with 0 to avoid the effect)
$effectMasterSpeed = '1';

// Sets the masterspeed for the selected effect
if ($settings['slide_effect'] != 'none')
{
	$effectMasterSpeed = $settings['slide_effect_masterspeed'];

	// If there is a slide effect, assigns the same speed value for the text effects.  Otherwise it uses default value for text
	$settings['slide_text_effect_masterspeed'] = $settings['slide_effect_masterspeed'];
}

$settings['slides_animation'] = $helper->convertAnimation($settings['slide_effect']);
$settings['slide_center'] = ($settings['slide_items'] == 1 ? 'true' : 'false');
$settings['slide_effect_masterspeed'] = $effectMasterSpeed;
$settings['slide_delay'] += $settings['slide_effect_masterspeed'];

$doc->addStyleDeclaration('
	#' . $settings['container'] . '.jss-slider .owl-carousel .owl-item,
	#' . $settings['container'] . '.jss-slider .owl-carousel .owl-item.animated {
			-webkit-animation-duration:' . $effectMasterSpeed . 'ms;
			animation-duration:' . $effectMasterSpeed . 'ms;
		}
	#' . $settings['container'] . '.jss-slider .owl-carousel .owl-item .jss-title > .animated,
	#' . $settings['container'] . '.jss-slider .owl-carousel .owl-item .jss-description > .animated {
			-webkit-animation-duration:' . $settings['slide_text_effect_masterspeed'] . 'ms;
			animation-duration:' . $settings['slide_text_effect_masterspeed'] . 'ms;
		}'
);

// Defined height in case of adjustment (to set a max height for the slider)
if ($settings['height_adjustment'] == 'adjust')
{
	$height = (int) $settings['height'];

	if ($height > 0)
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.jss-slider .owl-carousel .owl-item .jss-image {
				max-height: ' . $height . 'px;
			}'
		);
	}
}
elseif ($settings['height_adjustment'] == 'crop')
{
	$settings['slide_autoheight'] = 'false';
	$doc->addStyleDeclaration('
		#' . $settings['container'] . '.jss-slider .owl-carousel .owl-item .jss-image {
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
			'#' . $settings['container'] . '.jss-slider .owl-carousel .owl-item .jss-description > * {
				color: #' . $settings['description_color'] . ';
			}'
		);
	}

	// Description background
	if ($settings['description_bgcolor_flag'])
	{
		$color_hex = $settings['description_bgcolor'];
		$settings['description_bgcolor'] = implode(',', $helper->hexToRGB($settings['description_bgcolor']));
		$doc->addStyleDeclaration(
			'#' . $settings['container'] . '.jss-slider .owl-carousel .owl-item .jss-description {
				background-color: #' . $color_hex . ';
				background-color: rgba(' . $settings['description_bgcolor'] . ', ' . ($settings['description_bgcolor_opacity'] / 100) . ');
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
			#' . $settings['container'] . '.jss-slider .owl-carousel .owl-item .jss-description {
				width: ' . (int) $settings['description_width'] . 'px;
			}'
		);
	}

	// Description height
	if ($settings['title_description_position'] == 'top'
		|| $settings['title_description_position'] == 'bottom'
		|| $settings['title_description_position'] == 'above_outside'
		|| $settings['title_description_position'] == 'below_outside')
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.jss-slider .owl-carousel .owl-item .jss-description {
				height: ' . (int) $settings['description_height'] . 'px;
			}'
		);
	}

	// Left outside description
	if ($settings['title_description_position'] == 'left_outside')
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.jss-slider .owl-carousel .jss-image,
			#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-inner {
				padding-left: ' . (int) $settings['description_width'] . 'px;
			}'
		);
	}

	// Right outside title
	if ($settings['title_description_position'] == 'right_outside')
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.jss-slider .owl-carousel .jss-image,
			#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-inner {
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
			'#' . $settings['container'] . '.jss-slider .owl-carousel .owl-item .jss-title > * {
				color: #' . $settings['title_color'] . ';
			}'
		);
	}

	// Title background
	if ($settings['title_bgcolor_flag'])
	{
		$color_hex = $settings['title_bgcolor'];
		$settings['title_bgcolor'] = implode(',', $helper->hexToRGB($settings['title_bgcolor']));
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.jss-slider .owl-carousel .owl-item .jss-title {
				background-color: #' . $color_hex . ';
				background-color: rgba(' . $settings['title_bgcolor'] . ', ' . ($settings['title_bgcolor_opacity'] / 100) . ');
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
			#' . $settings['container'] . '.jss-slider .owl-carousel .jss-image .jss-title {
				width: ' . (int) $settings['title_width'] . 'px;
			}'
		);
	}

	// Title height
	if ($settings['title_description_position'] == 'top'
		|| $settings['title_description_position'] == 'bottom'
		|| $settings['title_description_position'] == 'above_outside'
		|| $settings['title_description_position'] == 'below_outside')
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.jss-slider .owl-carousel .jss-image .jss-title {
				height: ' . (int) $settings['title_height'] . 'px;
			}'
		);
	}

	// Left outside title
	if ($settings['title_description_position'] == 'left_outside')
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.jss-slider .owl-carousel .jss-image,
			#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-inner {
				padding-left: ' . (int) $settings['title_width'] . 'px;
			}'
		);
	}

	// Right outside title
	if ($settings['title_description_position'] == 'right_outside')
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.jss-slider .owl-carousel .jss-image,
			#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-inner {
				padding-right: ' . (int) $settings['title_width'] . 'px;
			}'
		);
	}
}

$settings['animation_script'] = '
	function jssInit_' . $settings['container'] . '(event) {
	}
	function jssInitEnd_' . $settings['container'] . '(event) {
	}
';
$settings['animation_events'] = '';

// Title and Description padding (shared setting)
if ($settings['description_show'] || $settings['title_show'])
{
	$doc->addStyleDeclaration('
		#' . $settings['container'] . '.jss-slider .owl-carousel .jss-image .jss-title-description .jss-title,
		#' . $settings['container'] . '.jss-slider .owl-carousel .jss-image .jss-title-description .jss-description,
		#' . $settings['container'] . '.jss-slider .owl-carousel .jss-image-container .jss-title-description .jss-title,
		#' . $settings['container'] . '.jss-slider .owl-carousel .jss-image-container .jss-title-description .jss-description{
			padding: ' . (int) $settings['title_description_padding_vertical'] . 'px ' . (int) $settings['title_description_padding_horizontal'] . 'px;
		}'
	);

	// Above/Below outside title/description
	if ($settings['title_description_position'] == 'above_outside'
		|| $settings['title_description_position'] == 'below_outside')
	{
		$paddingTitleDescription
						= ($settings['title_show'] ? (int) $settings['title_height'] : 0) + ($settings['description_show'] ? (int) $settings['description_height'] : 0);
		$paddingPositionTitleDescription = ($settings['title_description_position'] == 'above_outside' ? 'top' : 'bottom');

		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-inner {
				padding-' . $paddingPositionTitleDescription . ': ' . $paddingTitleDescription . 'px;
			}'
		);
	}

	// Text animation script - only if one slide per page is showing
	if ($settings['slide_items'] == 1 && ($settings['title_effect'] != 'none' || $settings['description_effect']))
	{
		$settings['slide_delay'] = (int) $settings['slide_delay'] + (
			$settings['title_effect'] != 'none'
				? (int) $settings['slide_text_effect_masterspeed']
				: 0
			) + ($settings['description_effect'] != 'none'
				? (int) $settings['slide_text_effect_masterspeed'] :
				0
			);

		$settings['animation_script'] = '
			function jssInit_' . $settings['container'] . '(event) {
				' . ($settings['title_effect'] != 'none' && substr($settings['title_effect'], 0, 10) != 'attention_'
						? 'jQuery("#' . $settings['container'] . ' .jss-title > *").css("opacity", "0");'
						: '') . '
				' . ($settings['description_effect'] != 'none' && substr($settings['description_effect'], 0, 10) != 'attention_'
						? 'jQuery("#' . $settings['container'] . ' .jss-description > *").css("opacity", "0");'
						: '') . '
			}
			function jssInitEnd_' . $settings['container'] . '(event) {
				jssAnimText(event.item.index);
			}
			function jssAnimTextExec(c, x, c2, x2) {
				if (c == undefined) { c = c2; x = x2; c2 = undefined; x2 = undefined; }
			    jQuery(c).addClass(x + " animated")
					.one(jQuery.support.animation.end, function(e) {
						jQuery(this).removeClass(x + " animated");
						jQuery(this).css("opacity", "1");
						if (c2 != undefined) jssAnimTextExec(c2, x2);
				});
			}
			function jssAnimText(i) {
				if (!jQuery.support.animation || !jQuery.support.transition) {
					return;
				}
				jssAnimTextExec(' . (($settings['title_effect'] != 'none') ?
						'"#' . $settings['container'] . ' .owl-item:eq(" + i + ") .jss-title > *","' . (substr($settings['title_effect'], 0, 10) == 'attention_'
								? substr($settings['title_effect'], 10)
								: $settings['title_effect']) . '"'
						: 'undefined,undefined') .
					',' . (($settings['description_effect'] != 'none') ?
						'"#' . $settings['container'] . ' .owl-item:eq(" + i + ") .jss-description > *","' .
							(substr($settings['description_effect'], 0, 10) == 'attention_'
									? substr($settings['description_effect'], 10)
									: $settings['description_effect']
								) . '"'
						: 'undefined,undefined') . ');
			}';
		$settings['animation_events'] = '
			var ' . $settings['container'] . '_anim = 0;
			' . $settings['container'] . '.on("translate.owl.carousel", function(event) {
				' . $settings['container'] . '_anim = 1;
			});
			' . $settings['container'] . '.on("translated.owl.carousel", function(event) {
				if (' . $settings['container'] . '_anim) {
					' . ($settings['title_effect'] != 'none' && substr($settings['title_effect'], 0, 10) != 'attention_'
							? 'jQuery("#' . $settings['container'] . ' .owl-item:not(:eq(" + event.item.index + ")) .jss-title > *").css("opacity", "0");'
							: '') . '
					' . ($settings['description_effect'] != 'none' && substr($settings['description_effect'], 0, 10) != 'attention_'
							? 'jQuery("#' . $settings['container'] . ' .owl-item:not(:eq(" + event.item.index + ")) .jss-description > *").css("opacity", "0");'
							: '') . '
					jssAnimText(event.item.index);
				}
				' . $settings['container'] . '_anim = 0;
			});';
	}
}

// Navigation
if ($settings['navigation_show'] != '0')
{
	if ($settings['navigation_show'] == '1')
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots {
				opacity: 0;
				-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
			}'
		);
	}

	// Navigation is shown - always or just on hover (default by css)
	$doc->addStyleDeclaration('
		#' . $settings['container'] . '.jss-slider' . (($settings['navigation_show'] == '1') ? ':hover' : '') . ' .jss-navigation .jss-navigation-dots {
			opacity: ' . (((int) $settings['navigation_opacity']) / 100) . ';
			-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=' . ((int) $settings['navigation_opacity']) . ')";
		}
		#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot > div > span {
			color: #' . $settings['navigation_dots_numbers_color'] . ';
		}'
	);

	$dotsWidth = 30;
	$dotsHeight = 30;

	if ($settings['navigation_custom_dot'] != '')
	{
		list($dotsWidth, $dotsHeight) = $helper->applyingCustomImages(
			$settings['navigation_custom_dot'],
			'#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot > div',
			$doc
		);
	}
	else
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot > div {
				width: ' . $dotsWidth . 'px;
				height: ' . $dotsHeight . 'px;
			}'
		);
	}

	if ($settings['navigation_custom_dothover'] != '')
	{
		$helper->applyingCustomImages(
			$settings['navigation_custom_dothover'],
			'#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot > div:hover',
			$doc
		);
		$helper->applyingCustomImages(
			$settings['navigation_custom_dothover'],
			'#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot.active > div:hover',
			$doc
		);
	}

	if ($settings['navigation_custom_dotactive'] != '')
	{
		$helper->applyingCustomImages(
			$settings['navigation_custom_dotactive'],
			'#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot.active > div',
			$doc
		);
	}

	$settings['navigation_show'] = 'true';
	$verticalPosition = '';
	$horizontalPosition = '';
	$dotsPadding = 5;

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
		#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots {
			padding: ' . (int) $settings['navigation_padding_vertical'] . 'px ' . (int) $settings['navigation_padding_horizontal'] . 'px;
			' . $verticalPosition . ';
			' . $horizontalPosition . ';
		}
		#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot {
			display: inline-block;
			*display: inline;
		}'
	);

	switch ($settings['navigation_orientation'])
	{
		case 'horizontal':
			$doc->addStyleDeclaration('
				#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots {
					width: ' . ((($dotsWidth + $dotsPadding * 2) * sizeof($images)) + (2 * (int) $settings['navigation_padding_horizontal'])) . 'px;
					height: ' . ((2 * (int) $settings['navigation_padding_vertical']) + $dotsHeight) . 'px;
				}
				#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot {
					display: inline-block;
					*display: inline;
					margin: 0 ' . $dotsPadding . 'px;
				}'
			);
			break;
		case 'vertical':
			$doc->addStyleDeclaration('
				#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots {
					height: ' . ((($dotsHeight + $dotsPadding) * sizeof($images)) - $dotsPadding + (2 * (int) $settings['navigation_padding_vertical'])) . 'px;
					width: ' . ((2 * (int) $settings['navigation_padding_horizontal']) + $dotsWidth) . 'px;
				}
				#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot {
					display: block;
				}
				#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot > div {
					margin: 0 0 ' . $dotsPadding . 'px 0;
				}
				#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot:first-child > div {
					margin-top: 0;
				}'
			);
			break;
	}

	// Slide numbers in navigation
	$doc->addStyleDeclaration('
		#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot span {
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
	$buttonsPrevHeight = 40;
	$buttonsPrevWidth = 40;
	$buttonsNextHeight = 40;
	$buttonsNextWidth = 40;

	if ($settings['navigation_buttons_custom_previous'] != '')
	{
		list($buttonsPrevWidth,$buttonsPrevHeight) = $helper->applyingCustomImages(
			$settings['navigation_buttons_custom_previous'],
			'#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons .owl-prev',
			$doc
		);
	}
	else
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons .owl-prev {
				width: ' . $buttonsPrevWidth . 'px;
				height: ' . $buttonsPrevHeight . 'px;
			}'
		);
	}

	if ($settings['navigation_buttons_custom_previoushover'] != '')
	{
		$helper->applyingCustomImages(
			$settings['navigation_buttons_custom_previoushover'],
			'#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons .owl-prev:hover',
			$doc
		);
	}

	if ($settings['navigation_buttons_custom_next'] != '')
	{
		list($buttonsNextWidth, $buttonsNextHeight) = $helper->applyingCustomImages(
			$settings['navigation_buttons_custom_next'],
			'#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons .owl-next',
			$doc
		);
	}
	else
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons .owl-next {
				width: ' . $buttonsNextWidth . 'px;
				height: ' . $buttonsNextHeight . 'px;
			}'
		);
	}

	if ($settings['navigation_buttons_custom_nexthover'] != '')
	{
		$helper->applyingCustomImages(
			$settings['navigation_buttons_custom_nexthover'],
			'#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons .owl-next:hover',
			$doc
		);
	}

	if ($settings['navigation_buttons_show'] == '1')
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons [class*=\'owl-\'] {
				opacity: 0;
				-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
			}'
		);
	}

	// Navigation is shown - always or just on hover (default by css).  Height adjustment
	$doc->addStyleDeclaration('
		#' . $settings['container'] . '.jss-slider' . (($settings['navigation_buttons_show'] == '1') ? ':hover' : '') .
			' .jss-navigation .jss-navigation-buttons [class*=\'owl-\'] {
			opacity: ' . (((int) $settings['navigation_buttons_opacity']) / 100) . ';
			-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=' . ((int) $settings['navigation_buttons_opacity']) . ')";
		}
		#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons [class*=\'owl-\']{
			border-color: #' . $settings['navigation_buttons_color'] . ';
		}
		#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons [class*=\'owl-\']:hover{
			border-color: #' . $settings['navigation_buttonshover_color'] . ';
		}
		#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons {
			height: 0px;
		}
		#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons .owl-prev {
			width: ' . $buttonsPrevWidth . 'px;
			height: ' . $buttonsPrevHeight . 'px;
		}
		#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons .owl-next {
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
if ($settings['navigation_show'] || $settings['navigation_buttons_show'])
{
	$themeCss = '';

	if ($settings['navigation_theme_shape'] != 'none')
	{
		$themeCss .= file_get_contents(JPATH_BASE . '/media/mod_jsshackslides/css/shape/' . $settings['navigation_theme_shape'] . '.css');
		$themeCss .= '
				#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot > div {
					background-color: #' . $settings['navigation_dots_color'] . ';
					}';
	}

	if ($settings['buttons_theme'] != 'none')
	{
		$themeCss .= file_get_contents(JPATH_BASE . '/media/mod_jsshackslides/css/theme_buttons/' . $settings['buttons_theme'] . '.css');
	}

	if ($settings['navigation_effect_theme'] != 'none')
	{
		$themeCss .= file_get_contents(
			JPATH_BASE . '/media/mod_jsshackslides/css/effects_theme_navigation/' . $settings['navigation_effect_theme'] . '.css'
		);
	}

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

// Text animations script.  It must load first because of the init script for text effects
if ($settings['animation_script'] != '')
{
	$doc->addScriptDeclaration($settings['animation_script']);
}

// Loads slider (Javascript)
$doc->addScriptDeclaration($sliderLoader);

require JModuleHelper::getLayoutPath('mod_jsshackslides');
