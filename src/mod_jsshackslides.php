<?php
/**
 * @package     Shack Slides
 * @subpackage  Module
 *
 * @copyright   Copyright (C) 2010 - 2015 Joomlashack. Meritage Assets.  All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die();

require_once __DIR__ . '/helper.php';

$helper = ModShackSlidesHelper::getInstance($params);
if (!$helper) {
    //not a good thing
    return;
}

$doc = JFactory::getDocument();

jimport('joomla.environment.browser');
$browser = JBrowser::getInstance();

$images   = $helper->getImages();
$links    = $helper->getLinks();
$titles   = $helper->getTitles();
$contents = $helper->getContents();
$base     = $helper->getBase();

if (!$images) {
    // If there are no images set, there is nothing to be shown
    return;
}

$defaults = array(
    /*** Basic Options ***/
    'height'                                  => '250',    // Container height
    'height_adjustment'                       => 'adjust', // Height adjustment
    'slide_autoheight'                        => 'true',   // Auto height (depends on the height adjustment)
    'slide_delay'                             => '5000',   // Transition delay
    'description'                             => 'yes',    // Show descriptions
    'slide_effect_masterspeed'                => '300',    // Transition speed
    'slide_text_effect_masterspeed'           => '500',    // Transition speed for text effects
    'slide_effect'                            => 'slide',  // Effect for slides
    'slide_onhoverstop'                       => '1',      // Stop on mouse hover
    'slide_items'                             => '1',      // Number of items per slide page
    'slide_margin'                            => '10',     // Margin between slides when using multiple per page
    'slide_autoplay'                          => '1',      // Autoplay on or off

    /*** SLIDE SOURCES ***/
    'anchor_target'                           => 'self', // Where the link target will point at

    /*** Display OPTIONS ***/
    'title_description_position'              => 'bottom',  // Title and description position
    'title_description_alignment'             => 'left',    // Title and description alignment
    'title_description_padding_vertical'      => '10',      // Title and description vertical padding
    'title_description_padding_horizontal'    => '10',      // Title and description horizontal padding
    'title_show'                              => '1',       // Show title flag
    'title_show_mobile'                       => '1',       // Show title in mobile flag
    'title_width'                             => '300',     // Title width
    'title_height'                            => '50',      // Title height
    'title_bgcolor_flag'                      => '1',       // Title color flag
    'title_color'                             => 'FFFFFF',  // Title color
    'title_color_flag'                        => '1',       // Title background color flag
    'title_bgcolor'                           => '#000000', // Title background color
    'title_bgcolor_opacity'                   => '70',      // Title background opacity
    'title_effect'                            => 'none',    // Title effect
    'title_tag'                               => 'h4',      // Title tag
    'description_show'                        => '1',       // Show description flag
    'description_show_mobile'                 => '1',       // Show description in mobile flag
    'description_width'                       => '300',     // Description width
    'description_height'                      => '100',     // Description height
    'description_color_flag'                  => '1',       // Description color flag
    'description_color'                       => '#FFFFFF', // Description color
    'description_bgcolor_flag'                => '1',       // Description background color flag
    'description_bgcolor'                     => '#000000', // Description background color
    'description_bgcolor_opacity'             => '70',      // Description background opacity
    'description_effect'                      => 'none',    // Description effect
    'description_tag'                         => 'div',     // Description tag

    /*** NAVIGATION OPTIONS ***/
    'navigation_show'                         => '2',          // Show the navigation always, never, on hover
    'navigation_show_mobile'                  => '1',          // Show navigation in mobile flag
    'navigation_theme_shape'                  => 'round',      // Navigation theme shape
    'navigation_effect_theme'                 => 'theme0',     // Navigation theme effect
    'navigation_shownumbers'                  => '0',          // Show slide numbers in navigation
    'navigation_orientation'                  => 'horizontal', // Orientation
    'navigation_align_horizontal'             => 'center',     // Horizontal alignment
    'navigation_align_vertical'               => 'bottom',     // Vertical alignment
    'navigation_padding_horizontal'           => '10',         // Horizontal padding
    'navigation_padding_vertical'             => '10',         // Vertical padding
    'navigation_dots_color'                   => 'FFFFFF',     // Dots color
    'navigation_activedots_color'             => '000000',     // Active dots color
    'navigation_dots_numbers_color'           => '777',        // Dots numbers color
    'navigation_opacity'                      => '50',         // Opacity
    'navigation_custom_dot'                   => '',           // Custom nav dot
    'navigation_custom_dothover'              => '',           // Custom hover nav dot
    'navigation_custom_dotactive'             => '',           // Custom active nav dot
    'navigation_buttons_show'                 => '2',          // Show the navigation buttons always, never, on hover
    'navigation_buttons_show_mobile'          => '1',          // Show the buttons in mobile flag
    'buttons_theme'                           => 'theme2',     // Buttons theme
    'navigation_buttons_color'                => '666666',     // Buttons color
    'navigation_buttonshover_color'           => 'FFFFFF',     // Buttons hover color
    'navigation_buttons_opacity'              => '70',         // Buttons opacity
    'navigation_buttons_custom_previous'      => '',           // Custom previous button
    'navigation_buttons_custom_previoushover' => '',           // Custom previous hover button
    'navigation_buttons_custom_next'          => '',           // Custom next button
    'navigation_buttons_custom_nexthover'     => '',           // Custom next hover button
    'navigation_buttons_custom_width'         => '',
    'navigation_buttons_custom_height'        => '',
    'navigation_padding_dots'                 => '',
    'navigation_custom_align'                 => false,
    'navigation_dots_width'                   => '',
    'navigation_dots_height'                  => '',

    /*** ADVANCED OPTIONS ***/
    'container'                               => '',      // id for the slider container
    'language_rtl_enable'                     => 'false', // RTL SUPPORT
    'buttons_left_right_position'             => ''       // TEMPLATE CUSTOM OPTIONS
);

