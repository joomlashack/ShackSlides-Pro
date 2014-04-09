<?php
defined('_JEXEC') or die('Direct access to files is not permitted');
?>
  /*********************************************************************************************
		-	SET THE SCREEN SIZES FOR THE BANNER IF YOU WISH TO MAKE THE BANNER RESOPONSIVE 	-
  **********************************************************************************************/

  .bannercontainer {
		background-color:#fff;
		width:<?php echo $params->get('width', $defaults['width']); ?>px;
		position:relative;
		margin-left:auto;
		margin-right:auto;

	}

  .banner{
		width:<?php echo $params->get('width', $defaults['width']); ?>px;
		height:<?php echo $params->get('height', $defaults['height']); ?>px;
		position:relative;
		overflow:hidden;
   }


    .bannercontainer-simple {
		padding:0px;
		background-color:#fff;
		width:<?php echo $params->get('width', $defaults['width']); ?>px;
		position:relative;
		margin-left:auto;
		margin-right:auto;

	}

  .banner-simple{
		width:<?php echo $params->get('width', $defaults['width']); ?>px;
		height:<?php echo $params->get('height', $defaults['height']); ?>px;
		position:relative;
		overflow:hidden;
   }

 .fullwidthbanner-container{
	width:100% !important;
	position:relative;
	padding:0;
	min-height:500px !important;
	overflow:hidden;
}

.fullwidthbanner-container .fullwidthabnner	{
	width:100% !important;
	max-height:500px !important;
	position:relative;
}


#video_link img {
	max-width: 100%;
}

@media only screen and (min-width: 768px) and (max-width: 959px) {
 		  .banner, .bannercontainer			{	width:760px; height:395px;}
 		  #video_link  ,#video_frame			{	width:760px; height:395px;}
   }

   @media only screen and (min-width: 480px) and (max-width: 767px) {
		   .banner, .bannercontainer		{	width:480px; height:250px;	}
		   #video_link ,#video_frame			{	width:707px; height:396px;	}
		 /*  #video_link ,#video_frame			{	width:504px; height:282px;	} */
   }

   @media only screen and (min-width: 0px) and (max-width: 479px) {
			.banner, .bannercontainer		{	width:320px;height:166px;	}
			#video_link  ,#video_frame		{	width:360px;height:201px;	}
   }

.fb_iframe_widget iframe{
	z-index: 120;
}