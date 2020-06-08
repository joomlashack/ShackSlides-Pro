<?php
/**
 * @package   ShackSlides
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @copyright 2010-2020 Joomlashack.com. All rights reserved
 * @license   https://www.gnu.org/licenses/gpl.html GNU/GPL
 *
 * This file is part of ShackSlides.
 *
 * ShackSlides is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * ShackSlides is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ShackSlides.  If not, see <https://www.gnu.org/licenses/>.
 */

use Joomla\CMS\Menu\MenuItem;
use Joomla\CMS\Router\Route;
use Joomla\Registry\Registry;

defined('_JEXEC') or die();

/**
 * Main Shack Slides Helper class
 *
 * @package     Shack Slides
 * @subpackage  Main Helper Class
 * @since       2.0
 */
abstract class ModShackSlidesHelper
{
    protected $defaultSettings = array(
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
        'mouse_drag'                              => '1',      // Allow to navigate slides through mouse drag
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
        'navigation_buttons_show'                 => '2',          // Show navigation buttons always, never, on hover
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
        'buttons_left_right_position'             => '',      // TEMPLATE CUSTOM OPTIONS

        /*** ADDITIONAL ***/
        'resize_events'                           => '',      // Initial setting
        'template_design'                         => false    // Used in rare cases
    );

    /**
     * @var string
     */
    protected $noimage = null;

    /**
     * @var string[]
     */
    protected $images = [];

    /**
     * @var string[]
     */
    protected $titles = [];

    /**
     * @var string[]
     */
    protected $links = [];

    /**
     * @var bool
     */
    protected $includeLinks = null;

    /**
     * @var string
     */
    protected $base = null;

    /**
     * @var MenuItem[]
     */
    protected $menu = [];

    /**
     * @var object[]
     */
    protected $contents = [];

    /**
     * @var Registry
     */
    protected $params = null;

    /**
     * Helper construct
     *
     * @param Registry $params Initialization parameters
     *
     * @return void
     * @throws Exception
     */
    public function __construct(Registry $params)
    {
        $this->menu         = JMenu::getInstance('site')->getMenu();
        $this->base         = JURI::base();
        $this->noimage      = ltrim(
            JHtml::_(
                'image',
                'mod_jsshackslides/noimagefound.png',
                null,
                null,
                true,
                1
            ),
            '/'
        );
        $this->includeLinks = $params->get('include_links', 1);

        $this->params = $params;
    }

    /**
     * @param Registry $params
     *
     * @return ModShackSlidesHelper
     */
    public static function getInstance(Registry $params)
    {
        $sourceHelper = $params->get('source', 'folder');
        $filePath     = sprintf(__DIR__ . '/helpers/%s.php', $sourceHelper);
        if ($sourceHelper && is_file($filePath)) {
            require_once $filePath;
            $className = sprintf('ModShackSlides%sHelper', ucfirst($sourceHelper));
            if (class_exists($className)) {
                $helper = new $className($params);
                return $helper;
            }
        }

        return null;
    }

