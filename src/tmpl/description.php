<?php
/**
 * @package   ShackSlides
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @copyright 2010-2021 Joomlashack.com. All rights reserved
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

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Document\HtmlDocument;
use Joomla\CMS\Environment\Browser;
use Joomla\CMS\Language\Language;
use Joomla\Registry\Registry;

defined('_JEXEC') or die();

/**
 * @var object               $module
 * @var array                $attribs
 * @var array                $chrome
 * @var SiteApplication      $app
 * @var string               $scope
 * @var Registry             $params
 * @var string               $template
 * @var string               $path
 * @var Language             $lang
 * @var string               $coreLanguageDirectory
 * @var string               $extensionLanguageDirectory
 * @var array                $langPaths
 * @var string               $content
 * @var ModShackSlidesHelper $helper
 * @var array                $images
 * @var HtmlDocument         $doc
 * @var Browser              $browser
 * @var array                $links
 * @var array                $titles
 * @var array                $contents
 * @var string               $base
 * @var array                $settings
 * @var string               $browserName
 * @var string               $browserVersion
 * @var string               $effectMasterSpeed
 * @var integer              $height
 * @var string               $color_hex
 * @var string               $descriptionMargin
 * @var integer              $dotsWidth
 * @var integer              $dotsHeight
 * @var string               $verticalPosition
 * @var string               $horizontalPosition
 * @var integer              $dotsPadding
 * @var string               $navigationAlignment
 * @var integer              $buttonsPrevHeight
 * @var integer              $buttonsPrevWidth
 * @var integer              $buttonsNextHeight
 * @var integer              $buttonsNextWidth
 * @var string               $themeCss
 * @var string               $value
 * @var string               $key
 * @var string               $rtl_ltr
 * @var string               $sliderLoader
 * @var array                $containerAttributes
 * @var string               $image
 * @var integer              $i
 * @var integer              $value
 * @var array                $vars
 * @var string               $name
 */

if (
    ($settings['title_show'] && !empty($titles[$i]))
    || ($settings['description_show'] && !empty($contents[$i]))
) :
    ?>
    <div class="jss-title-description jss-alignment-<?php echo $settings['title_description_alignment'] ?>">
        <?php if ($settings['title_show'] && !empty($title[$i])) : ?>
            <div class="jss-title">0
                <?php echo sprintf('<%1$s>%2$s</%1$s>', $settings['title_tag'], $titles[$i]); ?>
            </div>
        <?php endif; ?>

        <?php if ($settings['description_show'] && !empty($contents[$i])) : ?>
            <div class="jss-description">
                <?php echo sprintf('<%1$s>%2$s</%1$s>', $settings['description_tag'], $contents[$i]); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif;
