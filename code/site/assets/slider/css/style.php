<?php
defined('_JEXEC') or die('Direct access to files is not permitted');
?>

.colorstitle {
	color: #<?php echo $params->get('title_color', $defaults['title_color']) ?>;
	font-size: 20px;
	line-height: 30px;
	text-align: center;
	border-radius: 4px;
    <?php if ($params->get('title_background_color', $defaults['title_background_color']) == 'notbackgroundtitle') :?>
    background: none;
	<?php endif; ?>
    <?php if ($params->get('title_background_color', $defaults['title_background_color']) == 'blackbgtitle') :?>
    background: #000000;
	background-color: rgba(0, 0, 0, 0.6); 
	<?php endif; ?>
    <?php if ($params->get('title_background_color', $defaults['title_background_color']) == 'whitebgtitle') :?>
    background: #FFFFFF;
	background-color: rgba(255, 255, 255, 0.6); 
	<?php endif; ?>
    <?php if ($params->get('title_background_color', $defaults['title_background_color']) == 'bluegbtitle') :?>
    background: #3399CC;
	background-color: rgba(51, 153, 204, 0.6); 
	<?php endif; ?>
    <?php if ($params->get('title_background_color', $defaults['title_background_color']) == 'orangebgtitle') :?>
    background: #FF9900;
	background-color: rgba(255, 153, 0, 0.6); 
	<?php endif; ?>
    
}