$settings = array();

// Sets all keys from settings in $settings array
foreach ($defaults as $key => $default) {
    $settings[$key] = $params->get($key, $default);
}

// Resize events - set to null initially
$settings['resize_events'] = '';

// Load jQuery
JHTML::_('jquery.framework');

JHtml::_('stylesheet', 'mod_jsshackslides/owl.carousel.min.css', array('relative' => true));
JHtml::_('stylesheet', 'mod_jsshackslides/animate.min.css', array('relative' => true));
JHtml::_('stylesheet', 'mod_jsshackslides/jsshackslides.css', array('relative' => true));
JHtml::_('script', 'mod_jsshackslides/owl.carousel.min.js', array('relative' => true));

// Setting container ID
if ($settings['container'] == '') {
    $settings['container'] = $helper->generateContainerID();
}

$browserName    = $browser->getBrowser();
$browserVersion = $browser->getMajor();

// Default effect masterspeed = 1ms (CSS3 won't work with 0 to avoid the effect)
$effectMasterSpeed = '1';

// Sets the masterspeed for the selected effect
if ($settings['slide_effect'] != 'none') {
    $effectMasterSpeed = $settings['slide_effect_masterspeed'];

    // If there is a slide effect, assigns the same speed value for the text effects.
    // Otherwise it uses default value for text
    $settings['slide_text_effect_masterspeed'] = $settings['slide_effect_masterspeed'];
}

$settings['slides_animation']         = $helper->convertAnimation($settings['slide_effect']);
$settings['slide_center']             = ($settings['slide_items'] == 1 ? 'true' : 'false');
$settings['slide_effect_masterspeed'] = $effectMasterSpeed;
$settings['slide_delay']              += $settings['slide_effect_masterspeed'];

