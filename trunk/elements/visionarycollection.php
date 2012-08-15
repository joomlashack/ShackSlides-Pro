<?php
/**
* @version   1.x
* @package   ShackSlides
* @copyright (C) 2010 Joomlashack / Meritage Assets Corp
* @license   GNU/GPL http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Direct access to files is not permitted');

class JElementVisionaryCollection extends JElement
{

	var	$_name = 'visionarycollection';

	function fetchElement($name, $value, &$node, $control_name) {
		$visionary_component_path = JPATH_SITE.'/administrator/components/com_jsvisionary/jsvisionary.php';
		
		
		if (file_exists($visionary_component_path)) {

			$db = JFactory::getDbo();
			$query = 'SELECT id, name AS collection FROM `#__jsvisionary_jsssslider` WHERE published = 1';
			$db->setQuery($query);
			$key = 'id';
			$val = 'collection';

			$options = $db->loadObjectlist();

			// Check for an error.
			if ($db->getErrorNum()) {
				JError::raiseWarning(500, $db->getErrorMsg());
				return false;
			}

			if (!$options) {
				$options = array();
			}

			return JHtml::_(
					'select.genericlist',
					$options,
					$control_name . '[' . $name . ']',
					array(
						'id' => $control_name . $name,
						'list.attr' => 'class="inputbox"',
						'list.select' => $value,
						'option.key' => $key,
						'option.text' => $val
					)
				);

		}

		else {
			return JText::_('VISIONARY_NOT_INSTALLED');
		}

		
	}
	
}
