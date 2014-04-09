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
	'descriptiontemplate' => 'animatedtemplate',
	'width' => '500', // width of container
	'height' => '250', // height of container
	'timerbar' => 'yes',
	'description' => 'yes', // displays image discription box
	'description_height' => '50', // description height if position is top/bottom
	'description_width' => '50', // description width if position is right/left
	'position_title_x' => '85',
	'position_title_y' => '85',
	'speed_title' => '300',
	'start_title' => '900',
	'style_def_text' => 'notextstyle',
	'title_text_class' => '',
	'effect_title' => 'easeInBack',
	'descriptionposition' => 'top_in',
	'descriptionposition2' => 'bottombardescription',
	'position_text_x' => '85',
	'position_text_y' => '150',
	'speed_text' => '300',
	'start_text' => '1100',
	'effect_text' => 'easeOutBack',
	'template_slider' => 'responsive', // description width if position is right/left
	'description_position' => 'bottom', // top,button,right,left are options
	'description_overflow' => 'hidden', // default description overflow (from image) is hidden
	'buttons' => 'no', // displays the next/prev buttons
	'buttons_opacity' => '1', // buttons opacity
	'buttons_prev_label' => '', // previous button label
	'buttons_next_label' => '', // next button label
	'navigationtype' => '-1',
	'navigation' => 'yes', // displays the navigation
	'navigation_animated' => 'bullet', // displays the navigation
	'navigation_align_animated' => 'verticalcentered', // shows the numbers for navigation on ANIMATED template
	'navigation_style' => 'round', // shows the numbers for navigation
	'container' => 'slider', // id for the slider container,
	'touch_enabled' => 'on', // touch enabled on/off,
	'onhover_stop' => 'on', // on hover stop on/off,
	'main_container_class' => '',
	'extra_container' => 'no',
	'extra_container_class' => '',
	'slide_delay' => '5000', // dalay of the transitions
	'effect_slide2' => 'fade',
	'effect_slotamount' => '1',
	'effect_masterspeed' => '300',
	'shadow_slider' => '0',
	'includejquery' => 'off',
	'includejqueryui' => 'off',
	'includenoconflictmode' => 'off',
	
	'autoplay' => '5', // number of seconds per slide on autoplay, 0 to disable
	'pause' => 'yes', // pauses the autoplay on hover over slider
	'description_background' => 'ffffff', // description background color hex code
	'description_transparent_background' => 'no', // description background is not transparent by default
	'description_opacity' => '0.5', // description background opacity
	'navigation_buttons' => 'yes', // displays next/prev buttons in navigation bar
	'navigation_label' => 'yes', // shows the numbers for navigation
	'mousewheel' => 'no', // can use mousewheel for navigation
	'enable_bootstrap_styles' => 'no',
	'include_bootstrap' => 'no',
	'bootstrap_span_size_description' => 4
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
			$doc->addScript("https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js");
		endif;
		if ($params->get('includenoconflictmode', $defaults['includenoconflictmode']) == 'on') :
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
	 JHTML::_('jquery.framework');
	 JHtml::_('jquery.ui');
 }

//includes if ANIMATED TEMPLATE
if ($params->get('descriptiontemplate', $defaults['descriptiontemplate']) == 'animatedtemplate') :
	$doc->addScript(JURI::base() . 'modules/mod_jsshackslides/assets/slider/jquery.plugins.min.js');
	$doc->addScript(JURI::base() . 'modules/mod_jsshackslides/assets/slider/jquery.slide.min.js');
	
	$doc->addStyleSheet(JURI::base() .'modules/mod_jsshackslides/assets/slider/css/style.css');
	$doc->addStyleSheet(JURI::base() .'modules/mod_jsshackslides/assets/slider/css/settings.css');
	
	ob_start();
	include(JPATH_ROOT.'/modules/mod_jsshackslides/assets/slider/css/style.php');
	
	$styles = ob_get_contents();
	ob_end_clean();
	
	$doc->addStyleDeclaration($styles);
