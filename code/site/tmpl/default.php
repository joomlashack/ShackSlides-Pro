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
	'width' => '500', // width of container
	'height' => '250', // height of container
	//'autoplay' => '5', // number of seconds per slide on autoplay, 0 to disable
	//'pause' => 'yes', // pauses the autoplay on hover over slider
	'description' => 'yes', // displays image discription box
	//'description_background' => 'ffffff', // description background color hex code
	//'description_transparent_background' => 'no', // description background is not transparent by default
	//'description_opacity' => '0.5', // description background opacity
	'description_height' => '50', // description height if position is top/bottom
	'description_width' => '50', // description width if position is right/left
	'position_title_x' => '85',
	'position_title_y' => '85',
	'speed_title' => '300',
	'start_title' => '900',
	'size_title' => '18',
	'color_title' => '#ffffff',
	'font_title' => 'Verdana, Geneva, sans-serif',
	'effect_title' => 'easeInBack',
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
	'navigation' => 'bullet', // displays the navigation
	//'navigation_buttons' => 'yes', // displays next/prev buttons in navigation bar
	//'navigation_label' => 'yes', // shows the numbers for navigation
	'navigation_align' => 'verticalcentered', // shows the numbers for navigation
	'navigation_style' => 'round', // shows the numbers for navigation
	//'mousewheel' => 'no', // can use mousewheel for navigation
	'container' => 'slider', // id for the slider container,
	/*'enable_bootstrap_styles' => 'no',*/
	/*'include_bootstrap' => 'no',*/
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
	'enable_jquery' => 'no',
	'enable_jqueryui' => 'no',
	/*'bootstrap_span_size_description' => 4*/
);

// Adding the javascript and css files to the document
$doc = JFactory::getDocument();
//$doc->addScript(JURI::base() . 'modules/mod_jsshackslides/assets/sliderman.js');

/*$doc->addScript(JURI::base() . 'modules/mod_jsshackslides/assets/slider_revolution/jquery.js');
$doc->addScript(JURI::base() . 'modules/mod_jsshackslides/assets/slider_revolution/jquery-ui.js');*/
    
$doc->addScript(JURI::base() . 'modules/mod_jsshackslides/assets/slider_revolution/jquery.plugins.min.js');
$doc->addScript(JURI::base() . 'modules/mod_jsshackslides/assets/slider_revolution/jquery.slide.min.js');
$doc->addStyleSheet(JURI::base() .'modules/mod_jsshackslides/assets/slider_revolution/css/style.css');
$doc->addStyleSheet(JURI::base() .'modules/mod_jsshackslides/assets/slider_revolution/css/preview.css');
$doc->addStyleSheet(JURI::base() .'modules/mod_jsshackslides/assets/slider_revolution/css/settings.css');
$doc->addStyleSheet(JURI::base() .'modules/mod_jsshackslides/assets/slider_revolution/css/captions.css');

  
// Check if we have to include Jquery and Jquery UI
/*$include_jquery = ($params->get('enable_jquery', $defaults['enable_jquery']) == "yes");
$include_jqueryui = ($params->get('enable_jqueryui', $defaults['enable_jqueryui']) == "yes");

if ($include_jquery) {
	$doc->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js');
	$doc->addScript(JURI::base() . 'modules/mod_jsshackslides/assets/slider_revolution/jquerynoconflict.js');
}

if ($include_jqueryui) {
	$doc->addScript('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js');
	$doc->addStylesheet('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css');
}*/

//ob_start();
//include(JPATH_ROOT.'/modules/mod_jsshackslides/tmpl/css/sliderman.css.php');

/*$styles = ob_get_contents();
ob_end_clean();

$doc->addStyleDeclaration($styles);*/


// Check if we have to include Twitter Bootstrap styles
/*$include_bootstrap = ($params->get('include_bootstrap', $defaults['include_bootstrap']) == "yes");
$enable_bootstrap_styles = ($params->get('enable_bootstrap_styles', $defaults['enable_bootstrap_styles']) == "yes");

if ($include_bootstrap) {

	$doc->addStylesheet(JURI::base() . 'modules/mod_jsshackslides/assets/wrappedbootstrap.css');

}*/

//determine which span class we need to use
$span_class = '';
/*if ($enable_bootstrap_styles) {
	$span_class = 'span12';
	if ($params->get('description', $defaults['description']) == 'yes') {

		if ( in_array($params->get('description_position', $defaults['description_position']), array('left_image', 'right_image')) ) {

				$spanDescription = $params->get('bootstrap_span_size_description', $defaults['bootstrap_span_size_description']);
				$spanImage = 12 - $spanDescription;

				$span_class = 'span' . $spanImage;
		}
	}
}*/

