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
	'container' => 'slider', // id for the slider container,
	'main_container_class' => '',
	'descriptiontemplate' => 'animatedtemplate',
	'width' => '500', // width of container
	'height' => '250', // height of container
	'slide_delay' => '5000', // dalay of the transitions
	'description' => 'yes', // displays image discription box
	'effect_masterspeed' => '300',
	'effect_slide' => 'rotateoverlap',
	'onhover_stop' => '0', // on hover stop on/off,
	'center_container_automatic' => 'centerautoenable',
	//DESCRIPTION OPTIONS
	'title_text_class' => '',
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
	'navigationarrows' => '2',
	'showdots' => '2',
	'orientationdots' => '1',
	'navigationarrows_customrows' => 'd17',
	'navigationarrows_customdots' => 'n03',
	'horizontalpaddingdots' => '0',
	'verticalpaddingdots' => '0',
	'rangesliderdots' => '100',
	'rangesliderrows' => '100',
	//JQUERY OPTIONS
	'includejquery' => 'off',
	'includejqueryui' => 'on',
	'includenoconflictmode' => 'off',
	//DESCRIPTION OPTIONS FOR INDEPENDENT TEMPLATE
	'descriptionposition_outside' => 'bottomdescind',
	'width_desc_outside' => '300',
	'height_desc_outside' => '150',


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

