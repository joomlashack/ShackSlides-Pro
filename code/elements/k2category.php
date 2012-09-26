<?php
/**
* @version   1.x
* @package   ShackSlides
* @copyright (C) 2010 Joomlashack / Meritage Assets Corp
* @license   GNU/GPL http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Direct access to files is not permitted');

class JElementK2Category extends JElement
{

	var	$_name = 'k2category';

	function fetchElement($name, $value, &$node, $control_name) {
		$k2_element_path = JPATH_SITE.'/administrator/components/com_k2/elements/categories.php';		
		
		if (file_exists($k2_element_path)) :
			include_once($k2_element_path);
			return JElementCategories::fetchElement($name, $value, $node, $control_name);
		else :
			return JText::_('K2_NOT_INSTALLED');
		endif;
		
	}
	
}
