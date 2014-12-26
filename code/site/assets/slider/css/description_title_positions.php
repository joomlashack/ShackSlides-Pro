<?php
defined('_JEXEC') or die('Direct access to files is not permitted');
?>

<script type="text/javascript">

function settingsPosition(position){
	jQuery(document).ready(function ($) {
	var shackDescTitleContainer = jQuery(".shackslides-titledescription-container");		
	if(position == "top") {
		shackDescTitleContainer.each(function() {
			jQuery(this).children(".shackslideDescription").css("top" , jQuery(this).children(".shackslideTitle").height()+"px")
		});
	} else if (position == "bottom"){
		shackDescTitleContainer.each(function() {
			jQuery(this).children(".shackslideTitle").css("bottom" , jQuery(this).children(".shackslideDescription").height()+"px")
		});
	} else if (position == "right" || position == "left") {
		shackDescTitleContainer.each(function() {
			if(jQuery(this).children(".shackslideDescription").length == 0){
				jQuery(this).children(".shackslideTitle").css("height" , "100%");
			}
		});
	}
	});
}
</script>

<?php
$shackslideTitleCSS = '#'.$params->get('container', $defaults['container']).' .shackslideTitle';
$shackslideDescriptionCSS = '#'.$params->get('container', $defaults['container']).' .shackslideDescription';

$style = '';
if($params->get('slidedescription_position', $defaults['slidedescription_position']) == "0") //top
{
	$style .=  $shackslideTitleCSS.','.$shackslideDescriptionCSS .'{
					width:100%;
					text-align:'.$params->get('slidedescription_alignment', $defaults['slidedescription_alignment']).';
				}
				'. $shackslideTitleCSS .'{
					top:0px;
				}
				';
?>
	<script type="text/javascript">
		settingsPosition("top");
	</script>
<?php
}
elseif($params->get('slidedescription_position', $defaults['slidedescription_position']) == "1") //bottom
{
	$style .= $shackslideTitleCSS.','.$shackslideDescriptionCSS .'{
					width:100%;
					text-align:'.$params->get('slidedescription_alignment', $defaults['slidedescription_alignment']).';
					bottom:0px;
				}
				';
?>
	<script type="text/javascript">
		settingsPosition("bottom");
	</script>
<?php
}
elseif($params->get('slidedescription_position', $defaults['slidedescription_position']) == "2") //right
{
	$style .= $shackslideTitleCSS.','.$shackslideDescriptionCSS .'{
					right:0px;
					height:50%;
					width: 25%;
					text-align:'.$params->get('slidedescription_alignment', $defaults['slidedescription_alignment']).';
				}
				'. $shackslideDescriptionCSS .'{
					bottom:0px;
				}
				';
?>
	<script type="text/javascript">
		settingsPosition("right");
	</script>
<?php
}
elseif($params->get('slidedescription_position', $defaults['slidedescription_position']) == "3") //left
{
	$style .= $shackslideTitleCSS.','.$shackslideDescriptionCSS .'{
					left:0px;
					height:50%;
					width: 25%;
					text-align:'.$params->get('slidedescription_alignment', $defaults['slidedescription_alignment']).';
				}
				'. $shackslideDescriptionCSS .'{
					bottom:0px;
				}
				';
?>
	<script type="text/javascript">
		settingsPosition("left");
	</script>
<?php
}
?>