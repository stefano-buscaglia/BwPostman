<?php
/**
 * BwPostman Newsletter Component
 *
 * BwPostman templates controller for backend.
 *
 * @version 1.2.4 bwpm
 * @package BwPostman-Admin
 * @author Romana Boldt
 * @copyright (C) 2012-2015 Boldt Webservice <forum@boldt-webservice.de>
 * @support http://www.boldt-webservice.de/forum/bwpostman.html
 * @license GNU/GPL, see LICENSE.txt
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die ('Restricted access');

// Import CONTROLLER object class
jimport('joomla.application.component.controlleradmin');

// Require helper class
require_once (JPATH_COMPONENT_ADMINISTRATOR.'/helpers/helper.php');

/**
 * BwPostman Templates Controller
 *
 * @package 	BwPostman-Admin
 * @subpackage 	Templates
 */
class BwPostmanControllerTemplates extends JControllerAdmin
{

	/**
	 * Constructor
	 *
	 * @param	array	$config	An optional associative array of configuration settings.
	 *
	 * @since	1.1.0
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		// Register Extra tasks
		$this->registerTask('addhtml', 'addhtml');
		$this->registerTask('addtext', 'addtext');
		$this->registerTask('apply', 'save');

	}

	/**
	 * Proxy for getModel.
	 *
	 * @param	string	$name	The name of the model.
	 * @param	string	$prefix	The prefix for the PHP class name.
	 *
	 * @return	JModel
	 * 
	 * @since	1.1.0
	 */
	public function getModel($name = 'Template', $prefix = 'BwPostmanModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}

	/**
	 * Display
	 *
	 * @since	1.1.0
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$jinput		= JFactory::getApplication()->input;
		$allowed	= FALSE;
		$user		= JFactory::getUser();
		
		// Show the layout depending on the task
		switch($this->getTask())
		{
			default:
					$jinput->set('hidemainmenu', 0);
					$jinput->set('view', 'templates');
				break;
		}
		parent::display();
	}

	/**
	 * Method to (un)publish a template
	 *
	 * @access	public
	 *
	 * @param	array template IDs
	 * @param	tinyint Task --> 1 = publish, 0 = unpublish
	 *
	 * @return	boolean
	 *
	 * @since	1.1.0
	 */
	public function publish()
	{
		$app	= JFactory::getApplication();
		$jinput	= JFactory::getApplication()->input;

		// Check for request forgeries
		if (!JSession::checkToken()) jexit(JText::_('JINVALID_TOKEN'));

		// Get the selected template(s)
		$cid = $jinput->get('cid', array(0), 'post', 'array');
		JArrayHelper::toInteger($cid);

		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		// count selected standard templates
		$query->select($db->quoteName('standard'));
		$query->from($db->quoteName('#__bwpostman_templates'));
		$query->where($db->quoteName('id')." IN (".implode(",", $cid).")");
		$query->where($db->quoteName('standard')." = ".$db->quote(1));

		$db->setQuery($query);
		$db->execute();
		$count_std = $db->getNumRows();

		// unpublish only, if no standard template is selected
		if ($count_std > 0 && $this->getTask() == 'unpublish') {
			$msg = $app->enqueueMessage(JText::_('COM_BWPOSTMAN_CANNOT_UNPUBLISH_STD_TPL'), 'error');
			$link = JRoute::_('index.php?option=com_bwpostman&view=templates',false);
			$this->setRedirect($link, $msg);
		}
		else {
			parent::publish();
		}
	}
}