endif;

//includes if STATIC TEMPLATE
if ($params->get('descriptiontemplate', $defaults['descriptiontemplate']) == 'statictemplate') :
// Adding the javascript and css files to the document
$doc = JFactory::getDocument();
$doc->addScript(JURI::base() . 'modules/mod_jsshackslides/assets/sliderman.js');

ob_start();
include(JPATH_ROOT.'/modules/mod_jsshackslides/tmpl/css/sliderman.css.php');
$styles = ob_get_contents();
ob_end_clean();

$doc->addStyleDeclaration($styles);


// Check if we have to include Twitter Bootstrap styles
$include_bootstrap = ($params->get('include_bootstrap', $defaults['include_bootstrap']) == "yes");
$enable_bootstrap_styles = ($params->get('enable_bootstrap_styles', $defaults['enable_bootstrap_styles']) == "yes");

if ($include_bootstrap) {

	$doc->addStylesheet(JURI::base() . 'modules/mod_jsshackslides/assets/wrappedbootstrap.css');

}

//determine which span class we need to use
$span_class = '';
if ($enable_bootstrap_styles) {
	$span_class = 'span12';
	if ($params->get('description', $defaults['description']) == 'yes') {

		if ( in_array($params->get('description_position', $defaults['description_position']), array('left_image', 'right_image')) ) {

				$spanDescription = $params->get('bootstrap_span_size_description', $defaults['bootstrap_span_size_description']);
				$spanImage = 12 - $spanDescription;

				$span_class = 'span' . $spanImage;
		}
	}
}

$extra_container = ($params->get('extra_container', $defaults['extra_container']) == "yes");
endif;
//ENDS includes if STATIC TEMPLATE

?>


<!--STARTS BODY CONTENT OF ANIMATED TEMPLATE-->
<?php if ($params->get('descriptiontemplate', $defaults['descriptiontemplate']) == 'animatedtemplate') :?>

