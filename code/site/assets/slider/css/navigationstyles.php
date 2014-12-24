<?php

$css_add_jssorn01 = '';
$css_jssorn01 = 0;
if($params->get('showdots', $defaults["showdots"]) != 0)
{
    $css_add_jssorn01 .= '.jssorn01{';

	if($params->get('horizontalaligndots', $defaults["horizontalaligndots"]) == "right")
    {
    	$css_add_jssorn01 .= 'right:3%;
    						  padding-right:'.$params->get('horizontalpaddingdots', $defaults["horizontalpaddingdots"]).'px;';
    }
    elseif($params->get('horizontalaligndots', $defaults["horizontalaligndots"]) == "left")
    {
    	$css_add_jssorn01 .= 'left:3%;
    						  padding-left:'.$params->get('horizontalpaddingdots', $defaults["horizontalpaddingdots"]).'px;';
    }
    elseif($params->get('horizontalaligndots', $defaults["horizontalaligndots"]) == "center")
    {
    	 $css_jssorn01 = 1;
    	 $css_add_jssorn01 .= 'padding-left:'.$params->get('horizontalpaddingdots', $defaults["horizontalpaddingdots"]).'px;
							   padding-right:'.$params->get('horizontalpaddingdots', $defaults["horizontalpaddingdots"]).'px;';        	 					
    }

    if($params->get('verticalaligndots', $defaults["verticalaligndots"]) == "bottom")
    {
    	$css_add_jssorn01 .= 'bottom:3%;
    						  padding-bottom:'.$params->get('verticalpaddingdots', $defaults["verticalpaddingdots"]).'px;';
    }
    elseif($params->get('verticalaligndots', $defaults["verticalaligndots"]) == "top")
    {
    	$css_add_jssorn01 .= 'top:3%;
    						  padding-top:'.$params->get('verticalpaddingdots', $defaults["verticalpaddingdots"]).'px;';
    }
    elseif($params->get('verticalaligndots', $defaults["verticalaligndots"]) == "center")
    {
    	 $css_jssorn01 = 2;
     	 $css_add_jssorn01 .= 'padding-bottom:'.$params->get('verticalpaddingdots', $defaults["verticalpaddingdots"]).'px;
								   padding-top:'.$params->get('verticalpaddingdots', $defaults["verticalpaddingdots"]).'px;';    
    }

    if($params->get('verticalaligndots', $defaults["verticalaligndots"]) == "center" && $params->get('horizontalaligndots', $defaults["horizontalaligndots"]) == "center")
    {
    	$css_jssorn01 = 3;
    }
    $css_add_jssorn01 .= '}';
}

$image_dots = ($params->get('navigationdots_media', $defaults['navigationdots_media']) == '')?JUri::root(true).'/modules/mod_jsshackslides/tmpl/images/'.$params->get('navigationarrows_customdots', $defaults['navigationarrows_customdots']).'.png':JUri::root(true).'/'.$params->get('navigationdots_media', $defaults['navigationdots_media']);
$image_arrow = ($params->get('navigationarrows_media', $defaults['navigationarrows_media']) == '')?JUri::root(true).'/modules/mod_jsshackslides/tmpl/images/'.$params->get('navigationarrows_customrows', $defaults['navigationarrows_customrows']).'.png':JUri::root(true).'/'.$params->get('navigationarrows_media', $defaults['navigationarrows_media']);