// load jQuery, if not loaded before
//checking if installed joomla version is less  3.0
if (version_compare( JVERSION, '3.2', '<' ) == 1) {
	 // do something for joomla version less than 3.0
	if(!JFactory::getApplication()->get('jquery')){
		JFactory::getApplication()->set('jquery',true);
		$doc = JFactory::getDocument();
		if ($params->get('includejquery', $defaults['includejquery']) == 'on') :
			$doc->addScript("modules/mod_jsshackslides/assets/slider/jquery-1.9.1.min.js");
			$doc->addScript(JURI::base() . 'modules/mod_jsshackslides/assets/slider/jquerynoconflict.js');
		endif;
		if ($params->get('includejqueryui', $defaults['includejqueryui']) == 'on') :
			$doc->addScript("https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js");
			$doc->addStyleSheet('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9/themes/base/jquery-ui.css');
		endif;
	}
 }
 else{
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

	/*$doc->addStyleSheet(JURI::base() .'modules/mod_jsshackslides/assets/slider/css/style.css');*/
	$doc->addStyleSheet(JURI::base() .'modules/mod_jsshackslides/assets/slider/css/settings.css');

	ob_start();
	include(JPATH_ROOT.'/modules/mod_jsshackslides/assets/slider/css/style.php');

	$styles = ob_get_contents();
	ob_end_clean();

	$doc->addStyleDeclaration($styles);

	$css_add_jssorn01 = '';
    $css_jssorn01 = 0;
    if($params->get('showdots', $defaults["showdots"]) != 0)
    {
        $css_add_jssorn01 .= '.jssorn01{';

		if($params->get('horizontalaligndots', "center") == "right")
        {
        	$css_add_jssorn01 .= 'right:3%;
        						  padding-right:'.$params->get('horizontalpaddingdots', $defaults["horizontalpaddingdots"]).'px;';
        }
        elseif($params->get('horizontalaligndots', "center") == "left")
        {
        	$css_add_jssorn01 .= 'left:3%;
        						  padding-left:'.$params->get('horizontalpaddingdots', $defaults["horizontalpaddingdots"]).'px;';
        }
        elseif($params->get('horizontalaligndots', "center") == "center")
        {
        	 $css_jssorn01 = 1;
        	 $css_add_jssorn01 .= 'padding-left:'.$params->get('horizontalpaddingdots', $defaults["horizontalpaddingdots"]).'px;
								   padding-right:'.$params->get('horizontalpaddingdots', $defaults["horizontalpaddingdots"]).'px;';        	 					
        }

        if($params->get('verticalaligndots', "bottom") == "bottom")
        {
        	$css_add_jssorn01 .= 'bottom:3%;
        						  padding-bottom:'.$params->get('verticalpaddingdots', $defaults["verticalpaddingdots"]).'px;';
        }
        elseif($params->get('verticalaligndots', "bottom") == "top")
        {
        	$css_add_jssorn01 .= 'top:3%;
        						  padding-top:'.$params->get('verticalpaddingdots', $defaults["verticalpaddingdots"]).'px;';
        }
        elseif($params->get('verticalaligndots', "center") == "center")
        {
        	 $css_jssorn01 = 2;
         	 $css_add_jssorn01 .= 'padding-bottom:'.$params->get('verticalpaddingdots', $defaults["verticalpaddingdots"]).'px;
 								   padding-top:'.$params->get('verticalpaddingdots', $defaults["verticalpaddingdots"]).'px;';    
        }

        if($params->get('verticalaligndots', "bottom") == "center" && $params->get('horizontalaligndots', "center") == "center")
        {
        	$css_jssorn01 = 3;
        }
        $css_add_jssorn01 .= '}';
   	}
?>

<!-----------------------------------------------------START CODE FOR FULL WIDTH TEMPLATE AND ANIMATED TEMPLATE-------------------------------------------->
<?php if ($params->get('descriptiontemplate', $defaults['descriptiontemplate']) == 'fullwithanimatedtemplate' or $params->get('descriptiontemplate', $defaults['descriptiontemplate']) == 'animatedtemplate') :?>
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

		/*	<?php if ($params->get('descriptiontemplate', $defaults['descriptiontemplate']) == 'fullwithanimatedtemplate') :?>
			$FillMode: 2,   //[Optional] The way to fill image in slide, 0 stretch, 1 contain (keep aspect ratio and put all inside slide), 2 cover (keep aspect ratio and cover whole slide), 4 actuall size, default value is 0
			<?php endif; ?>*/

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

		//<?php if ($params->get('descriptiontemplate', $defaults['descriptiontemplate']) == 'animatedtemplate') :?>

			var jssor_slider1 = new $JssorSlider$("<?php echo $params->get('container', $defaults['container']) ?>", options);

			function ScaleSlider() {
				var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
				if (parentWidth)
					jssor_slider1.$SetScaleWidth(Math.min(parentWidth, <?php echo $params->get('width', $defaults['width']) ?>));
				else
					window.setTimeout(ScaleSlider, 30);
			}
		//<?php endif; ?>

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
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(<?php echo JUri::root(true); ?>/modules/mod_jsshackslides/images/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>

        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: <?php echo $params->get('width', $defaults['width']) ?>px; height: <?php echo $params->get('height', $defaults['height']) ?>px;
            overflow: hidden;">
			<?php for ($i = 0; $i < count($images); $i++) : ?>
                <?php if ($images[$i] === false) continue; ?>
                
            <div>
                <?php if ($links[$i]) : ?>
                <a u=image href="<?php echo $links[$i]; ?>"<?php if ($params->get('anchor_target', 'self') == 'blank') echo ' target="_blank" ' ?>>
				<?php endif; ?>
                <!--img u="image" src="<?php //echo $base.$images[$i] ?>" title="<?php //echo strip_tags($titles[$i]) ?>" alt="<?php //echo strip_tags($titles[$i]) ?>" /-->
                <img u="image" src="<?php echo $base.$images[$i] ?>" alt="<?php echo strip_tags($titles[$i]) ?>" />

                <?php if (($titles[$i] || $contents[$i])) : ?>
					<?php if ($titles[$i]) : ?>
                        <div u=caption t="<?php echo $params->get('effect_title', $defaults['effect_title']) ?>" class="shackslideTitle colorstitle <?php echo $params->get('title_text_class', $defaults['title_text_class']) ?>" style="position:absolute; <?php if ($params->get('titleposition', $defaults['titleposition']) == 'top_left_title') :?>left:40px; top: 30px;<?php endif; ?> <?php if ($params->get('titleposition', $defaults['titleposition']) == 'bottom_left_title') :?>left:40px; top:  <?php echo $params->get('height', $defaults['height']) / 1.2 ?>px;<?php endif; ?> <?php if ($params->get('titleposition2', $defaults['titleposition2']) == 'notshowtitle') :?>visibility: hidden; left:40px; top: 30px;<?php endif; ?> <?php if ($params->get('titleposition', $defaults['titleposition']) == 'advancedpostitle') :?>left:<?php echo $params->get('position_title_x', $defaults['position_title_x']) ?>px; top: <?php echo $params->get('position_title_y', $defaults['position_title_y']) ?>px;<?php endif; ?> width:300px; height:30px; alpha(opacity=80); opacity:0.8; background:<?php if ($params->get('title_background_color', $defaults['title_background_color']) == 'enabletitlebg') :?>#<?php echo $params->get('title_bgpicker_color', $defaults['title_bgpicker_color']) ?><?php endif; ?><?php if ($params->get('title_background_color', $defaults['title_background_color']) == 'disabletitlebg') :?>none<?php endif; ?>">
							<?php echo $titles[$i]; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($contents[$i]) : ?>
                        <div u=caption t="<?php echo $params->get('effect_text', $defaults['effect_text']) ?>" class="shackslideDescription  <?php echo $params->get('title_text_class', $defaults['title_text_class']) ?>" style="position:absolute; <?php if ($params->get('descriptionposition3', $defaults['descriptionposition3']) == 'notshowdescbottom') :?>left:50%; top: 30px;visibility: hidden; <?php endif; ?> <?php if ($params->get('descriptionposition2', $defaults['descriptionposition2']) == 'topdescription') :?>left:45px; top:30px; <?php endif; ?> <?php if ($params->get('descriptionposition2', $defaults['descriptionposition2']) == 'topdescriptionright') :?>left:<?php echo $params->get('width', $defaults['width']) / 2 ?>px; top:30px; <?php endif; ?> <?php if ($params->get('descriptionposition2', $defaults['descriptionposition2']) == 'advancedpostextdesc') :?>left:<?php echo $params->get('position_text_x', $defaults['position_text_x']) ?>px; top:<?php echo $params->get('position_text_y', $defaults['position_text_y']) ?>px; <?php endif; ?> width:<?php echo $params->get('width_text', $defaults['width_text']) ?>px; height:<?php echo $params->get('height_text', $defaults['height_text']) ?>px">
							<?php echo $contents[$i]; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($links[$i]) : ?>
                	</a>
                <?php endif; ?>

            </div>
            <?php endfor; ?>
        </div>

        <?php

        $style = '

        	/*
        	.jssorn01 div           (normal)
        	.jssorn01 div:hover     (normal mouseover)
        	.jssorn01 .jssor_bulletsav           (active)
        	.jssorn01 .jssor_bulletsav:hover     (active mouseover)
        	.jssorn01 .jssor_bulletsdn           (mousedown)
        	*/

	        #'.$params->get('container', $defaults['container']).'.jssorn01 div, #'.$params->get('container', $defaults['container']).' .jssorn01 div:hover, #'.$params->get('container', $defaults['container']).' .jssorn01 .jssor_bulletsav , #'.$params->get('container', $defaults['container']).' .jssorn01 .jssor_bulletsdn
	        {
	            background: url('.JUri::root(true).'/modules/mod_jsshackslides/tmpl/images/'.$params->get('navigationarrows_customdots', $defaults['navigationarrows_customdots']).'.png) no-repeat;
	            overflow:hidden;
	            cursor: pointer;
	            opacity:'.($params->get('rangesliderdots', $defaults['rangesliderdots'])/100).';
	            filter: alpha(opacity='.$params->get('rangesliderdots', $defaults['rangesliderdots']).');
	        }
	        #'.$params->get('container', $defaults['container']).' .jssorn01 div { background-position: -5px -4px; }
	        #'.$params->get('container', $defaults['container']).' .jssorn01 div:hover, #'.$params->get('container', $defaults['container']).' .jssorn01 .jssor_bulletsav:hover { background-position: -35px -4px; }
	        #'.$params->get('container', $defaults['container']).' .jssorn01 .jssor_bulletsav { background-position: -65px -4px; }
	        #'.$params->get('container', $defaults['container']).' .jssorn01 .jssor_bulletsdn, #'.$params->get('container', $defaults['container']).' .jssorn01 .jssor_bulletsdn:hover { background-position: -95px -4px; }

        	'.$css_add_jssorn01.'

        	/* jssor slider direction navigator skin 05 css */
            /*
            .jssord05l              (normal)
            .jssord05r              (normal)
            .jssord05l:hover        (normal mouseover)
            .jssord05r:hover        (normal mouseover)
            .jssord05ldn            (mousedown)
            .jssord05rdn            (mousedown)
            */
            #'.$params->get('container', $defaults['container']).' .jssord05l, #'.$params->get('container', $defaults['container']).' .jssord05r, #'.$params->get('container', $defaults['container']).' .jssord05ldn, #'.$params->get('container', $defaults['container']).' .jssord05rdn
            {
            	position: absolute;
            	cursor: pointer;
            	display: block;
                background: url('.JUri::root(true).'/modules/mod_jsshackslides/tmpl/images/'.$params->get('navigationarrows_customrows', $defaults['navigationarrows_customrows']).'.png) no-repeat;
                overflow:hidden;
                opacity:'.($params->get('rangesliderrows', $defaults['rangesliderrows'])/100).';
                filter: alpha(opacity='.$params->get('rangesliderrows', $defaults['rangesliderrows']).');
            }
            #'.$params->get('container', $defaults['container']).' .jssord05l { background-position: -10px -40px; }
            #'.$params->get('container', $defaults['container']).' .jssord05r { background-position: -70px -40px; }
            #'.$params->get('container', $defaults['container']).' .jssord05l:hover { background-position: -130px -40px; }
            #'.$params->get('container', $defaults['container']).' .jssord05r:hover { background-position: -190px -40px; }
            #'.$params->get('container', $defaults['container']).' .jssord05ldn { background-position: -250px -40px; }
            #'.$params->get('container', $defaults['container']).' .jssord05rdn { background-position: -310px -40px; }

        ';

        $doc->addStyleDeclaration($style);

        ?>
        
        <!-- navigator container -->
        <div u="navigator" class="jssorn01" style="position: absolute">
            <!-- navigator item prototype -->
            <div u="prototype" class="jssor_bullets" style="position: absolute; width: 21px; height: 21px; text-align:center;">
            <?php if($params->get('navigationnumbers', 0) == 1): ?>
            	<div u="numbertemplate" class="jssor_bullets_numbers"></div>
            <?php endif; ?>
            </div>
        </div>
       
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssord05l" style="width: 40px; height: 40px; top: <?php echo $params->get('height', $defaults['height']) / 2 - 20 ?>px; left: 8px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssord05r" style="width: 40px; height: 40px; top: <?php echo $params->get('height', $defaults['height']) / 2 - 20 ?>px; right: 8px">
        </span>
    </div>
    <!-- Jssor Slider End -->


<?php endif; ?>
<!-----------------------------------------------------FINISH CODE FOR FULL WIDTH TEMPLATE AND ANIMATED TEMPLATE-------------------------------------------->


</div>
<div style="width:100%; height:1px; clear:both"></div>