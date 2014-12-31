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

if (!$images)
{
	// If there are no images set, there is nothing to be shown
	return;
}

$doc = JFactory::getDocument();

// This can be used in an override to change default settings. User can override settings in the module settings page as well.
$defaults = array(
	// BASIC CONFIGURATION OPTIONS
	// Container height
	'height' => '250',
	// Transition delay
	'slide_delay' => '5000',
	// Show descriptions
	'description' => 'yes',
	// Transition speed
	'slide_effect_masterspeed' => '300',
	// Effect for slides
	'slide_effect' => 'rotateoverlap',
	// Stop on mouse hover
	'slide_onhoverstop' => '0',
	// Number of items per slide page
	'slide_items' => '1',
	// Autoplay on or off
	'slide_autoplay' => '1',

	// DESCRIPTION OPTIONS
	'slidedescription_position' => '0',
	'slidedescription_alignment' => 'left',
	'effect_title' => 'zmf',
	'title_color' => '',
	'title_background_color' => 'enabletitlebg',
	'title_bgpicker_color' => '',
	'effect_text' => 'clipleftright',

	// NAVIGATION OPTIONS
	'navigation' => 'true',
	'showdots' => '2',
	'orientationdots' => '1',
	'horizontalaligndots' => 'center',
	'verticalaligndots' => 'bottom',
	'horizontalpaddingdots' => '0',
	'verticalpaddingdots' => '0',
	'rangesliderdots' => '100',
	'navigationarrows_customdots' => 'n03',
	'navigationdots_media' => '',
	'navigationarrows' => '2',
	'rangesliderrows' => '100',
	'navigationarrows_customrows' => 'd17',
	'navigationarrows_media' => '',

	// ADVANCED OPTIONS
	// id for the container slider
	'container' => 'slider',
	'main_container_class' => '',
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
		$doc = JFactory::getDocument();

		if ($params->get('includejquery', $defaults['includejquery']) == 'on')
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
JHtml::stylesheet('mod_jsshackslides/animate.css', array(), true);
JHtml::script('mod_jsshackslides/owl.carousel.min.js', false, true);

$sliderLoader = file_get_contents(JPATH_BASE . '/media/mod_jsshackslides/js/owl.load.js');

// Replaces all slider variables in loader
foreach ($settings as $key => $value)
{
	$sliderLoader = str_replace('$$' . $key, $value, $sliderLoader);
}

$doc->addScriptDeclaration($sliderLoader);
?>
<div class="owl-carousel owl-theme">
<?php
	foreach ($images as $i => $image)
		:
?>
	<div class="jss-image">
		<img class="owl-lazy" data-src="<?php echo $base . $image ?>" alt="<?php echo $titles[$i] ?>" />
	</div>
<?php
	endforeach;
?>
</div>
