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

if ($settings['title_show'] || $settings['description_show'])
        :
?>
	<div class="jss-title-description jss-alignment-<?php echo $settings['title_description_alignment'] ?>">
<?php
    if ($settings['title_show'])
        :
?>
		<div class="jss-title">
			<<?php echo $settings['title_tag'] ?>>
				<?php echo $titles[$i] ?>
			</<?php echo $settings['title_tag'] ?>>
		</div>
<?php
    endif;
?>
<?php
    if ($settings['description_show'])
        :
?>
		<div class="jss-description">
			<<?php echo $settings['description_tag'] ?>>
				<?php echo $contents[$i] ?>
			</<?php echo $settings['description_tag'] ?>>
		</div>
<?php
    endif;
?>
	</div>
<?php
endif;
