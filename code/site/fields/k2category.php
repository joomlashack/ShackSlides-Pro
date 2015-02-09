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

class JFormFieldK2category extends JFormFieldList
{
	public $type = 'K2category';

	protected function getInput()
	{
		$k2_element_path = JPATH_SITE.'/administrator/components/com_k2/elements/categories.php';

		if (file_exists($k2_element_path)) :
			include_once($k2_element_path);

			return parent::getInput();

		else :
			$doc = JFactory::getDocument();
			$doc->addStyleSheet(JURI::root() . 'media/mod_jsshackslides/css/admin.css');
			return '<div class="shackslides-not-installed">' . JText::_('K2_NOT_INSTALLED') . '</div>';
		endif;
	}


	protected function getOptions() {

		// Initialize variables
		$options = array();
		$query = 'SELECT id,name FROM `#__k2_categories` WHERE published = 1';

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


		if (!empty($items)) {

			foreach($items as $item) {

				$options []= JHtml::_('select.option', $item->id, $item->name);
			}

		}

		return $options;


	}

}