$doc->addStyleDeclaration('
    #' . $settings['container'] . '.jss-slider .owl-carousel .owl-item,
    #' . $settings['container'] . '.jss-slider .owl-carousel .owl-item.animated {
            -webkit-animation-duration:' . $effectMasterSpeed . 'ms;
            animation-duration:' . $effectMasterSpeed . 'ms;
        }
    #' . $settings['container'] . '.jss-slider .jss-title > .animated,
    #' . $settings['container'] . '.jss-slider .jss-description > .animated {
            -webkit-animation-duration:' . $settings['slide_text_effect_masterspeed'] . 'ms;
            animation-duration:' . $settings['slide_text_effect_masterspeed'] . 'ms;
        }'
);

// Defined height in case of adjustment (to set a max height for the slider)
if ($settings['height_adjustment'] == 'adjust') {
    $height = (int)$settings['height'];

    if ($height > 0) {
        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .owl-carousel .owl-item .jss-image {
                max-height: ' . $height . 'px;
            }'
        );
    }
} elseif ($settings['height_adjustment'] == 'crop') {
    $settings['slide_autoheight'] = 'false';
    $doc->addStyleDeclaration(
        '
        #' . $settings['container'] . '.jss-slider .owl-carousel .owl-item .jss-image {
            width: 100%;
            height: ' . $settings['height'] . 'px;
        }'
    );
}

// Description styles
if ($settings['description_show']) {
    // Description color
    if ($settings['description_color_flag']) {
        $doc->addStyleDeclaration(
            '#' . $settings['container'] . '.jss-slider .jss-description > * {
                color: ' . $settings['description_color'] . ';
            }'
        );
    }

    // Description background
    if ($settings['description_bgcolor_flag']) {
        $color_hex                       = $settings['description_bgcolor'];
        $settings['description_bgcolor'] = implode(',', $helper->hexToRGB($settings['description_bgcolor']));
        $doc->addStyleDeclaration(
            '#' . $settings['container'] . '.jss-slider .jss-description {
                background-color: ' . $color_hex . ';
                background-color: rgba(' . $settings['description_bgcolor'] . ', ' . ($settings['description_bgcolor_opacity'] / 100) . ');
            }'
        );
    }

    // Description width
    if ($settings['title_description_position'] == 'left'
        || $settings['title_description_position'] == 'right'
        || $settings['title_description_position'] == 'left_outside'
        || $settings['title_description_position'] == 'right_outside') {
        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .jss-description {
                width: ' . (int)$settings['description_width'] . 'px;
            }'
        );
    }

    // Description height
    if ($settings['title_description_position'] == 'top'
        || $settings['title_description_position'] == 'bottom'
        || $settings['title_description_position'] == 'above_outside'
        || $settings['title_description_position'] == 'below_outside') {
        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .jss-description {
                height: ' . (int)$settings['description_height'] . 'px;
            }'
        );
    }

    // Left outside description
    if ($settings['title_description_position'] == 'left_outside') {
        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .owl-carousel .jss-image,
            #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-inner {
                padding-left: ' . (int)$settings['description_width'] . 'px;
            }'
        );
    }

    // Right outside title
    if ($settings['title_description_position'] == 'right_outside') {
        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .owl-carousel .jss-image,
            #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-inner {
                padding-right: ' . (int)$settings['description_width'] . 'px;
            }'
        );
    }
}

