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
	// Title background color flag
	'title_bgcolor_flag' => '1',
	// Title background color
	'title_bgcolor' => '#000000',
	// Title background opacity
	'title_bgcolor_opacity' => '70',
	// Title effect
	'title_effect' => 'none',
	// Title tag
	'title_tag' => 'p',
	// Show description flag
	'description_show' => '1',
	// Description width
	'description_width' => '300',
	// Description height
	'description_height' => '100',
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
	// id for the slider container
	'container' => '',
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
	// Description background
	if ($settings['description_bgcolor_flag'])
	{
		$doc->addStyleDeclaration(
			'#' . $settings['container'] . '.owl-carousel .owl-item .jss-description:before {
				background-color: #' . $settings['description_bgcolor'] . ';
				opacity: ' . ((float) $settings['description_bgcolor_opacity'] / 100) . ';
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
	// Title background
	if ($settings['title_bgcolor_flag'])
	{
		$doc->addStyleDeclaration('
			#' . $settings['container'] . '.owl-carousel .owl-item .jss-title:before {
				background-color: #' . $settings['title_bgcolor'] . ';
				opacity: ' . ((float) $settings['title_bgcolor_opacity'] / 100) . ';
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


// Loads slider Javascript
$sliderLoader = file_get_contents(JPATH_BASE . '/media/mod_jsshackslides/js/owl.load.js');

// Replaces all slider variables in loader
foreach ($settings as $key => $value)
{
	$sliderLoader = str_replace('$$' . $key, $value, $sliderLoader);
}

// Loads slider (Javascript)
$doc->addScriptDeclaration($sliderLoader);

?>
<div id="<?php echo $settings['container'] ?>" class="owl-carousel owl-theme">
<?php
	foreach ($images as $i => $image)
		:
?>
	<div class="jss-image-container jss-descpos-<?php echo $settings['title_description_position'] ?>">
		<?php
			if ($settings['title_description_position'] == 'above_outside')
			{
				require JModuleHelper::getLayoutPath('mod_jsshackslides', 'description');
			}
		?>
		<div class="jss-image">
			<?php
				if ($settings['height_adjustment'] == 'adjust')
					:
			?>
			<img src="<?php echo $base . $image ?>" alt="<?php echo empty($titles[$i]) ? $image : $titles[$i]; ?>" />
			<?php
				elseif ($settings['height_adjustment'] == 'crop')
					:
			?>
			<div class="jss-image-int" style="background-image: url('<?php echo  $base . $image ?>'">
			</div>
			<?php
				endif;
			?>
			<?php
				if ($settings['title_description_position'] != 'above_outside' && $settings['title_description_position'] != 'below_outside')
				{
					require JModuleHelper::getLayoutPath('mod_jsshackslides', 'description');
				}
			?>
		</div>
		<?php
			if ($settings['title_description_position'] == 'below_outside')
			{
				require JModuleHelper::getLayoutPath('mod_jsshackslides', 'description');
			}
		?>
	</div>
<?php
	endforeach;
?>
</div>
