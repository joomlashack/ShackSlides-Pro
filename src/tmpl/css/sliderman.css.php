<?php

defined('_JEXEC') or die('Direct access to files is not permitted');

$theme = $params->get('theme', 'gray');

$colors = array(
    'gray'   => array('base' => '353535', 'border' => '333333', 'shadow' => '666', 'a' => '999', 'active' => 'fff'),
    'blue'   => array('base' => '7A8498', 'border' => '7A8498', 'shadow' => '666', 'a' => '333', 'active' => 'fff'),
    'white'  => array('base' => 'ffffff', 'border' => 'ccc', 'shadow' => 'bbb', 'a' => '000', 'active' => '999'),
    'red'    => array('base' => 'A74040', 'border' => '5F2F2F', 'shadow' => '666', 'a' => '333', 'active' => 'fff'),
    'green'  => array('base' => '81ac7b', 'border' => '3b4f38', 'shadow' => '666', 'a' => '333', 'active' => 'fff'),
    'orange' => array('base' => 'd9a74d', 'border' => '925813', 'shadow' => '666', 'a' => '666', 'active' => 'fff'),
    'brown'  => array('base' => '816e56', 'border' => '3c3428', 'shadow' => '666', 'a' => '333', 'active' => 'fff'),
    'black'  => array('base' => '252525', 'border' => '101010', 'shadow' => '333', 'a' => 'ccc', 'active' => 'fff'),
    'purple' => array('base' => '86339a', 'border' => '551581', 'shadow' => '333', 'a' => 'ccc', 'active' => 'fff')
);

?>
.shackSlider<?php echo $params->get('container', $defaults['container']) ?> {

    <?php
        if ($params->get('enable_bootstrap_styles', $defaults['enable_bootstrap_styles']) == 'no'
            || ($params->get('enable_bootstrap_styles', $defaults['enable_bootstrap_styles']) == 'yes'
            && (($params->get('description_position', $defaults['description_position']) == 'above_image' ||
                $params->get('description_position', $defaults['description_position']) == 'below_image'))))
                :
        ?>

        width: <?php echo $params->get('width', $defaults['width']) ?>px;
        width: 100% !important;
        <?php if ($params->get('description', $defaults['description']) == "yes" &&
              $params->get('description_position', $defaults['description_position']) == "left_image") : ?>
        padding-left: <?php echo $params->get('description_width', $defaults['description_width']) ?>px;
        <?php endif; ?>
        <?php if ($params->get('description', $defaults['description']) == "yes" &&
              $params->get('description_position', $defaults['description_position']) == "right_image") : ?>
        padding-right: <?php echo $params->get('description_width', $defaults['description_width']) ?>px;
        <?php endif; ?>
        <?php if ($params->get('description', $defaults['description']) == "yes" &&
              $params->get('description_position', $defaults['description_position']) == "above_image") : ?>
        padding-top: <?php echo $params->get('description_height', $defaults['description_height']) ?>px;
        <?php endif; ?>
        <?php if ($params->get('description', $defaults['description']) == "yes" &&
              $params->get('description_position', $defaults['description_position']) == "below_image") : ?>
        padding-bottom: <?php echo $params->get('description_height', $defaults['description_height']) ?>px;
        <?php endif; ?>

    <?php endif; ?>

    margin-bottom: 10px;
}

.shackSlider<?php echo $params->get('container', $defaults['container']) ?> .pagination ul {
    box-shadow: none;
}

.shackSlider<?php echo $params->get('container', $defaults['container']) ?> .pagination ul > li:first-child > a,
.shackSlider<?php echo $params->get('container', $defaults['container']) ?> .pagination ul > li:first-child > span,
.shackSlider<?php echo $params->get('container', $defaults['container']) ?> .pagination ul > li:last-child > a,
.shackSlider<?php echo $params->get('container', $defaults['container']) ?> .pagination ul > li:last-child > span {
    border-radius: 0;
    border: 0;
    float: none;
}

.shackSlider<?php echo $params->get('container', $defaults['container']) ?> .pagination ul > li > a,
.shackSlider<?php echo $params->get('container', $defaults['container']) ?> .pagination ul > li > span {
    border-radius: 0;
    border: 0;
    float: none;
}

.shackSlider<?php echo $params->get('container', $defaults['container']) ?> #sliderContainer<?php echo $params->get('container', $defaults['container']) ?> {
    background: #<?php echo $colors[$theme]['base'] ?> url(<?php echo JURI::base() ?>modules/mod_jsshackslides/tmpl/images/bg.png);
    border: 2px solid #<?php echo $colors[$theme]['border'] ?>;
}

#<?php echo $params->get('container', $defaults['container']) ?>{
    width: <?php echo $params->get('width', $defaults['width']) ?>px;
    width: 100% !important;
    height: <?php echo $params->get('height', $defaults['height']) ?>px;
    margin: auto;
}

.slideTitle{
    font-family: Verdana;
    font-size: 10px;
    text-align: left;
    padding: 5px;
}

#<?php echo $params->get('container', $defaults['container']) ?>Nav {
    <?php if ($params->get('enable_bootstrap_styles', $defaults['enable_bootstrap_styles']) == 'yes') : ?>
    margin: 10px 0;
    display: block;
    <?php endif; ?>
    text-align: <?php echo $params->get('navigation_align', $defaults['navigation_align']) ?>;
}