// Title styles
if ($settings['title_show']) {
    // Title color
    if ($settings['title_color_flag']) {
        $doc->addStyleDeclaration(
            '#' . $settings['container'] . '.jss-slider .jss-title > * {
                color: ' . $settings['title_color'] . ';
            }'
        );
    }

    // Title background
    if ($settings['title_bgcolor_flag']) {
        $color_hex                 = $settings['title_bgcolor'];
        $settings['title_bgcolor'] = implode(',', $helper->hexToRGB($settings['title_bgcolor']));
        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .jss-title {
                background-color: ' . $color_hex . ';
                background-color: rgba(' . $settings['title_bgcolor'] . ', ' . ($settings['title_bgcolor_opacity'] / 100) . ');
            }'
        );
    }

    // Title width
    if ($settings['title_description_position'] == 'left'
        || $settings['title_description_position'] == 'right'
        || $settings['title_description_position'] == 'left_outside'
        || $settings['title_description_position'] == 'right_outside'
    ) {
        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .jss-title {
                width: ' . (int)$settings['title_width'] . 'px;
            }'
        );
    }

    // Title height
    if ($settings['title_description_position'] == 'top'
        || $settings['title_description_position'] == 'bottom'
        || $settings['title_description_position'] == 'above_outside'
        || $settings['title_description_position'] == 'below_outside'
    ) {
        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .jss-title {
                height: ' . (int)$settings['title_height'] . 'px;
            }'
        );
    }

    // Left outside title
    if ($settings['title_description_position'] == 'left_outside') {
        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .owl-carousel .jss-image,
            #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-inner {
                padding-left: ' . (int)$settings['title_width'] . 'px;
            }'
        );
    }

    // Right outside title
    if ($settings['title_description_position'] == 'right_outside') {
        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .owl-carousel .jss-image,
            #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-inner {
                padding-right: ' . (int)$settings['title_width'] . 'px;
            }'
        );
    }

    // Hide title in mobile styles
    if ($settings['title_show_mobile'] == 0) {
        $doc->addStyleDeclaration(
            '@media (max-width: 767px) {
                #' . $settings['container'] . '.jss-slider .jss-title {
                    display: none;
                }
            }'
        );
    }
}

$settings['animation_script'] = '
    function jssInit_' . $settings['container'] . '(event) {}
    function jssInitEnd_' . $settings['container'] . '(event) {}
';

$settings['animation_events'] = '';

