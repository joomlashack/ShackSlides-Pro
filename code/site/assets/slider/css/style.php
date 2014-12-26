<?php
defined('_JEXEC') or die('Direct access to files is not permitted');
?>

.colorstitle {
	color: #<?php echo $params->get('title_color', $defaults['title_color']) ?>;
	font-size: 20px;
	line-height: 30px;
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

#<?php echo $params->get('container', $defaults['container']) ?> {
/*border: 5px solid #FFFFFF;
    box-shadow: 0 0 8px #999999;
    width: 100% !important;
    position:fixed !important;*/
   }
   
/*   #slideshowcontainer {
   width:100%;
   position:fixed
   }
   
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
    display: block;
}