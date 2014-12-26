<?php
/**
 * @version   1.x
 * @package   ShackSlides
 * @copyright (C) 2010 Joomlashack / Meritage Assets Corp
 * @license   GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die('Direct access to files is not permitted');

// This can be used in an override to change default settings. User can override
// settings in the module settings page still.
$defaults = array(

	//BASIC CONFIGURATION OPTIONS
	'width' => '500', // width of container
	'height' => '250', // height of container
	'slide_delay' => '5000', // dalay of the transitions
	'description' => 'yes', // displays image discription box
	'effect_masterspeed' => '300',
	'effect_slide' => 'rotateoverlap',
	'onhover_stop' => '0', // on hover stop on/off,
	'center_container_automatic' => 'centerautoenable',

	//DESCRIPTION OPTIONS
	'slidedescription_position' => '0',
	'slidedescription_alignment' => 'left',
	'effect_title' => 'zmf',
	'title_color' => '',
	'title_background_color' => 'enabletitlebg',
	'title_bgpicker_color' => '',
	'titleposition' => 'top_left_title',
	'position_title_x' => '85',
	'position_title_y' => '85',
	'width_text' => '200',
	'height_text' => '200',
	'effect_text' => 'clipleftright',
	'descriptionposition2' => 'notshowdescbottom',
	'descriptionposition3' => 'notshowdescbottom',

	//NAVIGATION OPTIONS
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

	//ADVANCED OPTIONS
	'container' => 'slider', // id for the slider container,
	'main_container_class' => '',
	'includejquery' => 'off',
	'includejqueryui' => 'on',

	'description_height' => '50', // description height if position is top/bottom
	'description_width' => '50', // description width if position is right/left
	'style_def_text' => 'notextstyle',
	'descriptionposition' => 'top_in',
	'position_text_x' => '85',
	'position_text_y' => '150',

	'description_background' => 'ffffff', // description background color hex code
);

// Adding the javascript and css files to the document
$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::base() .'modules/mod_jsshackslides/assets/slider/css/settings.css');

ob_start();
include(JPATH_ROOT.'/modules/mod_jsshackslides/assets/slider/css/style.php');

$styles = ob_get_contents();
ob_end_clean();

$doc->addStyleDeclaration($styles);

// ################### Styles for bullets, arrows and loading #####################
include(JPATH_ROOT.'/modules/mod_jsshackslides/assets/slider/css/navigationstyles.php');
$doc->addStyleDeclaration($style);
// ################### Styles for bullets, arrows and loading #####################

// ################### Styles for description and title #####################
include(JPATH_ROOT.'/modules/mod_jsshackslides/assets/slider/css/description_title_positions.php');
$doc->addStyleDeclaration($style);
// ################### Styles for description and title #####################

// load jQuery, if not loaded before
//checking if installed joomla version is less  3.0
if (version_compare( JVERSION, '3.2', '<' ) == 1) {
	 // do something for joomla version less than 3.0
	if(!JFactory::getApplication()->get('jquery')){
		JFactory::getApplication()->set('jquery',true);
		$doc = JFactory::getDocument();
		if ($params->get('includejquery', $defaults['includejquery']) == 'on') :
			$doc->addScript("modules/mod_jsshackslides/assets/slider/jquery-1.11.2.min.js");
			$doc->addScript(JURI::base() . 'modules/mod_jsshackslides/assets/slider/jquerynoconflict.js');
		endif;
		if ($params->get('includejqueryui', $defaults['includejqueryui']) == 'on') :
			$doc->addScript("https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js");
			$doc->addStyleSheet('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css');
		endif;
	}
 }
 else
 {
	 //do something for j3.2 or more
 	if ($params->get('includejquery', $defaults['includejquery']) == 'on') :
		JHTML::_('jquery.framework');
	endif;
	if ($params->get('includejqueryui', $defaults['includejqueryui']) == 'on') :
		JHtml::_('jquery.ui');
	endif;
 }

	$doc->addScript(JURI::base() . 'modules/mod_jsshackslides/assets/slider/jssor.js');
	$doc->addScript(JURI::base() . 'modules/mod_jsshackslides/assets/slider/jssor.slider.js');
?>

<script>
	jQuery(document).ready(function ($) {
		//START EFFECTS OF SLIDE WHEN ITS IN AUTOPLAY
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'None') :?>
		var _SlideshowTransitions = [
		//["None"]
			{$Duration: 0, $Zoom: 0, $Rotate: 0, $Easing: { $Zoom: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Round: { $Rotate: 0}, $Brother: { $Duration: 0, $Zoom: 0, $Rotate: 0, $Easing: $JssorEasing$.$EaseSwing, $Opacity: 0, $Round: { $Rotate: 0 }, $Shift: 0} }
		];
		<?php endif ?>
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'rotateoverlap') :?>
		var _SlideshowTransitions = [
		//["Rotate Overlap"]
			{$Duration: 1200, $Zoom: 11, $Rotate: -1, $Easing: { $Zoom: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Round: { $Rotate: 0.5 }, $Brother: { $Duration: 1200, $Zoom: 1, $Rotate: 1, $Easing: $JssorEasing$.$EaseSwing, $Opacity: 2, $Round: { $Rotate: 0.5 }, $Shift: 90} }
		];
		<?php endif ?>
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'switch') :?>
		var _SlideshowTransitions = [
		//["Switch"]
			{ $Duration: 1400, $Zoom: 1.5, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseInWave, $Zoom: $JssorEasing$.$EaseInSine }, $ScaleHorizontal: 0.25, $Opacity: 2, $ZIndex: -10, $Brother: { $Duration: 1400, $Zoom: 1.5, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInWave, $Zoom: $JssorEasing$.$EaseInSine }, $ScaleHorizontal: 0.25, $Opacity: 2, $ZIndex: -10} }
		];
		<?php endif ?>
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'Rotate_Relay') :?>
		var _SlideshowTransitions = [
		//["Rotate Relay"]
			{ $Duration: 1200, $Zoom: 11, $Rotate: 1, $Easing: { $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Round: { $Rotate: 1 }, $ZIndex: -10, $Brother: { $Duration: 1200, $Zoom: 11, $Rotate: -1, $Easing: { $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Round: { $Rotate: 1 }, $ZIndex: -10, $Shift: 600} }
		];
		<?php endif ?>
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'doors') :?>
		var _SlideshowTransitions = [
		//["Doors"]
			{ $Duration: 1500, $Cols: 2, $FlyDirection: 1, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInOutCubic }, $ScaleHorizontal: 0.5, $Opacity: 2, $Brother: { $Duration: 1500, $Opacity: 2} }
		];
		<?php endif ?>
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'Rotate-in+-out-') :?>
		var _SlideshowTransitions = [
		//["Rotate in+ out-"]
			{ $Duration: 1500, $Zoom: 1, $Rotate: 0.1, $During: { $Left: [0.6, 0.4], $Top: [0.6, 0.4], $Rotate: [0.6, 0.4], $Zoom: [0.6, 0.4] }, $FlyDirection: 6, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Top: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.5, $Opacity: 2, $Brother: { $Duration: 1000, $Zoom: 11, $Rotate: -0.5, $Easing: { $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Shift: 200} }
		];
		<?php endif ?>
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'Fly-Twins') :?>
		var _SlideshowTransitions = [
		//["Fly Twins"]
			{ $Duration: 1500, $During: { $Left: [0.6, 0.4] }, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2, $Outside: true, $Brother: { $Duration: 1000, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2} }
		];
		<?php endif ?>
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'Rotatein-out+') :?>
		var _SlideshowTransitions = [
		//["Rotate in- out+"]
			{ $Duration: 1500, $Zoom: 11, $Rotate: 0.5, $During: { $Left: [0.4, 0.6], $Top: [0.4, 0.6], $Rotate: [0.4, 0.6], $Zoom: [0.4, 0.6] }, $Easing: { $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.5, $Opacity: 2, $Brother: { $Duration: 1000, $Zoom: 1, $Rotate: -0.5, $Easing: { $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Shift: 200} }
		];
		<?php endif ?>
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'Rotate_Axis_up_overlap') :?>
		var _SlideshowTransitions = [
		//["Rotate Axis up overlap"]
			{ $Duration: 1200, $Rotate: -0.1, $FlyDirection: 5, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Top: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $ScaleHorizontal: 0.25, $ScaleVertical: 0.5, $Opacity: 2, $Brother: { $Duration: 1200, $Rotate: 0.1, $FlyDirection: 10, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Top: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $ScaleHorizontal: 0.1, $ScaleVertical: 0.7, $Opacity: 2} }
		];
		<?php endif ?>
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'Chess_Replace_TB') :?>
		var _SlideshowTransitions = [
		//["Chess Replace TB"]
			{ $Duration: 1600, $Rows: 2, $FlyDirection: 1, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Brother: { $Duration: 1600, $Rows: 2, $FlyDirection: 2, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2} }
		];
		<?php endif ?>
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'Chess_Replace_LR') :?>
		var _SlideshowTransitions = [
		//["Chess Replace LR"]
			{ $Duration: 1600, $Cols: 2, $FlyDirection: 8, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Brother: { $Duration: 1600, $Cols: 2, $FlyDirection: 4, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2} }
		];
		<?php endif ?>
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'Shift_TB') :?>
		var _SlideshowTransitions = [
		//["Shift TB"]
			{ $Duration: 1200, $FlyDirection: 4, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Brother: { $Duration: 1200, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2} }
		];
		<?php endif ?>
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'Shift_LR') :?>
		var _SlideshowTransitions = [
		//["Shift LR"]
			{ $Duration: 1200, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Brother: { $Duration: 1200, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2} }
		];
		<?php endif ?>
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'Return_TB') :?>
		var _SlideshowTransitions = [
		//["Return TB"]
			{ $Duration: 1200, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $ZIndex: -10, $Brother: { $Duration: 1200, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $ZIndex: -10, $Shift: -100} }
		];
		<?php endif ?>
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'Return_LR') :?>
		var _SlideshowTransitions = [
		//["Return LR"]
			{ $Duration: 1200, $Delay: 40, $Cols: 6, $FlyDirection: 1, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Easing: { $Left: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $ZIndex: -10, $Brother: { $Duration: 1200, $Delay: 40, $Cols: 6, $FlyDirection: 1, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Easing: { $Top: $JssorEasing$.$EaseInOutQuart, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $ZIndex: -10, $Shift: -100} }
		];
		<?php endif ?>
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'Rotate_Axis_down') :?>
		var _SlideshowTransitions = [
		//["Rotate Axis down"]
			{ $Duration: 1500, $Rotate: 0.1, $During: { $Left: [0.6, 0.4], $Top: [0.6, 0.4], $Rotate: [0.6, 0.4] }, $FlyDirection: 10, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Top: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $ScaleHorizontal: 0.1, $ScaleVertical: 0.7, $Opacity: 2, $Brother: { $Duration: 1000, $Rotate: -0.1, $FlyDirection: 5, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Top: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $ScaleHorizontal: 0.2, $ScaleVertical: 0.5, $Opacity: 2} }
		];
		<?php endif ?>
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'Extrude_Replace') :?>
		var _SlideshowTransitions = [
		//["Extrude Replace"]
			{ $Duration: 1600, $Delay: 40, $Cols: 12, $During: { $Left: [0.4, 0.6] }, $SlideOut: true, $FlyDirection: 2, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseInOutExpo, $Opacity: $JssorEasing$.$EaseInOutQuad }, $ScaleHorizontal: 0.2, $Opacity: 2, $Outside: true, $Round: { $Top: 0.5 }, $Brother: { $Duration: 1000, $Delay: 40, $Cols: 12, $FlyDirection: 1, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Assembly: 1028, $Easing: { $Left: $JssorEasing$.$EaseInOutExpo, $Opacity: $JssorEasing$.$EaseInOutQuad }, $ScaleHorizontal: 0.2, $Opacity: 2, $Round: { $Top: 0.5}} }
		];
		<?php endif ?>
		<?php if ($params->get('effect_slide', $defaults['effect_slide']) == 'Fade') :?>
		var _SlideshowTransitions = [
		//["fade"]
			{ $Duration: 1600, $Zoom: 1.5, $FlyDirection: 0, $Easing: { $Left: $JssorEasing$.$EaseInWave, $Zoom: $JssorEasing$.$EaseInSine }, $ScaleHorizontal: 0.25, $Opacity: 2, $ZIndex: -10, $Brother: { $Duration: 1600, $Zoom: 1.5, $FlyDirection: 0, $Easing: { $Left: $JssorEasing$.$EaseInWave, $Zoom: $JssorEasing$.$EaseInSine }, $ScaleHorizontal: 0.25, $Opacity: 2, $ZIndex: -10} }
		];
		<?php endif ?>
		//ENDS EFFECTS OF SLIDE WHEN ITS IN AUTOPLAY

//**********************************************************************************************************************************************************

		var _CaptionTransitions = [
		//CLIP|LR
		{$Duration: 900, $Clip: 3, $Easing: $JssorEasing$.$EaseInOutCubic },
		//CLIP|TB
		{$Duration: 900, $Clip: 12, $Easing: $JssorEasing$.$EaseInOutCubic },

		//DDGDANCE|LB
		{$Duration: 1800, $Zoom: 1, $FlyDirection: 9, $Easing: { $Left: $JssorEasing$.$EaseInJump, $Top: $JssorEasing$.$EaseInJump, $Zoom: $JssorEasing$.$EaseOutQuad }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Opacity: 2, $During: { $Left: [0, 0.8], $Top: [0, 0.8] }, $Round: { $Left: 0.8, $Top: 2.5} },
		//DDGDANCE|RB
		{$Duration: 1800, $Zoom: 1, $FlyDirection: 10, $Easing: { $Left: $JssorEasing$.$EaseInJump, $Top: $JssorEasing$.$EaseInJump, $Zoom: $JssorEasing$.$EaseOutQuad }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Opacity: 2, $During: { $Left: [0, 0.8], $Top: [0, 0.8] }, $Round: { $Left: 0.8, $Top: 2.5} },

		//TORTUOUS|HL
		{$Duration: 1500, $Zoom: 1, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseOutWave, $Zoom: $JssorEasing$.$EaseOutCubic }, $ScaleHorizontal: 0.2, $Opacity: 2, $During: { $Left: [0, 0.7] }, $Round: { $Left: 1.3} },
		//TORTUOUS|VB
		{$Duration: 1500, $Zoom: 1, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseOutWave, $Zoom: $JssorEasing$.$EaseOutCubic }, $ScaleVertical: 0.2, $Opacity: 2, $During: { $Top: [0, 0.7] }, $Round: { $Top: 1.3} },

		//ZMF|10
		{$Duration: 600, $Zoom: 11, $Easing: { $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 },

		//ZML|R
		{$Duration: 600, $Zoom: 11, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.6, $Opacity: 2 },
		//ZML|B
		{$Duration: 600, $Zoom: 11, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleVertical: 0.6, $Opacity: 2 },

		//ZMS|B
		{$Duration: 700, $Zoom: 1, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleVertical: 0.6, $Opacity: 2 },

		//ZM*JDN|LB
		{$Duration: 1200, $Zoom: 11, $FlyDirection: 9, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseOutCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.8, $ScaleVertical: 0.5, $Opacity: 2, $During: { $Top: [0, 0.5]} },
		//ZM*JUP|LB

		{$Duration: 1200, $Zoom: 11, $FlyDirection: 9, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.8, $ScaleVertical: 0.5, $Opacity: 2, $During: { $Top: [0, 0.5]} },
		//ZM*JUP|RB
		{$Duration: 1200, $Zoom: 11, $FlyDirection: 10, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.8, $ScaleVertical: 0.5, $Opacity: 2, $During: { $Top: [0, 0.5]} },

		//ZM*WVR|LT
		{$Duration: 1200, $Zoom: 11, $FlyDirection: 5, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseInWave }, $ScaleHorizontal: 0.5, $ScaleVertical: 0.3, $Opacity: 2, $Round: { $Rotate: 0.8} },
		//ZM*WVR|RT
		{$Duration: 1200, $Zoom: 11, $FlyDirection: 6, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseInWave }, $ScaleHorizontal: 0.5, $ScaleVertical: 0.3, $Opacity: 2, $Round: { $Rotate: 0.8} },
		//ZM*WVR|TL
		{$Duration: 1200, $Zoom: 11, $FlyDirection: 5, $Easing: { $Left: $JssorEasing$.$EaseInWave, $Top: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.5, $Opacity: 2, $Round: { $Rotate: 0.8} },
		//ZM*WVR|BL
		{$Duration: 1200, $Zoom: 11, $FlyDirection: 9, $Easing: { $Left: $JssorEasing$.$EaseInWave, $Top: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.5, $Opacity: 2, $Round: { $Rotate: 0.8} },

		//RTT|10
		{$Duration: 700, $Zoom: 11, $Rotate: 1, $Easing: { $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.8} },

		//RTTL|R
		{$Duration: 700, $Zoom: 11, $Rotate: 1, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.6, $Opacity: 2, $Round: { $Rotate: 0.8} },
		//RTTL|B
		{$Duration: 700, $Zoom: 11, $Rotate: 1, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInCubic }, $ScaleVertical: 0.6, $Opacity: 2, $Round: { $Rotate: 0.8} },

		//RTTS|R
		{$Duration: 700, $Zoom: 1, $Rotate: 1, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Zoom: $JssorEasing$.$EaseInQuad, $Rotate: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseOutQuad }, $ScaleHorizontal: 0.6, $Opacity: 2, $Round: { $Rotate: 1.2} },
		//RTTS|B
		{$Duration: 700, $Zoom: 1, $Rotate: 1, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInQuad, $Zoom: $JssorEasing$.$EaseInQuad, $Rotate: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseOutQuad }, $ScaleVertical: 0.6, $Opacity: 2, $Round: { $Rotate: 1.2} },

		//RTT*JDN|RT
		{$Duration: 1000, $Zoom: 11, $Rotate: .2, $FlyDirection: 6, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseOutCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.8, $ScaleVertical: 0.5, $Opacity: 2, $During: { $Top: [0, 0.5]} },
		//RTT*JDN|LB
		{$Duration: 1000, $Zoom: 11, $Rotate: .2, $FlyDirection: 9, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseOutCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.8, $ScaleVertical: 0.5, $Opacity: 2, $During: { $Top: [0, 0.5]} },
		//RTT*JUP|RB
		{$Duration: 1000, $Zoom: 11, $Rotate: .2, $FlyDirection: 10, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.8, $ScaleVertical: 0.5, $Opacity: 2, $During: { $Top: [0, 0.5]} },
		{ $Duration: 1200, $Zoom: 11, $Rotate: true, $FlyDirection: 6, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseLinear, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.5, $ScaleVertical: 0.8, $Opacity: 2, $During: { $Left: [0, 0.5] }, $Round: { $Rotate: 0.5} },
		//RTT*JUP|BR
		{$Duration: 1000, $Zoom: 11, $Rotate: .2, $FlyDirection: 10, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseLinear, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.5, $ScaleVertical: 0.8, $Opacity: 2, $During: { $Left: [0, 0.5]} },

		//R|IB
		{$Duration: 900, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInOutBack }, $ScaleHorizontal: 0.6, $Opacity: 2 },
		//B|IB
		{$Duration: 900, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInOutBack }, $ScaleVertical: 0.6, $Opacity: 2 },
		];


		//CLIP|LR
		_CaptionTransitions["clipleftright"] = {$Duration: 900, $Clip: 3, $Easing: $JssorEasing$.$EaseInOutCubic };
		//CLIP|TB
		_CaptionTransitions["cliptb"] = {$Duration: 900, $Clip: 12, $Easing: $JssorEasing$.$EaseInOutCubic };

		//DDGDANCE|LB
		_CaptionTransitions["dancelb"] = {$Duration: 1800, $Zoom: 1, $FlyDirection: 9, $Easing: { $Left: $JssorEasing$.$EaseInJump, $Top: $JssorEasing$.$EaseInJump, $Zoom: $JssorEasing$.$EaseOutQuad }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Opacity: 2, $During: { $Left: [0, 0.8], $Top: [0, 0.8] }, $Round: { $Left: 0.8, $Top: 2.5} };
		//DDGDANCE|RB
		_CaptionTransitions["dancerb"] = {$Duration: 1800, $Zoom: 1, $FlyDirection: 10, $Easing: { $Left: $JssorEasing$.$EaseInJump, $Top: $JssorEasing$.$EaseInJump, $Zoom: $JssorEasing$.$EaseOutQuad }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Opacity: 2, $During: { $Left: [0, 0.8], $Top: [0, 0.8] }, $Round: { $Left: 0.8, $Top: 2.5} };

		//TORTUOUS|HL
		_CaptionTransitions["tortuoushl"] = {$Duration: 1500, $Zoom: 1, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseOutWave, $Zoom: $JssorEasing$.$EaseOutCubic }, $ScaleHorizontal: 0.2, $Opacity: 2, $During: { $Left: [0, 0.7] }, $Round: { $Left: 1.3} };
		//TORTUOUS|VB
		_CaptionTransitions["tortousvb"] = {$Duration: 1500, $Zoom: 1, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseOutWave, $Zoom: $JssorEasing$.$EaseOutCubic }, $ScaleVertical: 0.2, $Opacity: 2, $During: { $Top: [0, 0.7] }, $Round: { $Top: 1.3} };

		//ZMF|10
		_CaptionTransitions["zmf"] = {$Duration: 600, $Zoom: 11, $Easing: { $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 };

		//ZML|R
		_CaptionTransitions["zmlr"] = {$Duration: 600, $Zoom: 11, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.6, $Opacity: 2 };
		//ZML|B
		_CaptionTransitions["zmlb"] = {$Duration: 600, $Zoom: 11, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleVertical: 0.6, $Opacity: 2 };

		//ZMS|B
		_CaptionTransitions["zmsb"] = {$Duration: 700, $Zoom: 1, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleVertical: 0.6, $Opacity: 2 };

		//ZM*JDN|LB
		_CaptionTransitions["zmjdnlb"] = {$Duration: 1200, $Zoom: 11, $FlyDirection: 9, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseOutCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.8, $ScaleVertical: 0.5, $Opacity: 2, $During: { $Top: [0, 0.5]} };
		//ZM*JUP|LB
		_CaptionTransitions["zmjuplb"] = {$Duration: 1200, $Zoom: 11, $FlyDirection: 9, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.8, $ScaleVertical: 0.5, $Opacity: 2, $During: { $Top: [0, 0.5]} };
		//ZM*JUP|RB
		_CaptionTransitions["zmjuprb"] = {$Duration: 1200, $Zoom: 11, $FlyDirection: 10, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.8, $ScaleVertical: 0.5, $Opacity: 2, $During: { $Top: [0, 0.5]} };

		//ZM*WVR|LT
		_CaptionTransitions["zmwvrlt"] = {$Duration: 1200, $Zoom: 11, $FlyDirection: 5, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseInWave }, $ScaleHorizontal: 0.5, $ScaleVertical: 0.3, $Opacity: 2, $Round: { $Rotate: 0.8} };
		//ZM*WVR|RT
		_CaptionTransitions["zmwvrrt"] = {$Duration: 1200, $Zoom: 11, $FlyDirection: 6, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseInWave }, $ScaleHorizontal: 0.5, $ScaleVertical: 0.3, $Opacity: 2, $Round: { $Rotate: 0.8} };
		//ZM*WVR|TL
		_CaptionTransitions["zmwvrtl"] = {$Duration: 1200, $Zoom: 11, $FlyDirection: 5, $Easing: { $Left: $JssorEasing$.$EaseInWave, $Top: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.5, $Opacity: 2, $Round: { $Rotate: 0.8} };
		//ZM*WVR|BL
		_CaptionTransitions["zmwvrbl"] = {$Duration: 1200, $Zoom: 11, $FlyDirection: 9, $Easing: { $Left: $JssorEasing$.$EaseInWave, $Top: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.5, $Opacity: 2, $Round: { $Rotate: 0.8} };

		//RTT|10
		_CaptionTransitions["rtt10"] = {$Duration: 700, $Zoom: 11, $Rotate: 1, $Easing: { $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.8} };

		//RTTL|R
		_CaptionTransitions["rttlr"] = {$Duration: 700, $Zoom: 11, $Rotate: 1, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.6, $Opacity: 2, $Round: { $Rotate: 0.8} };
		//RTTL|B
		_CaptionTransitions["rttlb"] = {$Duration: 700, $Zoom: 11, $Rotate: 1, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInCubic }, $ScaleVertical: 0.6, $Opacity: 2, $Round: { $Rotate: 0.8} };

		//RTTS|R
		_CaptionTransitions["rttsr"] = {$Duration: 700, $Zoom: 1, $Rotate: 1, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Zoom: $JssorEasing$.$EaseInQuad, $Rotate: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseOutQuad }, $ScaleHorizontal: 0.6, $Opacity: 2, $Round: { $Rotate: 1.2} };
		//RTTS|B
		_CaptionTransitions["rttsb"] = {$Duration: 700, $Zoom: 1, $Rotate: 1, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInQuad, $Zoom: $JssorEasing$.$EaseInQuad, $Rotate: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseOutQuad }, $ScaleVertical: 0.6, $Opacity: 2, $Round: { $Rotate: 1.2} };

		//RTT*JDN|RT
		_CaptionTransitions["rttjdnrt"] = {$Duration: 1000, $Zoom: 11, $Rotate: .2, $FlyDirection: 6, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseOutCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.8, $ScaleVertical: 0.5, $Opacity: 2, $During: { $Top: [0, 0.5]} };
		//RTT*JDN|LB
		_CaptionTransitions["rttjdnlb"] = {$Duration: 1000, $Zoom: 11, $Rotate: .2, $FlyDirection: 9, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseOutCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.8, $ScaleVertical: 0.5, $Opacity: 2, $During: { $Top: [0, 0.5]} };
		//RTT*JUP|RB
		_CaptionTransitions["rttjuprb"] = {$Duration: 1000, $Zoom: 11, $Rotate: .2, $FlyDirection: 10, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.8, $ScaleVertical: 0.5, $Opacity: 2, $During: { $Top: [0, 0.5]} };
		_CaptionTransitions["rttjuprb2"] = { $Duration: 1200, $Zoom: 11, $Rotate: true, $FlyDirection: 6, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseLinear, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.5, $ScaleVertical: 0.8, $Opacity: 2, $During: { $Left: [0, 0.5] }, $Round: { $Rotate: 0.5} };
		//RTT*JUP|BR
		_CaptionTransitions["rttjupbr"] = {$Duration: 1000, $Zoom: 11, $Rotate: .2, $FlyDirection: 10, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseLinear, $Zoom: $JssorEasing$.$EaseInCubic }, $ScaleHorizontal: 0.5, $ScaleVertical: 0.8, $Opacity: 2, $During: { $Left: [0, 0.5]} };

		//R|IB
		_CaptionTransitions["rib"] = {$Duration: 900, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInOutBack }, $ScaleHorizontal: 0.6, $Opacity: 2 };
		//B|IB
		_CaptionTransitions["bib"] = {$Duration: 900, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInOutBack }, $ScaleVertical: 0.6, $Opacity: 2 };

		var options = {

			$AutoPlay: <?php echo $params->get('navigation', $defaults['navigation']) ?>,   //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
			$AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
			$AutoPlayInterval: <?php echo $params->get('slide_delay', $defaults['slide_delay']) ?>,   //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
			$PauseOnHover: <?php echo $params->get('onhover_stop', $defaults['onhover_stop']) ?>,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, default value is 3

			$ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
			$SlideDuration: <?php echo $params->get('effect_masterspeed', $defaults['effect_masterspeed']) ?>,      //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
			$MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
			//$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
			//$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
			$SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
			$DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
			$ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
			$UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, direction navigator container, thumbnail navigator container etc).
			$PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizontal, 2 vertical, default value is 1
			$DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

			$SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
				$Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
				$Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
				$TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
				$ShowLink: true                                 //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
			},

			$CaptionSliderOptions: {                            //[Optional] Options which specifies how to animate caption
				$Class: $JssorCaptionSlider$,                   //[Required] Class to create instance to animate caption
				$CaptionTransitions: _CaptionTransitions,       //[Required] An array of caption transitions to play caption, see caption transition section at jssor slideshow transition builder
				$PlayInMode: 1,                                 //[Optional] 0 None (no play), 1 Chain (goes after main slide), 3 Chain Flatten (goes after main slide and flatten all caption animations), default value is 1
				$PlayOutMode: 3                                 //[Optional] 0 None (no play), 1 Chain (goes before main slide), 3 Chain Flatten (goes before main slide and flatten all caption animations), default value is 1
			},

			$BulletNavigatorOptions: {                              //[Optional] Options to specify and enable navigator or not
				$Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
				$ChanceToShow: <?php echo $params->get('showdots', $defaults['showdots']) ?>, //[Required] 0 Never, 1 Mouse Over, 2 Always
				$AutoCenter: <?php echo $css_jssorn01 ?>,
				$Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
				$Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
				$SpacingX: 10,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
				$SpacingY: 10,                                   //[Optional] Vertical space between each item in pixel, default value is 0
				$Orientation: <?php echo $params->get('orientationdots', $defaults['orientationdots']) ?>    //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
			},

			 $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
				$ChanceToShow: <?php echo $params->get('navigationarrows', $defaults['navigationarrows']) ?>   //[Required] 0 Never, 1 Mouse Over, 2 Always
			}

		};

		//responsive code begin
		//you can remove responsive code if you don't want the slider scales while window resizes

			var jssor_slider1 = new $JssorSlider$("<?php echo $params->get('container', $defaults['container']) ?>", options);

			function ScaleSlider() {
				var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
				if (parentWidth)
					jssor_slider1.$SetScaleWidth(Math.min(parentWidth, <?php echo $params->get('width', $defaults['width']) ?>));
				else
					window.setTimeout(ScaleSlider, 30);
			}

		ScaleSlider();

		if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
			$(window).bind('resize', ScaleSlider);
		}
		//responsive code end
	});
</script>

<div style="width:100%; height:1px; clear:both"></div>

<div id="slideshowcontainer">

	<div id="<?php echo $params->get('container', $defaults['container']) ?>" style="position: relative; width: <?php echo $params->get('width', $defaults['width']) ?>px !important;
        height: <?php echo $params->get('height', $defaults['height']) ?>px !important; <?php if ($params->get('center_container_automatic', $defaults['center_container_automatic']) == 'centerautoenable') :?>margin:0 auto<?php endif; ?>">

        <!-- Loading Screen -->
        <div u="loading" class ="loading">
            <div class="filter">
            </div>
            <div class="loading_image">
            </div>
        </div>
        <!-- Closing Loading Screen -->

        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: <?php echo $params->get('width', $defaults['width']) ?>px; height: <?php echo $params->get('height', $defaults['height']) ?>px;
            overflow: hidden;">
			<?php for ($i = 0; $i < count($images); $i++) : ?>
	            <div>
	                <?php if ($links[$i]) : ?>
	               		<a u="image" href="<?php echo $links[$i]; ?>"<?php if ($params->get('anchor_target', 'self') == 'blank') echo ' target="_blank" ' ?>>
					<?php endif; ?>
	                <img u="image" src="<?php echo $base.$images[$i] ?>" alt="<?php echo strip_tags($titles[$i]) ?>" />
	                <?php if (($titles[$i] || $contents[$i])) : ?>
	                	<div class="shackslides-titledescription-container"> 
						<?php if ($titles[$i]) : ?>
	                        <div 	u="caption" 
	                        		t="<?php echo $params->get('effect_title', $defaults['effect_title']) ?>" 
	                        		class="shackslideTitle colorstitle" 
	                        		style="
                    				position:absolute; 
                    				background:
                    				<?php if ($params->get('title_background_color', $defaults['title_background_color']) == 'enabletitlebg') :?>
                    					#<?php echo $params->get('title_bgpicker_color', $defaults['title_bgpicker_color']) ?>
                    				<?php endif; ?>
                    				<?php if ($params->get('title_background_color', $defaults['title_background_color']) == 'disabletitlebg') :?>	none<?php endif; ?>"
            				>
	                        			<?php echo $titles[$i]; ?>
	                        </div>
	                    <?php endif; ?>
	                    <?php if ($contents[$i]) : ?>
	                        <div 	u="caption" 
	                        		t="<?php echo $params->get('effect_text', $defaults['effect_text']) ?>" 
	                        		class="shackslideDescription" 
	                        		style="
                    				position:absolute;"
            				>
	                        					<?php echo $contents[$i]; ?>
	                        </div>
	                    <?php endif; ?>
	                    </div>
	                <?php endif; ?>
	                <?php if ($links[$i]) : ?>
	                	</a>
	                <?php endif; ?>
	            </div>
            <?php endfor; ?>
        </div>
        <!-- Closing Slides Container -->
        
        <!-- Navigator Container -->
        <div u="navigator" class="jssorn01">
            <div u="prototype" class="jssor_bullets">
            <?php if($params->get('navigationnumbers', 0) == 1): ?>
            	<div u="numbertemplate" class="jssor_bullets_numbers"></div>
            <?php endif; ?>
            </div>
        </div>
        <!-- Closing Navigator Container -->
       
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssord05l">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssord05r">
        </span>
    </div>
</div>

<div style="width:100%; height:1px; clear:both"></div>