// Title and Description padding (shared setting)
if ($settings['description_show'] || $settings['title_show']) {
    $descriptionMargin = 'auto';

    switch ($settings['title_description_position']) {
        case 'top':
        case 'above_outside':
            $descriptionMargin = '0 0 auto 0';
            break;

        case 'right':
        case 'right_outside':
            $descriptionMargin = '0 0 0 auto';
            break;

        case 'bottom':
        case 'below_outside':
            $descriptionMargin = 'auto 0 0 0';
            break;

        case 'left':
        case 'left_outside':
            $descriptionMargin = '0 auto 0 0';
            break;
    }

    $doc->addStyleDeclaration(
        '
        #' . $settings['container'] . '.jss-slider .jss-title-description .jss-title,
        #' . $settings['container'] . '.jss-slider .jss-title-description .jss-description {
            padding: ' . (int)$settings['title_description_padding_vertical'] . 'px ' . (int)$settings['title_description_padding_horizontal'] . 'px;
            margin: ' . $descriptionMargin . ';
        }'
    );

    // Above/Below outside title/description
    if ($settings['title_description_position'] == 'above_outside'
        || $settings['title_description_position'] == 'below_outside') {
        $paddingTitleDescription         = ($settings['title_show'] ? (int)$settings['title_height'] : 0)
            + ($settings['description_show'] ? (int)$settings['description_height'] : 0);
        $paddingPositionTitleDescription = ($settings['title_description_position'] == 'above_outside'
            ? 'top'
            : 'bottom'
        );

        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-inner {
                padding-' . $paddingPositionTitleDescription . ': ' . $paddingTitleDescription . 'px;
            }'
        );
    }

    // Text animation script - only if one slide per page is showing
    if ($settings['slide_items'] == 1 && ($settings['title_effect'] != 'none' || $settings['description_effect'])) {
        $settings['slide_delay'] = (int)$settings['slide_delay']
            + ($settings['title_effect'] != 'none' ? (int)$settings['slide_text_effect_masterspeed'] : 0)
            + ($settings['description_effect'] != 'none' ? (int)$settings['slide_text_effect_masterspeed'] : 0);

        $settings['animation_script'] = '
            function jssInit_' . $settings['container'] . '(event) {
                ' . ($settings['title_effect'] != 'none' && substr($settings['title_effect'], 0, 10) != 'attention_'
                ? 'jQuery("#' . $settings['container'] . ' .jss-title > *").css("opacity", "0");'
                : '') . '
                ' . ($settings['description_effect'] != 'none' && substr($settings['description_effect'], 0,
                10) != 'attention_'
                ? 'jQuery("#' . $settings['container'] . ' .jss-description > *").css("opacity", "0");'
                : '') . '
            }
            function jssInitEnd_' . $settings['container'] . '(event) {
                jssAnimText_' . $settings['container'] . '(event.item.index);
            }
            function jssAnimTextExec_' . $settings['container'] . '(c, x, c2, x2) {
                if (c == undefined) { c = c2; x = x2; c2 = undefined; x2 = undefined; }
                jQuery(c).addClass(x + " animated")
                    .one(jQuery.support.animation.end, function(e) {
                        jQuery(this).removeClass(x + " animated");
                        jQuery(this).css("opacity", "1");
                        if (c2 != undefined) jssAnimTextExec_' . $settings['container'] . '(c2, x2);
                });
            }
            function jssAnimText_' . $settings['container'] . '(i) {
                if (!jQuery.support.animation || !jQuery.support.transition) {
                    return;
                }
                jssAnimTextExec_' . $settings['container'] . '(' . (($settings['title_show'] == '1' && $settings['title_effect'] != 'none') ?
                '"#' . $settings['container'] . ' .owl-item:eq(" + i + ") .jss-title > *","' . (substr($settings['title_effect'],
                    0, 10) == 'attention_'
                    ? substr($settings['title_effect'], 10)
                    : $settings['title_effect']) . '"'
                : 'undefined,undefined') .
            ',' . (($settings['description_show'] == '1' && $settings['description_effect'] != 'none') ?
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
                    ' . ($settings['description_effect'] != 'none' && substr($settings['description_effect'], 0,
                10) != 'attention_'
                ? 'jQuery("#' . $settings['container'] . ' .owl-item:not(:eq(" + event.item.index + ")) .jss-description > *").css("opacity", "0");'
                : '') . '
                    jssAnimText_' . $settings['container'] . '(event.item.index);
                }
                ' . $settings['container'] . '_anim = 0;
            });';
    }

    if (($settings['title_description_position'] == 'left'
            || $settings['title_description_position'] == 'right'
            || $settings['title_description_position'] == 'left_outside'
            || $settings['title_description_position'] == 'right_outside')
        && (($browserName == 'msie' && $browserVersion < 11) || $browserName == 'safari')
    ) {
        $settings['resize_events'] .= '
            function ' . $settings['container'] . 'SetHeight(){
                var height = jQuery("#' . $settings['container'] . '.jss-slider").height();
                var title = jQuery("#' . $settings['container'] . '.jss-slider .jss-title-description .jss-title");
                var description = jQuery("#' . $settings['container'] . '.jss-slider .jss-title-description .jss-description");

                if(title.length && description.length) {
                    height = jQuery("#' . $settings['container'] . '.jss-slider").height() / 2;
                }

                title.css("height" , height);
                description.css("height" , height);
            }
                ' . $settings['container'] . 'SetHeight();

            ' . $settings['container'] . '.on("resized.owl.carousel", function(event) {
                setTimeout(function () {
                    ' . $settings['container'] . 'SetHeight();
                }, 500);
            });';
    } else {
        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .jss-title-description .jss-title,
            #' . $settings['container'] . '.jss-slider .jss-title-description .jss-description {
                    -webkit-flex-grow: 1;
                    -moz-flex-grow: 1;
                    -ms-flex-grow: 1;
                    -o-flex-grow: 1;
                    flex-grow: 1;
                }'
        );
    }

    // Hide description in mobile styles
    if ($settings['description_show_mobile'] == 0) {
        $doc->addStyleDeclaration(
            '@media (max-width: 767px) {
                #' . $settings['container'] . '.jss-slider .jss-description {
                    display: none;
                }
            }'
        );
    }
}