$style = '

	#'.$params->get('container', $defaults['container']).' .loading{
		position: absolute; 
		top: 0px; 
		left: 0px;
	}

	#'.$params->get('container', $defaults['container']).' .loading .filter{
		filter: alpha(opacity=70); 
		opacity:0.7; 
		background-color: #000; 
	}
	
	#'.$params->get('container', $defaults['container']).' .loading .loading_image{
		background: url('.JUri::root(true).'/modules/mod_jsshackslides/images/loading.gif) no-repeat center center;
	}

	#'.$params->get('container', $defaults['container']).' .loading .loading_image , #'.$params->get('container', $defaults['container']).' .loading .filter{
		position: absolute; 
		display: block;
        top: 0px; 
        left: 0px;
        width: 100%;
        height:100%;
	}

    /* Bullets of shackslides slider */
	/*
	.jssorn01 div           (normal)
	.jssorn01 div:hover     (normal mouseover)
	.jssorn01 .jssor_bulletsav           (active)
	.jssorn01 .jssor_bulletsav:hover     (active mouseover)
	.jssorn01 .jssor_bulletsdn           (mousedown)
	*/

	#'.$params->get('container', $defaults['container']).' .jssorn01{
		position: absolute;
	}

	#'.$params->get('container', $defaults['container']).' .jssorn01 div{
		position: inherit; 
		width: 21px; 
		height: 21px; 
		text-align:center;
	}
    #'.$params->get('container', $defaults['container']).' .jssorn01 div, #'.$params->get('container', $defaults['container']).' .jssorn01 div:hover, #'.$params->get('container', $defaults['container']).' .jssorn01 .jssor_bulletsav , #'.$params->get('container', $defaults['container']).' .jssorn01 .jssor_bulletsdn
    {
        background: url('.$image_dots.') no-repeat;
        overflow:hidden;
        cursor: pointer;
        opacity:'.($params->get('rangesliderdots', $defaults['rangesliderdots'])/100).';
        filter: alpha(opacity='.$params->get('rangesliderdots', $defaults['rangesliderdots']).');
    }
    #'.$params->get('container', $defaults['container']).' .jssorn01 div { background-position: -5px -4px; }
    #'.$params->get('container', $defaults['container']).' .jssorn01 div:hover, #'.$params->get('container', $defaults['container']).' .jssorn01 .jssor_bulletsav:hover { background-position: -35px -4px; }
    #'.$params->get('container', $defaults['container']).' .jssorn01 .jssor_bulletsav { background-position: -65px -4px; }
    #'.$params->get('container', $defaults['container']).' .jssorn01 .jssor_bulletsdn, #'.$params->get('container', $defaults['container']).' .jssorn01 .jssor_bulletsdn:hover { background-position: -95px -4px; }

	'.$css_add_jssorn01.'

	/* Left and Right arrows of shackslides slider */
    /*
    .jssord05l              (normal)
    .jssord05r              (normal)
    .jssord05l:hover        (normal mouseover)
    .jssord05r:hover        (normal mouseover)
    .jssord05ldn            (mousedown)
    .jssord05rdn            (mousedown)
    */   

    #'.$params->get('container', $defaults['container']).' span[class*=jssord05l]{
    	left: 8px;
	}

	#'.$params->get('container', $defaults['container']).' span[class*=jssord05r]{
    	right: 8px;
	}

    #'.$params->get('container', $defaults['container']).' .jssord05l, #'.$params->get('container', $defaults['container']).' .jssord05r, #'.$params->get('container', $defaults['container']).' .jssord05ldn, #'.$params->get('container', $defaults['container']).' .jssord05rdn
    {	
    	width: 40px;
    	height: 40px;
    	top: '.($params->get('height', $defaults['height']) / 2 - 20).'px;
    	position: absolute;
    	cursor: pointer;
    	display: block;
        background: url('.$image_arrow.') no-repeat;
        overflow:hidden;
        opacity:'.($params->get('rangesliderrows', $defaults['rangesliderrows'])/100).';
        filter: alpha(opacity='.$params->get('rangesliderrows', $defaults['rangesliderrows']).');
    }
    #'.$params->get('container', $defaults['container']).' .jssord05l { background-position: -10px -40px; }
    #'.$params->get('container', $defaults['container']).' .jssord05r { background-position: -70px -40px; }
    #'.$params->get('container', $defaults['container']).' .jssord05l:hover { background-position: -130px -40px; }
    #'.$params->get('container', $defaults['container']).' .jssord05r:hover { background-position: -190px -40px; }
    #'.$params->get('container', $defaults['container']).' .jssord05ldn { background-position: -250px -40px; }
    #'.$params->get('container', $defaults['container']).' .jssord05rdn { background-position: -310px -40px; }

';