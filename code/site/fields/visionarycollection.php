<?php
/**
* @version   1.x
* @package   ShackSlides
* @copyright (C) 2010 Joomlashack / Meritage Assets Corp
* @license   GNU/GPL http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldVisionaryCollection extends JFormFieldList
{
	public $type = 'VisionaryCollection';

	protected function getInput() 
	{
		$visionary_component_path = JPATH_SITE.'/administrator/components/com_jsvisionary/jsvisionary.php';

		if (file_exists($visionary_component_path)) 
		{
			return parent::getInput();
		}

		else 
		{
			$doc = JFactory::getDocument();
			$doc->addStyleSheet(JURI::root() . 'modules/mod_jsshackslides/assets/admin.css');
			return '<div class="shackslides-not-installed">' . JText::_('VISIONARY_NOT_INSTALLED') . '</div>';
		}

	}

	protected function getOptions() 
	{

		// Initialize variables
		$options = array();
		$query = 'SELECT jsvisionary_collection_id as id, title AS collection FROM `#__jsvisionary_collections` WHERE enabled = 1';

		// Get the database object.
		$db = JFactory::getDBO();

		// Set the query and get the result list.
		$db->setQuery($query);
		$items = $db->loadObjectlist();

		// Check for an error.
		if ($db->getErrorNum())
		{
			JError::raiseWarning(500, $db->getErrorMsg());
			return $options;
		}


		if (!empty($items)) 
		{
			foreach($items as $item) 
			{
				$options []= JHtml::_('select.option', $item->id, $item->collection);
			}

		} 
		else 
		{
			$options []= JHtml::_('select.option', "None" , JText::_('VISIONARY_NO_COLLECTIONS'));
		}

		return $options;


	}


}