// Navigation
if ($settings['navigation_show'] != '0') {
    if ($settings['navigation_show'] == '1') {
        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots {
                opacity: 0;
                -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            }'
        );
    }

    // Navigation is shown - always or just on hover (default by css)
    $doc->addStyleDeclaration(
        '
        #' . $settings['container'] . '.jss-slider' . (($settings['navigation_show'] == '1') ? ':hover' : '') . ' .jss-navigation .jss-navigation-dots {
            opacity: ' . (((int)$settings['navigation_opacity']) / 100) . ';
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=' . ((int)$settings['navigation_opacity']) . ')";
        }
        #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot > div > span {
            color: ' . $settings['navigation_dots_numbers_color'] . ';
        }'
    );

    $dotsWidth  = ($settings['navigation_dots_width'] != '') ? $settings['navigation_dots_width'] : 30;
    $dotsHeight = ($settings['navigation_dots_height'] != '') ? $settings['navigation_dots_height'] : 30;

    if ($settings['navigation_custom_dot'] != '') {
        list($dotsWidth, $dotsHeight) = $helper->applyingCustomImages(
            $settings['navigation_custom_dot'],
            '#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot > div',
            $doc
        );

    } else {
        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot > div {
                width: ' . $dotsWidth . 'px;
                height: ' . $dotsHeight . 'px;
            }
            #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot > div > span {
                line-height: ' . $dotsHeight . 'px;
            }'
        );
    }

    if ($settings['navigation_custom_dothover'] != '') {
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

    if ($settings['navigation_custom_dotactive'] != '') {
        $helper->applyingCustomImages(
            $settings['navigation_custom_dotactive'],
            '#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot.active > div',
            $doc
        );
    }

    $settings['navigation_show'] = 'true';

    $verticalPosition   = '';
    $horizontalPosition = '';
    $dotsPadding        = ($settings['navigation_padding_dots'] != '')
        ? $settings['navigation_padding_dots']
        : 5;

    switch ($settings['navigation_align_vertical']) {
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

    switch ($settings['navigation_align_horizontal']) {
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

    $navigationAlignment = ($settings['navigation_custom_align'] == false)
        ? $verticalPosition . ';' . $horizontalPosition . ';'
        : '';

    // Navigation settings
    $doc->addStyleDeclaration(
        '
        #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots {
            padding: ' . (int)$settings['navigation_padding_vertical'] . 'px ' . (int)$settings['navigation_padding_horizontal'] . 'px;
            ' . $navigationAlignment . '
        }
        #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot {
            display: inline-block;
            *display: inline;
        }'
    );

    switch ($settings['navigation_orientation']) {
        case 'horizontal':
            $doc->addStyleDeclaration(
                '
                #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots {
                    width: ' . ((($dotsWidth + $dotsPadding * 2) * sizeof($images)) + (2 * (int)$settings['navigation_padding_horizontal'])) . 'px;
                    height: ' . ((2 * (int)$settings['navigation_padding_vertical']) + $dotsHeight) . 'px;
                }
                #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot {
                    display: inline-block;
                    *display: inline;
                    margin: 0 ' . $dotsPadding . 'px;
                }'
            );
            break;
        case 'vertical':
            $doc->addStyleDeclaration(
                '
                #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots {
                    height: ' . ((($dotsHeight + $dotsPadding) * sizeof($images)) - $dotsPadding + (2 * (int)$settings['navigation_padding_vertical'])) . 'px;
                    width: ' . ((2 * (int)$settings['navigation_padding_horizontal']) + $dotsWidth) . 'px;
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
    $doc->addStyleDeclaration(
        '
        #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot span {
            opacity: ' . ($settings['navigation_shownumbers'] ? '1' : '0') . '
        }'
    );

    // Hide navigation in mobile styles
    if ($settings['navigation_show_mobile'] == 0) {
        $doc->addStyleDeclaration(
            '@media (max-width: 767px) {
                #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots {
                    display: none;
                }
            }'
        );
    }
} else {
    $settings['navigation_show'] = 'false';
}

