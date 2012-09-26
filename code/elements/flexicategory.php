<?php
/**
* @version   1.x
* @package   ShackSlides
* @copyright (C) 2010 Joomlashack / Meritage Assets Corp
* @license   GNU/GPL http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Direct access to files is not permitted');

class JElementFlexiCategory extends JElement
{

	var	$_name = 'flexicategory';

	function fetchElement($name, $value, &$node, $control_name) {
		$flexi_path = JPATH_SITE.'/components/com_flexicontent/classes/flexicontent.categories.php';		
		
		if (!file_exists($flexi_path)) :
			return JText::_('FLEXI_NOT_INSTALLED');
		endif;
		
		include_once($flexi_path);
		jimport('joomla.applications.component.helper');
		$params =& JComponentHelper::getParams('com_flexicontent');
		$flexi_section = $params->get('flexi_section');
		
		if (!$flexi_section) :
			return JText::_('FLEXI_NOT_CONFIGURED');
		endif;
		
		$db = JFactory::getDBO();
		
		#$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir.', c.ordering';
		
		$where = array();
		$where[] = 'c.section = ' . $flexi_section;
		$where[] = 'c.published = 1';
		$where 		= ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );
		
		$query = 'SELECT c.*, u.name AS editor, g.name AS groupname'
					. ' FROM #__categories AS c'
					. ' LEFT JOIN #__groups AS g ON g.id = c.access'
					. ' LEFT JOIN #__users AS u ON u.id = c.checked_out'
					. $where
					#. $orderby
					;
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
				
		//establish the hierarchy of the categories
		$children = array();
		
    	//set depth limit
   		$levellimit = 10;
		
   		if ($rows) :
	    	foreach ($rows as $child) {
    	    	$parent = $child->parent_id;
       			$list 	= @$children[$parent] ? $children[$parent] : array();
        		array_push($list, $child);
        		$children[$parent] = $list;
    		}
    	endif;
    	
    	//get list of the items
    	$list = flexicontent_cats::treerecurse(0, '', array(), $children, true, max(0, $levellimit-1));
		
		$mitems [] = JHTML::_ ( 'select.option', '0', '- ' . JText::_ ( 'None' ) . ' -' );

		if ($list) :
			foreach ( $list as $item ) {
				$mitems[] = JHTML::_('select.option',  $item->id, '&nbsp;&nbsp;&nbsp;'.$item->treename );
			}
		endif;
    	
		return JHTML::_('select.genericlist',  $mitems, ''.$control_name.'['.$name.'][]', 'class="inputbox"', 'value', 'text', $value );
		
	}
	
}
