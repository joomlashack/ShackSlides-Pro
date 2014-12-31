<?php
/**
 * @package     Shackslides
 * @subpackage  Module
 *
 * @copyright   Copyright (C) 2010 - 2015 Joomlashack. Meritage Assets.  All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Restrict Access to within Joomla
defined('_JEXEC') or die('Restricted access');

require_once dirname(__FILE__) . '/helpers/' . $params->get('source', 'folder') . '.php';

$helperClass = 'ModShackSlides' . ucfirst($params->get('source', 'folder')) . 'Helper';
$helper = new $helperClass($params);

$images = $helper->getImages();
$links = $helper->getLinks();
$titles = $helper->getTitles();
$contents = $helper->getContents();
$base = $helper->getBase();

require JModuleHelper::getLayoutPath('mod_jsshackslides');