#<?php echo $params->get('container', $defaults['container']) ?>Nav a {
    height: 16px;
    margin: 5px 2px;
    width: 16px;
    line-height: 16px;
    font-size: 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    padding-top: 0;
    padding-bottom: 0;
    color: #<?php echo $colors[$theme]['a'] ?>;
    <?php if ($params->get('enable_bootstrap_styles', $defaults['enable_bootstrap_styles']) == 'no') : ?>
    padding-left: 2px;
    padding-right: 2px;
    <?php endif; ?>
    <?php if ($params->get('navigation_label', $defaults['navigation_label']) == 'no') : ?>
    text-indent: -9999px;
    background: url("<?php echo JURI::base() ?>modules/mod_jsshackslides/tmpl/images/<?php echo $theme ?>/pagination.png") no-repeat scroll 50% 100% transparent;
    <?php else: ?>
    background-color: #<?php echo $colors[$theme]['base'] ?>;
    border-radius: 5px;
    <?php endif; ?>
}

#<?php echo $params->get('container', $defaults['container']) ?>Nav li.active a, #<?php echo $params->get('container', $defaults['container']) ?>Nav a:active, #<?php echo $params->get('container', $defaults['container']) ?>Nav a:hover,
#<?php echo $params->get('container', $defaults['container']) ?>Nav a.active {
    background-position: 50% 0%;
    color: #<?php echo $colors[$theme]['active']; ?>;
}

a.sliderPrev,
a.sliderNext{
    color: transparent;
    display: inline-block;
    height: 30px;
    line-height: 24px;
    padding-left: 0;
    padding-right: 0;
    position: absolute;
    text-align: center;
    text-decoration: none;
    top: <?php echo($params->get('height', $defaults['height']) / 2) - 12; ?>px;
    width: 30px;

}
a.sliderPrev{
    background: url("<?php echo JURI::base() ?>modules/mod_jsshackslides/tmpl/images/<?php echo $theme ?>/arrows.png") no-repeat scroll 0 0 transparent;
    left: 3px;
}

a.sliderNext{
    background: url("<?php echo JURI::base() ?>modules/mod_jsshackslides/tmpl/images/<?php echo $theme ?>/arrows.png") no-repeat scroll -30px 0 transparent;
    right: 3px;
}

#<?php echo $params->get('container', $defaults['container']) ?>Nav a.sliderPrev{
    position: static;
    background: url("<?php echo JURI::base() ?>modules/mod_jsshackslides/tmpl/images/<?php echo $theme ?>/arrow-prev.png") no-repeat;
    color: transparent;
    padding-left: 0;
    <?php if ($params->get('enable_bootstrap_styles', $defaults['enable_bootstrap_styles']) == 'yes') : ?>
    padding-right: 14px;
    <?php else: ?>
    padding-right: 0;
    <?php endif; ?>
    padding-top: 0;
}

#<?php echo $params->get('container', $defaults['container']) ?>Nav a.sliderNext{
    position: static;
    background: url("<?php echo JURI::base() ?>modules/mod_jsshackslides/tmpl/images/<?php echo $theme ?>/arrow-next.png") no-repeat;
    color: transparent;
    <?php if ($params->get('enable_bootstrap_styles', $defaults['enable_bootstrap_styles']) == 'yes') : ?>
    padding-left: 14px;
    <?php else: ?>
    padding-left: 0;
    <?php endif; ?>
    padding-right: 0;
    padding-top: 0;
}

<?php if ($params->get('enable_bootstrap_styles', $defaults['enable_bootstrap_styles']) == 'yes') : ?>
#sliderContainer {
    width: 100% !important;
}

#sliderContainer div img {
    width: 100% !important;
    height: auto !important;
}

.slidermanImgCont {
    width: 100% !important;
    height: <?php echo $params->get('height'); ?>px !important;
    position: static !important;
}

.slidermanImgCont div {
    width: 100% !important;
    height: <?php echo $params->get('height'); ?>px !important;
}

.slidermanImgCont div img {
    width: 100% !important;
}

#sliderContainer div img.fillHeight {
    width: auto !important;
    height: 100% !important;
    max-width: none;
}

#sliderContainer div img.fillWidth {
    width: 100% !important;
}

#<?php echo $params->get('container', $defaults['container']) ?>{
    height: auto !important;
}

#<?php echo $params->get('container', $defaults['container']) ?>Nav ul li a {
    width: auto !important;
}

.slidermanlinkContainer, .slidermanlinkContainer a {
    width: 100% !important;
    height: 100% !important;
}

.slidermanDescriptionBG, .slidermanDescriptionText, .slideTitle {
    -webkit-box-sizing: border-box;
    -moz-box-sizing:border-box;
    -ms-box-sizing:border-box;
    -o-box-sizing:border-box;
    box-sizing: border-box;
    <?php if (in_array($params->get('description_position', $defaults['description_position']), array('top', 'bottom', 'above_image', 'below_image'))) : ?>
    width: 100% !important;
    <?php else : ?>
    height: 100%;
    <?php endif; ?>
}

.slidermanButtonsCont {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
}

.slidermanButtonsCont .sliderPrev, .slidermanButtonsCont .sliderNext {
    display: inline !important;
    font-size: 35px;
}




<?php endif; ?>