// Navigation
if ($settings['navigation_buttons_show'] != '0') {
    $buttonsPrevHeight = 40;
    $buttonsPrevWidth  = 40;
    $buttonsNextHeight = 40;
    $buttonsNextWidth  = 40;

    if ($settings['navigation_buttons_custom_previous'] != '') {
        list($buttonsPrevWidth, $buttonsPrevHeight) = $helper->applyingCustomImages(
            $settings['navigation_buttons_custom_previous'],
            '#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons .owl-prev',
            $doc
        );

        if ($settings['navigation_buttons_custom_width'] != '' && $settings['navigation_buttons_custom_height'] != '') {
            $buttonsPrevHeight = $settings['navigation_buttons_custom_height'];
            $buttonsPrevWidth  = $settings['navigation_buttons_custom_width'];
        }

    } else {
        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons .owl-prev {
                width: ' . $buttonsPrevWidth . 'px;
                height: ' . $buttonsPrevHeight . 'px;
            }'
        );
    }

    if ($settings['navigation_buttons_custom_previoushover'] != '') {
        $helper->applyingCustomImages(
            $settings['navigation_buttons_custom_previoushover'],
            '#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons .owl-prev:hover',
            $doc
        );
    }

    if ($settings['navigation_buttons_custom_next'] != '') {
        list($buttonsNextWidth, $buttonsNextHeight) = $helper->applyingCustomImages(
            $settings['navigation_buttons_custom_next'],
            '#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons .owl-next',
            $doc
        );

        if ($settings['navigation_buttons_custom_width'] != '' && $settings['navigation_buttons_custom_height'] != '') {
            $buttonsNextHeight = $settings['navigation_buttons_custom_height'];
            $buttonsNextWidth  = $settings['navigation_buttons_custom_width'];
        }
    } else {
        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons .owl-next {
                width: ' . $buttonsNextWidth . 'px;
                height: ' . $buttonsNextHeight . 'px;
            }'
        );
    }

    if ($settings['navigation_buttons_custom_nexthover'] != '') {
        $helper->applyingCustomImages(
            $settings['navigation_buttons_custom_nexthover'],
            '#' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons .owl-next:hover',
            $doc
        );
    }

    if ($settings['navigation_buttons_show'] == '1') {
        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons [class*=\'owl-\'] {
                opacity: 0;
                visibility: hidden;
            }'
        );
    }

    if ($settings['buttons_left_right_position'] != '') {
        $doc->addStyleDeclaration(
            '
            #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons .owl-prev {
                left: ' . $settings['buttons_left_right_position'] . '%;
            }
            #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons .owl-next {
                right: ' . $settings['buttons_left_right_position'] . '%;
            }'
        );
    }

    // Navigation is shown - always or just on hover (default by css).  Height adjustment
    $doc->addStyleDeclaration(
        '
        #' . $settings['container'] . '.jss-slider' . (($settings['navigation_buttons_show'] == '1') ? ':hover' : '') .
        ' .jss-navigation .jss-navigation-buttons [class*=\'owl-\'] {
            opacity: ' . (((int)$settings['navigation_buttons_opacity']) / 100) . ';
            visibility: visible;
        }
        #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons [class*=\'owl-\']{
            border-color: ' . $settings['navigation_buttons_color'] . ';
        }
        #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons [class*=\'owl-\']:hover{
            border-color: ' . $settings['navigation_buttonshover_color'] . ';
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

    // Hide buttons in mobile styles
    if ($settings['navigation_buttons_show_mobile'] == 0) {
        $doc->addStyleDeclaration(
            '@media (max-width: 767px) {
                #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-buttons {
                    display: none;
                }
            }'
        );
    }

    $settings['navigation_buttons_show'] = 'true';

} else {
    $settings['navigation_buttons_show'] = 'false';
}