<div id="<?php echo $params->get('container', $defaults['container']) ?>">
	<?php if ($params->get('template_slider', $defaults['template_slider']) == 'responsive') : ?>
    <div class="bannercontainer responsive">
        <div class="banner tp-simpleresponsive">
    <?php endif; ?>
    <?php if ($params->get('template_slider', $defaults['template_slider']) == 'fullwidth') : ?>
    <div class="fullwidthbanner-container">
        <div class="fullwidthabnner tp-simpleresponsive">
    <?php endif; ?>
    <ul>
        <?php for ($i = 0; $i < count($images); $i++) : ?>
            <?php if ($images[$i] === false) continue; ?>
            <li data-transition="<?php echo $params->get('effect_slide2', $defaults['effect_slide2']); ?>" data-slotamount="<?php echo $params->get('effect_slotamount', $defaults['effect_slotamount']); ?>" data-masterspeed="<?php echo $params->get('effect_masterspeed', $defaults['effect_masterspeed']); ?>" >
            <?php if ($links[$i]) : ?>
                <a href="<?php echo $links[$i]; ?>"<?php if ($params->get('anchor_target', 'self') == 'blank') echo ' target="_blank" ' ?>>
            <?php endif; ?>
                    <img src="<?php echo $base.$images[$i] ?>" title="<?php echo strip_tags($titles[$i]) ?>" alt="<?php echo strip_tags($titles[$i]) ?>" />
            <?php if ($links[$i]) : ?>
                </a>
            <?php endif; ?>                          
            
    
            <?php if (($titles[$i] || $contents[$i])) : ?>
                <div class="slideTitle">
                    <?php if ($params->get('descriptionposition', $defaults['descriptionposition']) == 'notshowdesc' or $params->get('descriptionposition', $defaults['descriptionposition']) == 'top_left_in' or $params->get('descriptionposition', $defaults['descriptionposition']) == 'bottom_left_in' or $params->get('descriptionposition', $defaults['descriptionposition']) == 'top_right_in' or $params->get('descriptionposition', $defaults['descriptionposition']) == 'bottom_right_in' or $params->get('descriptionposition', $defaults['descriptionposition']) == 'advancedpostitle') : ?>
                        <?php if ($titles[$i]) : ?>
                        <div class="slideTitleIn">
                            <div class="caption <?php echo $params->get('style_def_text', $defaults['style_def_text']); ?> randomrotate <?php echo $params->get('title_text_class', $defaults['title_text_class']); ?> <?php echo $params->get('descriptionposition', $defaults['descriptionposition']); ?>" <?php if ($params->get('descriptionposition', $defaults['descriptionposition']) == 'advancedpostitle') : ?>data-x="<?php echo $params->get('position_title_x', $defaults['position_title_x']); ?>" data-y="<?php echo $params->get('position_title_y', $defaults['position_title_y']); ?>"<?php endif; ?> data-speed="<?php echo $params->get('speed_title', $defaults['speed_title']); ?>" data-start="<?php echo $params->get('start_title', $defaults['start_title']); ?>" data-easing="<?php echo $params->get('effect_title', $defaults['effect_title']); ?>">
                                <?php echo $titles[$i]; ?>				
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($contents[$i]) : ?>
                    <div class="slideTitleContent">
                        <div class="slideTitleContentIn <?php echo $params->get('descriptionposition2', $defaults['descriptionposition2']); ?>">
                            <div class="caption randomrotate" <?php if ($params->get('descriptionposition2', $defaults['descriptionposition2']) == 'advancedpostextdesc') : ?>data-x="<?php echo $params->get('position_text_x', $defaults['position_text_x']); ?>" data-y="<?php echo $params->get('position_text_y', $defaults['position_text_y']); ?>"<?php endif; ?> data-speed="<?php echo $params->get('speed_text', $defaults['speed_text']); ?>" data-start="<?php echo $params->get('start_text', $defaults['start_text']); ?>" data-easing="<?php echo $params->get('effect_text', $defaults['effect_text']); ?>">
                                <?php echo $contents[$i]; ?>
                            </div>					
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            </li>
        <?php endfor; ?>
    </ul>
        
    <!-- CORRED -->
    <?php if ($params->get('timerbar', $defaults['timerbar']) == 'yes') : ?>
        <div class="tp-bannertimer"></div>
    <?php endif; ?>
    
    <!-- END OF CONTAINER DIVS -->
    <?php if ($params->get('template_slider', $defaults['template_slider']) == 'responsive') : ?>
    </div></div>
    <?php endif; ?>
    
    <?php if ($params->get('template_slider', $defaults['template_slider']) == 'fullwidth') : ?>
    </div></div>
    <?php endif; ?>
</div>            

<div id="<?php echo $params->get('container', $defaults['container']) ?>Nav"></div>

