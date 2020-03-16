<?php
/**
 * @package   ShackSlides
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @copyright 2010-2020 Joomlashack.com. All rights reserved
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
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
 * along with ShackSlides.  If not, see <http://www.gnu.org/licenses/>.
 */

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Document\HtmlDocument;
use Joomla\CMS\Environment\Browser;
use Joomla\CMS\Language\Language;
use Joomla\Registry\Registry;

defined('_JEXEC') or die();

/**
 * @var stdClass             $module
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
 */

$containerAttributes = array(
    'id'    => $settings['container'],
    'class' => 'jss-slider'
);
if ($settings['template_design']) {
    $containerAttributes['class'] .= ' jss-slider-template-design';
}

echo sprintf('<div %s>', \Joomla\Utilities\ArrayHelper::toString($containerAttributes));

?>
    <div class="owl-carousel">
        <?php foreach ($images as $i => $image) : ?>
            <div class="jss-image-container jss-descpos-<?php echo $settings['title_description_position'] ?>">
                <?php if ($settings['title_description_position'] == 'above_outside') : ?>
                    <?php require JModuleHelper::getLayoutPath('mod_jsshackslides', 'description'); ?>
                <?php endif; ?>

                <div class="jss-image">
                    <?php if ($settings['height_adjustment'] == 'adjust') : ?>
                        <?php if ($links[$i]) : ?>
                            <a href="<?php echo $links[$i]; ?>"
                                <?php echo $settings['anchor_target'] == 'blank' ? ' target="_blank"' : ''; ?>>
                        <?php endif; ?>

                        <img src="<?php echo $base . $image ?>" alt="<?php echo empty($titles[$i]) ? $image : $titles[$i]; ?>" />

                        <?php if ($links[$i]) : ?>
                            </a>
                        <?php endif; ?>
                    <?php elseif ($settings['height_adjustment'] == 'crop') : ?>
                    <div
                        class="jss-image-int<?php echo $links[$i] ? ' jss-image-link' : ''; ?>"
                        style="background: url('<?php echo  $base . $image ?>');background-image: url('<?php echo  $base . $image ?>')">
                    <?php if ($links[$i]) : ?>
                        <a href="<?php echo $links[$i]; ?>"
                            <?php echo $settings['anchor_target'] == 'blank' ? ' target="_blank"' : ''; ?>>
                    <?php endif; ?>

                    <img src="<?php echo JURI::root() ?>media/mod_jsshackslides/images/blank.gif" alt="<?php echo empty($titles[$i]) ? $image : $titles[$i]; ?>" />

                    <?php if ($links[$i]) : ?>
                        </a>
                    <?php endif; ?>
                    </div>

                    <?php endif; ?>

                    <?php if ($settings['title_description_position'] != 'above_outside' && $settings['title_description_position'] != 'below_outside') : ?>
                        <?php require JModuleHelper::getLayoutPath('mod_jsshackslides', 'description'); ?>
                    <?php endif; ?>
                </div>
                <?php if  ($settings['title_description_position'] == 'below_outside') : ?>
                    <?php require JModuleHelper::getLayoutPath('mod_jsshackslides', 'description'); ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="jss-navigation">
        <div class="jss-navigation-inner">
            <div class="jss-navigation-inner2">
                <div class="jss-navigation-dots"></div>
                <div class="jss-navigation-buttons"></div>
            </div>
        </div>
    </div>
<?php
echo '</div>';
