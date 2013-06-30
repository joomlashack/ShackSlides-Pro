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

			/* On K2 version 2.6.x this call calls another class from an
				 implied object context (using $this), since the class is not really static that call
				 resolves to this class (JFormFieldK2Category). See coment on fetchElement() for more deatils. */
			return JFormFieldCategories::getInput();
		else :
			return JText::_('K2_NOT_INSTALLED');
		endif;
	}


	/*
			This function is just a placeholder to avoid the above call to getInput() to fail. Since K2 internally
			calls a K2ElementCategories object (not the class), we need to catch that call from an object context.
			After getting it, we just call again the correct class, again from a static context.
			In previous versions, this is not needed since JFormFieldCategores::getInput() calls everything statically.
	 */
	public function fetchElement($name, $value, &$element, $control) {

		return K2ElementCategories::fetchElement($name, $value, $element, $control);
	}

}