<script>
	jQuery(document).ready(function() {
			<?php if ($params->get('template_slider', $defaults['template_slider']) == 'responsive') : ?>
			jQuery('.banner').revolution(
			<?php endif; ?>
			<?php if ($params->get('template_slider', $defaults['template_slider']) == 'fullwidth') : ?>
			jQuery('.fullwidthabnner').revolution(
			<?php endif; ?>
		 
			{
				delay:<?php echo $params->get('slide_delay', $defaults['slide_delay']) ?>,
				startheight:<?php echo $params->get('height', $defaults['height']) ?>,
				startwidth:<?php echo $params->get('width', $defaults['width']) ?>,

				hideThumbs:300,

				thumbWidth:100,							// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
				thumbHeight:50,
				thumbAmount:5,

				navigationType:"<?php echo $params->get('navigation_animated', $defaults['navigation_animated']) ?>",	//bullet, thumb, none, both		(No Thumbs In FullWidth Version !)
				navigationArrows:"<?php echo $params->get('navigation_align_animated', $defaults['navigation_align_animated']) ?>",		//nexttobullets, verticalcentered, none
				navigationStyle:"<?php echo $params->get('navigation_style', $defaults['navigation_style']) ?>",				//round,square,navbar

				touchenabled:"<?php echo $params->get('touch_enabled', $defaults['touch_enabled']) ?>",						// Enable Swipe Function : on/off
				onHoverStop:"<?php echo $params->get('onhover_stop', $defaults['onhover_stop']) ?>",						// Stop Banner Timet at Hover on Slide on/off

				navOffsetHorizontal:0,
				navOffsetVertical:20,

				stopAtSlide:1,
				stopAfterLoops:<?php echo $params->get('navigationtype', $defaults['navigationtype']) ?>,

				shadow:0<?php //echo $params->get('shadow_slider', $defaults['shadow_slider']) ?>,								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows  (No Shadow in Fullwidth Version !)
				fullWidth:"on"							// Turns On or Off the Fullwidth Image Centering in FullWidth Modus
			});
	});
</script>

<?php endif; ?>
<!--FINISH BODY CONTENT OF ANIMATED TEMPLATE-->



<!--STATIC TEMPLATE-->
<?php if ($params->get('descriptiontemplate', $defaults['descriptiontemplate']) == 'statictemplate') :?>


	<?php if ($include_bootstrap) : ?><div class='jsbootstrap'><?php endif; ?>
    
    <?php if ($extra_container) : ?><div class='<?php echo $params->get('extra_container_class', $defaults['extra_container_class']); ?>'><?php endif; ?>
    
    <?php if ($enable_bootstrap_styles) : ?><div id='shackslides-row' class='row-fluid'><?php endif ;?>
    
        <div class="shackSlider<?php echo $params->get('container', $defaults['container']) ?> <?php echo $params->get('main_container_class', $defaults['main_container_class']); ?> <?php echo $span_class; ?>">
    
            <div id="<?php echo $params->get('container', $defaults['container']) ?>">
    
    
                <?php for ($i = 0; $i < count($images); $i++) : ?>
                    <?php if ($images[$i] === false) continue; ?>
                    <?php if ($links[$i]) : ?>
                        <a href="<?php echo $links[$i]; ?>"<?php if ($params->get('anchor_target', 'self') == 'blank') echo ' target="_blank" ' ?>>
                    <?php endif; ?>
                            <img src="<?php echo $base.$images[$i] ?>" title="<?php echo strip_tags($titles[$i]) ?>" alt="<?php echo strip_tags($titles[$i]) ?>" />
                    <?php if ($links[$i]) : ?>
                        </a>
                    <?php endif; ?>
    
                    <?php if (($titles[$i] || $contents[$i]) && $params->get('description', $defaults['description']) == 'yes') : ?>
                        <div class="slideTitle">
                            <?php if ($titles[$i]) : ?>
                            <div class="slideTitleIn">
                                <h3>
                                    <?php echo $titles[$i]; ?>								
                                </h3>
                            </div>
                            <?php endif; ?>
                            <?php if ($contents[$i]) : ?>
                            <div class="slideTitleContent">
                                <div class="slideTitleContentIn">
                                    <?php echo $contents[$i]; ?>							
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
    
                <?php endfor; ?>
    
            </div>
    
            <div id="<?php echo $params->get('container', $defaults['container']) ?>Nav"></div>
    
        </div>
    
    <?php if ($enable_bootstrap_styles) : ?></div><?php endif; ?>
    
    <?php if ($extra_container) : ?></div><?php endif; ?>
    
    <?php if ($include_bootstrap) : ?></div><?php endif; ?>
    
    <?php include(JPATH_BASE.'/'.'modules'.'/'.'mod_jsshackslides'.'/'.'assets'.'/'.'script.js.php'); ?>


<?php endif; ?>