//$extra_container = ($params->get('extra_container', $defaults['extra_container']) == "yes");


?>

<?php //if ($include_bootstrap) : ?><!--div class='jsbootstrap'--><?php //endif; ?>

<?php //if ($extra_container) : ?><!--div class='<?php //echo $params->get('extra_container_class', $defaults['extra_container_class']); ?>'--><?php //endif; ?>

<?php //if ($enable_bootstrap_styles) : ?><!--div id='shackslides-row' class='row-fluid'--><?php //endif ;?>

	<!--div class="shackSlider<?php //echo $params->get('container', $defaults['container']) ?> <?php //echo $params->get('main_container_class', $defaults['main_container_class']); ?> <?php //echo $span_class; ?>"-->

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
							<!-- THE 1 SLIDE -->
                            
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
                                             
				<?php if (($titles[$i] || $contents[$i]) && $params->get('description', $defaults['description']) == 'yes') : ?>
					<div class="slideTitle">
						<?php if ($titles[$i]) : ?>
						<div class="slideTitleIn">
                        	<div class="caption very_large_black_text randomrotate" data-x="<?php echo $params->get('position_title_x', $defaults['position_title_x']); ?>" data-y="<?php echo $params->get('position_title_y', $defaults['position_title_y']); ?>" data-speed="<?php echo $params->get('speed_title', $defaults['speed_title']); ?>" data-start="<?php echo $params->get('start_title', $defaults['start_title']); ?>" data-easing="<?php echo $params->get('effect_title', $defaults['effect_title']); ?>" style="font-family:<?php echo $params->get('font_title', $defaults['font_title']); ?>; font-size:<?php echo $params->get('size_title', $defaults['size_title']); ?>px; color:<?php echo $params->get('color_title', $defaults['color_title']); ?>">
								<?php echo $titles[$i]; ?>				
							</div>
						</div>
						<?php endif; ?>
						<?php if ($contents[$i]) : ?>
						<div class="slideTitleContent">
							<div class="slideTitleContentIn">
                            	<div class="caption very_large_black_text randomrotate" data-x="<?php echo $params->get('position_text_x', $defaults['position_text_x']); ?>" data-y="<?php echo $params->get('position_text_y', $defaults['position_text_y']); ?>" data-speed="<?php echo $params->get('speed_text', $defaults['speed_text']); ?>" data-start="<?php echo $params->get('start_text', $defaults['start_text']); ?>" data-easing="<?php echo $params->get('effect_text', $defaults['effect_text']); ?>">
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
        	<div class="tp-bannertimer"></div>
		</div>

		<div id="<?php echo $params->get('container', $defaults['container']) ?>Nav"></div>

	<!--/div-->

<?php //if ($enable_bootstrap_styles) : ?><!--/div--><?php //endif; ?>

<?php //if ($extra_container) : ?><!--/div--><?php //endif; ?>

<?php //if ($include_bootstrap) : ?><!--/div--><?php //endif; ?>

<?php //include(JPATH_BASE.'/'.'modules'.'/'.'mod_jsshackslides'.'/'.'assets'.'/'.'script.js.php'); ?>

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

				navigationType:"<?php echo $params->get('navigation', $defaults['navigation']) ?>",	//bullet, thumb, none, both		(No Thumbs In FullWidth Version !)
				navigationArrows:"<?php echo $params->get('navigation_align', $defaults['navigation_align']) ?>",		//nexttobullets, verticalcentered, none
				navigationStyle:"<?php echo $params->get('navigation_style', $defaults['navigation_style']) ?>",				//round,square,navbar

				touchenabled:"<?php echo $params->get('touch_enabled', $defaults['touch_enabled']) ?>",						// Enable Swipe Function : on/off
				onHoverStop:"<?php echo $params->get('onhover_stop', $defaults['onhover_stop']) ?>",						// Stop Banner Timet at Hover on Slide on/off

				navOffsetHorizontal:0,
				navOffsetVertical:20,

				stopAtSlide:-1,
				stopAfterLoops:-1,

				shadow:<?php echo $params->get('shadow_slider', $defaults['shadow_slider']) ?>,								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows  (No Shadow in Fullwidth Version !)
				fullWidth:"on"							// Turns On or Off the Fullwidth Image Centering in FullWidth Modus
			});
	});
</script>