    /**
     * @return array
     */
    public function getSettings()
    {
        $settings = array();

        try {
            // Sets all keys from settings in $settings array
            foreach ($this->defaultSettings as $key => $default) {
                $settings[$key] = $this->params->get($key, $default);
            }

            if ($templateDesign = $this->params->get('template_design')) {
                if ($templateDesign == 1) {
                    $template       = JFactory::getApplication()->getTemplate();
                    $templateDesign = JPATH_THEMES . '/' . $template . '/shackslides.json';

                }
                if (is_file($templateDesign)) {
                    $templateSettings = json_decode(file_get_contents($templateDesign), true);
                    foreach ($templateSettings as $key => $value) {
                        $settings[$key] = $value;
                    }
                    $settings['template_design'] = true;
                }
            }

            if ($settings['container'] == '') {
                $settings['container'] = $this->generateContainerID();
            }

        } catch (Exception $error) {
            // ignore
        }

        return $settings;
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
     * Gets the arrays of links
     *
     * @return  string[]
     */
    public function getLinks()
    {
        return $this->links;
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
     * Gets the images titles
     *
     * @return  array
     */
    public function getTitles()
    {
        return $this->titles;
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
     * Gets the first image found in a certain string
     *
     * @param string $content Content to parse
     *
     * @return  string
     */
    protected function getFirstImageFromContent($content)
    {
        preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $content, $matches);

        if (isset($matches[1])) {
            $image = $matches[1];

            return $image;
        }

        return $this->noimage;
    }

    /**
     * Gets the title (using a tag parse) from a certain string
     *
     * @param string $content Content to parse
     *
     * @return  string
     */
    protected function getTitleFromContent($content)
    {
        $title = strip_tags($content, '<p><h1><h2><h3><h4><h5><h6><span><b><i><u><strong><em><br>');

        if (trim($title) == '') {
            return '';
        }

        return $title;
    }

    /**
     * Custom recursive version of native array_diff_assoc()
     *
     * @param array $array1
     * @param array $array2
     *
     * @return int
     */
    public function array_diff_assoc_recursive($array1, $array2)
    {
        foreach ($array1 as $key => $value) {
            if (is_array($value)) {
                if (!isset($array2[$key])) {
                    $difference[$key] = $value;

                } elseif (!is_array($array2[$key])) {
                    $difference[$key] = $value;

                } else {
                    $new_diff = array_diff_assoc_recursive($value, $array2[$key]);
                    if ($new_diff != false) {
                        $difference[$key] = $new_diff;
                    }
                }

            } elseif (!isset($array2[$key]) || $array2[$key] != $value) {
                $difference[$key] = $value;
            }
        }

        return !isset($difference) ? 0 : $difference;
    }

    /**
     * Compare a query string using and separating its fields
     *
     * @param array $fields Fields
     *
     * @return  boolean
     */
    protected function compareQuery($fields)
    {
        foreach ($this->menu as $item) {
            $diff = $this->array_diff_assoc_recursive($fields, $item->query);

            if (!count($diff)) {
                return $item->id;
            }

            continue;
        }

        return false;
    }

    /**
     * Convert animation output
     *
     * @param string $animation Animation input to convert in options for Owl Carousel
     *
     * @return  boolean
     */
    public function convertAnimation($animation)
    {
        $finalAnimation = '';

        switch ($animation) {
            // LTR effects
            case 'bounced_slide':
                $animationIn  = 'bounceInRight';
                $animationOut = 'bounceOutLeft';
                break;

            case 'faded_slide':
                $animationIn  = 'fadeInRight';
                $animationOut = 'fadeOutLeft';
                break;

            // RTL effects
            case 'slide_rtl':
                $animationIn  = 'slideInLeft';
                $animationOut = 'slideOutRight';
                break;

            case 'bounced_slide_rtl':
                $animationIn  = 'bounceInLeft';
                $animationOut = 'bounceOutRight';
                break;

            case 'faded_slide_rtl':
                $animationIn  = 'fadeInLeft';
                $animationOut = 'fadeOutRight';
                break;

            // TTB effects
            case 'slide_ttb':
                $animationIn  = 'slideInDown';
                $animationOut = 'slideOutDown';
                break;

            case 'bounced_slide_ttb':
                $animationIn  = 'bounceInDown';
                $animationOut = 'bounceOutDown';
                break;

            case 'faded_slide_ttb':
                $animationIn  = 'fadeInDown';
                $animationOut = 'fadeOutDown';
                break;

            // BTT effects
            case 'slide_btt':
                $animationIn  = 'slideInUp';
                $animationOut = 'slideOutUp';
                break;

            case 'bounced_slide_btt':
                $animationIn  = 'bounceInUp';
                $animationOut = 'bounceOutUp';
                break;

            case 'faded_slide_btt':
                $animationIn  = 'fadeInUp';
                $animationOut = 'fadeOutUp';
                break;

            // In place effects
            case 'fade':
                $animationIn  = 'fadeIn';
                $animationOut = 'fadeOut';
                break;

            case 'bounce':
                $animationIn  = 'zoomIn';
                $animationOut = 'bounceOut';
                break;

            case 'roll':
                $animationIn  = 'rollIn';
                $animationOut = 'rollOut';
                break;

            case 'zoom':
                $animationIn  = 'zoomIn';
                $animationOut = 'zoomOut';
                break;

            case 'switch':
                $animationIn  = 'slideInUp';
                $animationOut = 'fadeOutDown';
                break;

            case 'flip_horizontal':
                $animationIn  = 'flipInYFaded';
                $animationOut = 'flipOutY';
                break;

            case 'flip_vertical':
                $animationIn  = 'flipInXFaded';
                $animationOut = 'flipOutX';
                break;

            // Rotate effects
            case 'rotate':
                $animationIn  = 'rotateIn';
                $animationOut = 'rotateOut';
                break;

            case 'rotate_downleft':
                $animationIn  = 'rotateInDownLeft';
                $animationOut = 'rotateOutDownLeft';
                break;

            case 'rotate_downright':
                $animationIn  = 'rotateInDownRight';
                $animationOut = 'rotateOutDownRight';
                break;

            case 'rotate_upleft':
                $animationIn  = 'rotateInUpLeft';
                $animationOut = 'rotateOutUpLeft';
                break;

            case 'rotate_upright':
                $animationIn  = 'rotateInUpRight';
                $animationOut = 'rotateOutUpRight';
                break;

            // No special effects
            default:
                $animationIn = $animationOut = '';
        }

        if ($animationIn) {
            $finalAnimation .= ', animateIn: \'' . $animationIn . '\'';
        }

        if ($animationOut) {
            $finalAnimation .= ', animateOut: \'' . $animationOut . '\'';
        }

        return $finalAnimation;
    }

    /**
     * Generate random container ID
     *
     * @param string $prefix Prefix to add to the container id
     * @param int    $length ID length
     *
     * @return  string
     */
    public function generateContainerID($prefix = 'jss_', $length = 10)
    {
        $randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length);

        return $prefix . $randomString;
    }

    /**
     * Convert Hex color to RGB array
     *
     * @param string $hex Hex color string
     *
     * @return  array
     */
    public function hexToRGB($hex)
    {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));

        } else {
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
     * @param string    $image    Path of the image in media
     * @param string    $css_rule Css rule that will be applied according to the case
     * @param JDocument $doc      Joomla Document
     *
     * @return  array
     */
    public function applyingCustomImages($image, $css_rule, $doc)
    {
        $image_dots = JUri::root(true) . '/' . $image;
        list($width, $height) = getimagesize(JUri::root() . '/' . $image);

        $doc->addStyleDeclaration(
            $css_rule . ' {
                background: url(' . $image_dots . ') no-repeat;
                width:' . $width . 'px;
                height:' . $height . 'px;
            }'
        );

        return array($width, $height);
    }

    /**
     * @param string $link
     *
     * @return void
     */
    protected function addLink($link)
    {
        $this->links[] = $this->includeLinks ? Route::_($link, false) : null;
    }
}
