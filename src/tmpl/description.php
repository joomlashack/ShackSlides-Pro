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

defined('_JEXEC') or die();

if ($settings['title_show'] || $settings['description_show']) : ?>
    <div class="jss-title-description jss-alignment-<?php echo $settings['title_description_alignment'] ?>">
<?php if ($settings['title_show']) : ?>
    <div class="jss-title">
        <<?php echo $settings['title_tag'] ?>>
            <?php echo $titles[$i] ?>
        </<?php echo $settings['title_tag'] ?>>
    </div>
<?php endif; ?>

<?php if ($settings['description_show']) : ?>
    <div class="jss-description">
        <<?php echo $settings['description_tag'] ?>>
            <?php echo $contents[$i] ?>
        </<?php echo $settings['description_tag'] ?>>
    </div>

<?php endif; ?>
    </div>
<?php endif;