// Loads theme css
if ($settings['navigation_show'] || $settings['navigation_buttons_show']) {
    $themeCss = '';

    if ($settings['navigation_theme_shape'] != 'none') {
        $themeCss .= '
                #' . $settings['container'] . '.jss-slider .jss-navigation .jss-navigation-dots .owl-dot > div {
                    background-color: ' . $settings['navigation_dots_color'] . ';
                    }';

        if (file_exists(JPATH_SITE . '/media/mod_jsshackslides/css/shape/' . $settings['navigation_theme_shape'] . '.css')) {
            $themeCss .= file_get_contents(JPATH_SITE . '/media/mod_jsshackslides/css/shape/' . $settings['navigation_theme_shape'] . '.css');
        }

        if (file_exists(
            JPATH_SITE . '/media/mod_jsshackslides/css/shape/' . $settings['navigation_theme_shape'] . '.' . $browserName . $browserVersion . '.css'
        )) {
            $themeCss .= file_get_contents(
                JPATH_SITE . '/media/mod_jsshackslides/css/shape/' . $settings['navigation_theme_shape'] . '.' . $browserName . $browserVersion . '.css'
            );
        }
    }

    if ($settings['buttons_theme'] != 'none') {
        $themeCss .= file_get_contents(JPATH_SITE . '/media/mod_jsshackslides/css/theme_buttons/' . $settings['buttons_theme'] . '.css');

        if (file_exists(
            JPATH_SITE . '/media/mod_jsshackslides/css/theme_buttons/' . $settings['buttons_theme'] . '.' . $browserName . $browserVersion . '.css'
        )) {
            $themeCss .= file_get_contents(
                JPATH_SITE . '/media/mod_jsshackslides/css/theme_buttons/' . $settings['buttons_theme'] . '.' . $browserName . $browserVersion . '.css'
            );
        }
    }

    if ($settings['navigation_effect_theme'] != 'none') {
        $themeCss .= file_get_contents(
            JPATH_SITE . '/media/mod_jsshackslides/css/effects_theme_navigation/' . $settings['navigation_effect_theme'] . '.css'
        );

        if (file_exists(
            JPATH_SITE . '/media/mod_jsshackslides/css/effects_theme_navigation/' . '.' . $browserName . $browserVersion . '.css'
        )) {
            $themeCss .= file_get_contents(
                JPATH_SITE . '/media/mod_jsshackslides/css/effects_theme_navigation/' . '.' . $browserName . $browserVersion . '.css'
            );
        }
    }

    foreach ($settings as $key => $value) {
        $themeCss = str_replace('$$' . $key, '#' . $value, $themeCss);
    }

    /* Remove double hashtag! e.g. ##000000 -> #000000
     * This cleanup is required due this CSS rendering system was built when colors didn't included a hashtag (#).
     * Now that native color parameters uses a hashtag
     * some colors would include double (##) after doing the str_replace() above */
    $themeCss = str_replace('##', '#', $themeCss);

    $doc->addStyleDeclaration($themeCss);
}

$lang    = JFactory::getLanguage();
$rtl_ltr = $lang->get('rtl');

if ($rtl_ltr == 0) {
    $settings['language_rtl_enable'] = 'false';
} else {
    $settings['language_rtl_enable'] = 'true';
}

// Loads slider Javascript
$sliderLoader = file_get_contents(JPATH_SITE . '/media/mod_jsshackslides/js/owl.load.js');

// Replaces all slider variables in loader
foreach ($settings as $key => $value) {
    $sliderLoader = str_replace('$$' . $key, $value, $sliderLoader);
}

// Text animations script.  It must load first because of the init script for text effects
if ($settings['animation_script'] != '') {
    $doc->addScriptDeclaration($settings['animation_script']);
}

// Loads slider (Javascript)
$doc->addScriptDeclaration($sliderLoader);

require JModuleHelper::getLayoutPath('mod_jsshackslides');
