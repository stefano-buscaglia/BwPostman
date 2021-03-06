<?php
/**
 * BwPostman Newsletter Component
 *
 * BwPostman newsletter all model for frontend.
 *
 * @version 2.0.0 bwpm
 * @package BwPostman-Site
 * @author Romana Boldt
 * @copyright (C) 2012-2017 Boldt Webservice <forum@boldt-webservice.de>
 * @support https://www.boldt-webservice.de/en/forum-en/bwpostman.html
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

use Joomla\Registry\Registry as JRegistry;

// Import MODEL object class
jimport('joomla.application.component.modellist');
jimport('joomla.application.component.helper');

/**
 * Class BwPostmanModelNewsletters
 *
 * @since       0.9.1
 */
class BwPostmanModelNewsletters extends JModelList
{

	/**
	 * property to hold context
	 *
	 * @var string  $_context
	 *
	 * @since       0.9.1
	 */
	public $_context = 'com_bwpostman.newsletters';

	/**
	 * property to hold extension name
	 *
	 * @var string
	 *
	 * @since       0.9.1
	 */
	protected $_extension = 'com_bwpostman';

	/**
	 * property to hold newsletters
	 *
	 * @var array
	 *
	 * @since       0.9.1
	 */
	protected $_newsletters = null;

	/**
	 * Newsletter id
	 *
	 * @var integer
	 *
	 * @since       0.9.1
	 */
	var $_id = null;

	/**
	 * Newsletter data
	 *
	 * @var array
	 *
	 * @since       0.9.1
	 */
	var $_data = null;

	/**
	 * Number of all Newsletters which are shown
	 *
	 * @var int
	 *
	 * @since       0.9.1
	 */
	var $_total = null;

	/**
	 * Pagination object
	 *
	 * @var object
	 *
	 * @since       0.9.1
	 */
	var $_pagination = null;

	/**
	 * Newsletter filter
	 *
	 * @var string
	 *
	 * @since       0.9.1
	 */
	var $_filter = null;

	/**
	 * Constructor
	 *
	 * @since       0.9.1
	 */
	public function __construct()
	{
		parent::__construct();

		$jinput	= JFactory::getApplication()->input;

		$id = $jinput->get('id');
		$this->setId((int)$id);

		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'a.subject', 'subject',
				'a.mailing_date', 'mailing_date',
				'a.id', 'id',
				'a.id', 'id',
				'a.mailinglist', 'mailinglist',
				'a.published, published',
				'a.archive_date, archive_date',
				'access','access_level',
				'language',
				'a.hits', 'hits',
				'a.ordering, ordering'
			);
		}
		parent::__construct($config);
	}

	/**
	 * Returns a Table object, always creating it.
	 *
	 * @param	string  $type	    The table type to instantiate
	 * @param	string	$prefix     A prefix for the table class name. Optional.
	 * @param	array	$config     Configuration array for model. Optional.
	 *
	 * @return	JTable	A database object
	 *
	 * @since  1.0.1
	*/
	public function getTable($type = 'Newsletters', $prefix = 'BwPostmanTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param string    $ordering
	 * @param string    $direction
	 *
	 * @since	1.0.1
	 */
	protected function populateState($ordering = NULL, $direction = NULL)
	{
		// Initialize variables.
		$app	= JFactory::getApplication('site');
		$jinput	= $app->input;
		$pk		= $jinput->getInt('id');

		// Load state from the request.
		$this->setState('newsletter.id', $pk);

		// Load the parameters. Merge Global and Menu Item params into new object
		$params     = JComponentHelper::getParams($this->_extension);
		$menuParams = new JRegistry;
		$menu       = $app->getMenu()->getActive();

		if ($menu)
		{
			$menuParams->loadString($menu->params);
		}

		$mergedParams = clone $menuParams;
		$mergedParams->merge($params);

		$this->setState('params', $mergedParams);
		$app->setUserState('com_bwpostman.newsletters.params', $mergedParams);

		// Set module ID
		$this->setState('module.id', $app->input->getInt('mid'));

		// Filter on month, year
		$this->setState('filter.month', $app->input->getInt('month'));
		$this->setState('filter.year', $app->input->getInt('year'));

		// Optional filter text
		$this->setState('filter.search', $jinput->getString('filter_search'));

		$mailinglist = $this->getUserStateFromRequest('com_bwpostman.newsletters.filter.mailinglist', 'filter_mailinglist', '');
		$this->setState('filter.mailinglist', $mailinglist);

		$campaign = $this->getUserStateFromRequest('com_bwpostman.newsletters.filter.campaign', 'filter_campaign', '');
		$this->setState('filter.campaign', $campaign);

		$usergroup = $this->getUserStateFromRequest('com_bwpostman.newsletters.filter.usergroup', 'filter_usergroup', '');
		$this->setState('filter.usergroup', $usergroup);

		// filter.order
		$orderCol	= $app->getUserStateFromRequest('com_bwpostman.newsletters.filter_order', 'filter_order', 'mailing_date', 'string');
		$this->setState('list.ordering', $orderCol);

		$listOrder = $app->getUserStateFromRequest('com_bwpostman.newsletters.list.filter_order_Dir', 'filter_order_Dir', 'DESC', 'cmd');
		if (!in_array(strtoupper($listOrder), array('ASC', 'DESC', ''))) {
			$listOrder = 'DESC';
		}
		$this->setState('list.direction', $listOrder);

		$this->setState('layout', JFactory::getApplication()->input->getCmd('layout'));

		$limit = (int) $app->getUserStateFromRequest('com_bwpostman.newsletters.list.limit', 'limit', $params->get('display_num'), 'uint');
		$this->setState('list.limit', $limit);

		$limitstart = $app->input->get->get->get('start');
		if ($limitstart === NULL) $limitstart = $app->input->get->get->get('limitstart');
		$this->setState('list.start', $limitstart);
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string		$id	A prefix for the store id.
	 *
	 * @return	string		A store id.

	 * @since	1.0.1
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . serialize($this->getState('filter.published'));
		$id .= ':' . $this->getState('filter.access');
		$id .= ':' . $this->getState('filter.subject');
		$id .= ':' . $this->getState('filter.mailing_date');
		$id .= ':' . $this->getState('filter.hits');
		$id	.= ':' . $this->getState('filter.mailinglist');
		$id	.= ':' . $this->getState('filter.campaign');
		$id	.= ':' . $this->getState('filter.usergroup');
		$id	.= ':' . $this->getState('getTotal');

		return parent::getStoreId($id);
	}

	/**
	 * Method to reset the newsletter ID and newsletter data
	 *
	 * @access	public
	 *
	 * @param	int	$id     Newsletter ID
	 *
	 * @since       0.9.1
	 */
	public function setId($id = 0)
	{
		// Set new venue ID and wipe data
		$this->_id 		= $id;
		$this->_data 	= null;
	}

	/**
	 * Returns a record count for the query.
	 * Override because fast COUNT version will result in wrong number
	 *
	 * @param	JDatabaseQuery|string  $query  The query.
	 *
	 * @return	integer  Number of rows for query.
	 *
	 * @since	1.2.0
	 */
	protected function _getListCount($query)
	{
		// fall back to inefficient way of counting all results.
		$result = 0;

		// Remove the limit and offset part if it's a JDatabaseQuery object
		if ($query instanceof JDatabaseQuery)
		{
			$query = clone $query;
			$query->clear('limit')->clear('offset');
		}

		try
		{
			$this->_db->setQuery($query);
			$this->_db->execute();
			$result = $this->_db->getNumRows();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		return $result;
	}

	/**
	 * Method to get a list of newsletters.
	 *
	 * Overridden to inject convert the attributes field into a JParameter object.
	 *
	 * @return	mixed	An array of objects on success, false on failure.
	 *
	 * @since	1.0.1
	 */
	public function getItems()
	{
		$items	= parent::getItems();
		$user	= JFactory::getUser();
		$userId	= $user->get('id');
		$guest	= $user->get('guest');
		$groups	= $user->getAuthorisedViewLevels();

		$this->_pagination = parent::getPagination();

		// Convert the parameter fields into objects.
		foreach ($items as &$item)
		{
			$item->params = clone $this->getState('params');

			// Get display date
			switch ($item->params->get('list_show_date'))
			{
				case 'modified_time':
					$item->displayDate = $item->modified_time;
					break;

				case 'published':
					$item->displayDate = ($item->publish_up == 0) ? $item->created_date : $item->publish_up;
					break;

				case 'created_date':
					$item->displayDate = $item->created_date;
					break;

				default:
				case 'mailing_date':
					$item->displayDate = $item->mailing_date;
					break;
			}

			// Compute the asset access permissions.
			// Technically guest could edit an newsletter, but lets not check that to improve performance a little.
			if (!$guest)
			{
				$asset = 'com_bwpostman.newsletter.' . $item->id;

				// Check general edit permission first.
				if ($user->authorise('bwpm.edit', $asset))
				{
					$item->params->set('access-edit', true);
				}

				// Now check if edit.own is available.
				elseif (!empty($userId) && $user->authorise('bwpm.edit.own', $asset))
				{
					// Check for a valid user and that they are the owner.
					if ($userId == $item->created_by)
					{
						$item->params->set('access-edit', true);
					}
				}
			}

			$access = $this->getState('filter.access');

			if ($access)
			{
				// If the access filter has been set, we already have only the newsletters this user can view.
				$item->params->set('access-view', true);
			}
			else
			{
				// If no access filter is set, the layout takes some responsibility for display of limited information.
				$item->params->set('access-view', in_array($item->access, $groups));
			}

			// Get the tags
			$item->tags = new JHelperTags;
			$item->tags->getItemTags('com_bwpostman.newsletter', $item->id);
		}

		return $items;
	}

	/**
	 * Method to build the MySQL query
	 *
	 * @access public?
	 * @return string Query
	 * @since	1.0.1
	 */
	protected function getListQuery()
	{
		// define variables
		$_db		= $this->_db;
		$query		= $_db->getQuery(true);

		// Define null and now dates, get params
		$nullDate	= $_db->quote($_db->getNullDate());
		$nowDate	= $_db->quote(JFactory::getDate()->toSql());
		$params		= $this->state->params;
		$menuId		= $params->get('menu_item');
		$mod_id		= $this->getState('module.id');

		if (empty($menuId) && !empty($mod_id))
		{
			$module = $this->_getModuleById($mod_id);
			$params	= new JRegistry($module->params);
		}

		// get accessible mailing lists
		$mls	= $this->getAccessibleMailinglists('false');

		$groups	= $this->getAccessibleUsergroups('false');

		if (count($groups) > 0)
		{
			// merge mailinglists and usergroups and remove multiple values
			$mls	= array_merge($mls, $groups);
			$mls	= array_unique($mls);
		}

		// get accessible campaigns
		$cams	= $this->getAccessibleCampaigns('false');


		// Filter by mailing list
		$mailinglist = $this->getState('filter.mailinglist');

		if ($mailinglist)
		{
			$filter_mls	= array();

			$filter_mls[]	= $mls[array_search($mailinglist, $mls)];
			$mls			= $filter_mls;
			$cams			= array(0 => 0);
			$this->setState('filter.campaign', '');
			$this->setState('filter.usergroup', '');
		}

		// Filter by user group
		$usergroup = $this->getState('filter.usergroup');

		if ($usergroup)
		{
			$filter_mls	= array();

			$filter_mls[]	= $mls[array_search($usergroup, $mls)];
			$mls			= $filter_mls;
			$cams			= array(0 => 0);
			$this->setState('filter.campaign', '');
			$this->setState('filter.mailinglist', '');
		}

		// Filter by campaign
		$campaign = $this->getState('filter.campaign');

		if ($campaign)
		{
			$filter_cam	= array();

			$filter_cam[]	= $cams[array_search($campaign, $cams)];
			$cams			= $filter_cam;
			$mls			= array(0 => 0);
			$this->setState('filter.usergroup', '');
			$this->setState('filter.mailinglist', '');
		}

		// build query
		$query->select(
			$this->getState(
				'list.select',
				'DISTINCT(a.id), a.subject, a.mailing_date, a.hits, a.campaign_id, a.access, a.created_date, a.attachment, ' .
				// Use mailing date if publish_up is 0
				'CASE WHEN a.publish_up = ' . $nullDate . ' THEN a.mailing_date ELSE a.publish_up END as publish_up,' .
				'publish_down'
				)
		);

		$query->from($_db->quoteName('#__bwpostman_newsletters') . ' AS ' . $_db->quoteName('a'));
		// in front end only sent and published newsletters are shown!
		$query->where($_db->quoteName('a') . '.' . $_db->quoteName('published') . ' = ' . (int) 1);
		$query->where($_db->quoteName('a') . '.' . $_db->quoteName('mailing_date') . ' != ' . $_db->quote('0000-00-00 00:00:00'));

		// Filter by mailing lists, user groups and campaigns
		$query->leftJoin('#__bwpostman_newsletters_mailinglists AS m ON a.id = m.newsletter_id');
		$query->where('(m.mailinglist_id IN (' . implode(',', $mls) . ') OR a.campaign_id IN (' . implode(',', $cams) . '))');

		switch ($params->get('show_type', 'not_arc_down'))
		{
			default:
			case 'all_not_arc':
					$query->where('a.archive_flag = 0');
				break;
			case 'not_arc_down':
					$query->where('a.archive_flag = 0');
					$query->where('a.publish_up <= ' . $nowDate);
					$query->where('(a.publish_down >= ' . $nowDate . ' OR a.publish_down = ' . $nullDate . ')');
				break;
			case 'not_arc_but_down':
					$query->where('a.archive_flag = 0');
					$query->where('a.publish_up <= ' . $nowDate);
					$query->where('a.publish_down <> ' . $nullDate);
					$query->where('a.publish_down <= ' . $nowDate);
				break;
			case 'arc':
					$query->where('a.archive_flag = 1');
				break;
			case 'down':
					$query->where('a.publish_up <= ' . $nowDate);
					$query->where('a.publish_down <> ' . $nullDate);
					$query->where('a.publish_down <= ' . $nowDate);
				break;
			case 'arc_and_down':
					$query->where('a.archive_flag = 1');
					$query->where('a.publish_up <= ' . $nowDate);
					$query->where('a.publish_down <> ' . $nullDate);
					$query->where('a.publish_down <= ' . $nowDate);
				break;
			case 'arc_or_down':
					$query->where('(a.archive_flag = 1
							OR (
									a.publish_down <> ' . $nullDate . '
								AND a.publish_down <= ' . $nowDate . '
								AND a.publish_up <= ' . $nowDate . '
							))');
				break;
			case 'all':
				break;
		}

		// Filter by search word.
		$searchword	= $this->getState('filter.search');
		if (is_object($params) && ($params->get('filter_field') != 'hide') && !empty($searchword))
		{
			$search	= '%' . $_db->escape($this->getState('filter.search'), true) . '%';
			$query->where('subject LIKE ' . $_db->quote($search, false));
		}

		// Filter on month
		$month = $this->getState('filter.month');
		if ($month)
		{
			$query->where($query->month('a.mailing_date') . ' = ' . $month);
		}

		// Filter on year
		$year = $this->getState('filter.year');
		if ($year)
		{
			$query->where($query->year('a.mailing_date') . ' = ' . $year);
		}

		// Set the list limit
		$limit	= (int) $params->get('display_num', '10');
		$limit	= $this->getState('filter.limit', $limit);
		$this->setState('filter.limit', $limit);
//		$query->setLimit($_db->escape($limit));

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'a.mailing_date');
		$orderDirn	= $this->state->get('list.direction', 'DESC');
		$query->order($_db->escape($orderCol.' '.$orderDirn));
		$query->group($_db->quoteName('a.mailing_date'));

		$_db->setQuery($query);

		return $query;
	}

	/**
	 * Method to get all published mailing lists which the user is authorized to see
	 *
	 * @access 	public
	 *
	 * @return 	array	ID and title of allowed mailinglists
	 *
	 * @since	1.0.1
	 */
	public function getAllowedMailinglists()
	{
		$user 		    = JFactory::getUser();
		$mailinglists   = null;
		$_db		    = $this->_db;
		$query		    = $_db->getQuery(true);

		// get authorized viewlevels
		$accesslevels	= JAccess::getAuthorisedViewLevels($user->id);

		$query->select('id');
		$query->from($_db->quoteName('#__bwpostman_mailinglists'));
		$query->where($_db->quoteName('access') . ' IN (' . implode(',', $accesslevels) . ')');
		$query->where($_db->quoteName('published') . ' = ' . (int) 1);

		try
		{
			$this->_db->setQuery($query);
			$mailinglists = $_db->loadAssocList();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		$allowed	= array();
		foreach ($mailinglists as $item) {
			$allowed[]	= $item['id'];
		}
		return $allowed;
	}

	/**
	 * Method to get all published mailing lists which the user is authorized to see and which are selected in menu
	 *
	 * @access 	public
	 *
	 * @param	boolean	$title          with title
	 *
	 * @return 	array	$mailinglists   ID and title of allowed mailinglists
	 *
	 * @since	1.2.0
	 */
	public function getAccessibleMailinglists($title = true)
	{
		$_db		    = $this->_db;
		$query		    = $_db->getQuery(true);
		$params		    = $this->state->params;
		$menuId		    = $params->get('menu_item');
		$mod_id		    = $this->getState('module.id');
		$res_mls        = null;
		$acc_levels     = null;
		$mailinglists   = null;

		if (empty($menuId) && !empty($mod_id))
		{
			$module = $this->_getModuleById($mod_id);
			$params	= new JRegistry($module->params);
		}

		$check		= $params->get('access-check');

		// fetch only from mailing lists, which are selected, if so
		$all_mls	= $params->get('ml_selected_all');
		$sel_mls	= $params->get('ml_available');

		if ($all_mls)
		{
			$query->select('id');
			$query->from($_db->quoteName('#__bwpostman_mailinglists'));
			$query->where($_db->quoteName('published') . ' = ' . (int) 1);

			try
			{
				$this->_db->setQuery($query);
				$res_mls	= $_db->loadAssocList();
			}
			catch (RuntimeException $e)
			{
				JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
			}

			$mls		= array();
			if (count($res_mls) > 0) {
				foreach ($res_mls as $item) {
					$mls[]	= $item['id'];
				}
			}
		}
		else
		{
			$mls	= $sel_mls;
		}

		// if no mls is left, make array
		if (count($mls) == 0) $mls[]	= 0;

		// Check permission, if desired
		if ($all_mls || $check != 'no')
		{
			// get authorized viewlevels
			$accesslevels	= JAccess::getAuthorisedViewLevels(JFactory::getUser()->id);
			if (count($accesslevels) > 0)
			{
				foreach ($accesslevels as $key => $value) {
					$acc_levels[]	= $key;
				}
			}
			else
			{
				$acc_levels[]	= 0;
			}

			$query	= $_db->getQuery(true);

			$query->select('id');
			$query->from($_db->quoteName('#__bwpostman_mailinglists'));
			$query->where($_db->quoteName('access') . ' IN (' . implode(',', $acc_levels) . ')');
			$query->where($_db->quoteName('published') . ' = ' . (int) 1);

			try
			{
				$this->_db->setQuery($query);
				$res_mls	= $_db->loadAssocList();
			}
			catch (RuntimeException $e)
			{
				JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
			}

			$acc_mls	= array(0);
			foreach ($res_mls as $item)
			{
				$acc_mls[]	= $item['id'];
			}

			$mls	= array_intersect($mls, $acc_mls);
		}

		if ($title === true)
		{
			$query	= $_db->getQuery(true);
			$query->select('id');
			$query->select('title');
			$query->from($_db->quoteName('#__bwpostman_mailinglists'));
			$query->where($_db->quoteName('id') . ' IN (' . implode(',', $mls) . ')');

			try
			{
				$this->_db->setQuery($query);
				$mailinglists	= $_db->loadAssocList();
			}
			catch (RuntimeException $e)
			{
				JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
			}
		}
		else
		{
			$mailinglists	= $mls;
		}
		return $mailinglists;
	}

	/**
	 * Method to get all campaigns which the user is authorized to see
	 *
	 * @access 	public
	 *
	 * @param	boolean	$title      with title
	 *
	 * @return 	array	$campaigns  ID of allowed campaigns
	 *
	 * @since	1.2.0
	 */
	public function getAccessibleCampaigns($title = true)
	{
		$_db		= $this->_db;
		$query		= $_db->getQuery(true);
		$params		= $this->state->params;
		$menuId		= $params->get('menu_item');
		$mod_id		= $this->getState('module.id');
		$res_cams   = null;
		$res_mls    = null;
		$acc_levels = null;
		$acc_cams   = null;
		$campaigns  = null;

		if (empty($menuId) && !empty($mod_id))
		{
			$module = $this->_getModuleById($mod_id);
			$params	= new JRegistry($module->params);
		}

		$check		= $params->get('access-check');

		// fetch only from campaigns, which are selected, if so
		$all_cams	= $params->get('cam_selected_all');
		$sel_cams	= $params->get('cam_available');

		if ($all_cams)
		{
			$query->select('c.id');
			$query->from('#__bwpostman_campaigns AS c');
			try
			{
				$this->_db->setQuery($query);
				$res_cams	= $_db->loadAssocList();
			}
			catch (RuntimeException $e)
			{
				JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
			}
			$cams		= array();
			if (count($res_cams) > 0) {
				foreach ($res_cams as $item) {
					$cams[]	= $item['id'];
				}
			}
		}
		else
		{
			$cams	= $sel_cams;
		}
		// if no cam is left, make array
		if (count($cams) == 0) $cams[]	= 0;

		// Check permission, if desired
		if ($all_cams || $check != 'no')
		{
			// get authorized viewlevels
			$accesslevels	= JAccess::getAuthorisedViewLevels(JFactory::getUser()->id);
			if (count($accesslevels) > 0)
			{
				foreach ($accesslevels as $key => $value)
				{
					$acc_levels[]	= $key;
				}
			}
			else
			{
				$acc_levels[]	= 0;
			}

			$query	= $_db->getQuery(true);
			$query->select('id');
			$query->from($_db->quoteName('#__bwpostman_mailinglists'));
			$query->where($_db->quoteName('access') . ' IN (' . implode(',', $acc_levels) . ')');
			$query->where($_db->quoteName('published') . ' = ' . (int) 1);

			try
			{
				$this->_db->setQuery($query);
				$res_mls	= $_db->loadAssocList();
			}
			catch (RuntimeException $e)
			{
				JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
			}

			$acc_mls	= array(0);
			foreach ($res_mls as $item)
			{
				$acc_mls[]	= $item['id'];
			}

			$query		= $_db->getQuery(true);

			$query->select('DISTINCT (' . $_db->quoteName('campaign_id') . ')');
			$query->from($_db->quoteName('#__bwpostman_campaigns_mailinglists'));
			$query->where($_db->quoteName('mailinglist_id') . ' IN (' . implode(',', $acc_mls) . ')');
			$query->where($_db->quoteName('campaign_id') . ' IN (' . implode(',', $cams) . ')');

			try
			{
				$this->_db->setQuery($query);
				$acc_cams	= $_db->loadAssocList();
			}
			catch (RuntimeException $e)
			{
				JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
			}
			if (count($acc_cams) > 0)
			{
				$cams		= array();
				foreach ($acc_cams as $item)
				{
					$cams[]	= $item['campaign_id'];
				}
			}
		}
		// if no cam is left, make array to return
		if (count($cams) == 0) $cams[]	= 0;

		if ($title === true)
		{
			$query	= $_db->getQuery(true);
			$query->select('id');
			$query->select('title');
			$query->from($_db->quoteName('#__bwpostman_campaigns'));
			$query->where($_db->quoteName('id') . ' IN (' . implode(',', $cams) . ')');

			try
			{
				$this->_db->setQuery($query);
				$campaigns	= $_db->loadAssocList();
			}
			catch (RuntimeException $e)
			{
				JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
			}
		}
		else
		{
			$campaigns	= $cams;
		}
		return $campaigns;
	}

	/**
	 * Method to get all user groups which the user is authorized to see
	 *
	 * @access 	public
	 *
	 * @param	boolean	$title      with title
	 *
	 * @return 	array	$groups     ID of allowed campaigns
	 *
	 * @since	1.2.0
	 */
	public function getAccessibleUsergroups($title = true)
	{
		$_db		= $this->_db;
		$query		= $_db->getQuery(true);
		$params		= $this->state->params;
		$menuId		= $params->get('menu_item');
		$mod_id		= $this->getState('module.id');
		$res_groups = null;
		$groups     = null;

		if (empty($menuId) && !empty($mod_id))
		{
			$module = $this->_getModuleById($mod_id);
			$params	= new JRegistry($module->params);
		}

		$check		= $params->get('access-check');

		// fetch only from usergroups, which are selected, if so
		$all_groups	= $params->get('groups_selected_all');
		$sel_groups	= $params->get('groups_available');

		if ($all_groups)
		{
			$query->select('u.id');
			$query->from('#__usergroups AS u');
			try
			{
				$this->_db->setQuery($query);
				$res_groups	= $_db->loadAssocList();
			}
			catch (RuntimeException $e)
			{
				JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
			}
			$groups		= array();
			if (count($res_groups) > 0)
			{
				foreach ($res_groups as $item) {
					$groups[]	= $item['id'];
				}
			}
			else
			{
				$groups[]	= 0;
			}
			//convert usergroups to match bwPostman's needs
			$c_groups	= array();
			if (count($groups) > 0)
			{
				foreach ($groups as $value) {
					$c_groups[]	= '-' . $value;
				}
			}
			else
			{
				$c_groups[]	= 0;
			}
		}
		else
		{
			$c_groups	= $sel_groups;
		}
		if (count($c_groups) == 0) $c_groups[]	= 0;

		// Check permission, if desired
		if ($all_groups || $check != 'no')
		{
			$user		= JFactory::getUser();
			$acc_groups	= $user->getAuthorisedGroups();

			//convert usergroups to match bwPostman's needs
			$a_groups	= array();
			if (count($acc_groups) > 0)
			{
				foreach ($acc_groups as $value)
				{
					$a_groups[]	= '-' . $value;
				}
			}
			else
			{
				$a_groups[]	= 0;
			}

			$sel_groups	= array_intersect($a_groups, $c_groups);
		}

		if (count($sel_groups) == 0) $sel_groups[]	= 0;

		if ($title === true)
		{
			$query	= $_db->getQuery(true);
			$query->select('id');
			$query->select('title');
			$query->from($_db->quoteName('#__usergroups'));
			$query->where($_db->quoteName('id') . ' IN (' . implode(',', $sel_groups) . ')');

			try
			{
				$this->_db->setQuery($query);
				$groups	= $_db->loadAssocList();
			}
			catch (RuntimeException $e)
			{
				JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
			}
		}
		else
		{
			$groups	= $sel_groups;
		}

		return $groups;
	}

	/**
	 * Method to get all user groups which the user is authorized to see
	 *
	 * @access 	public
	 *
	 * @param	int	    $id     module ID
	 *
	 * @return 	object	$module module object
	 *
	 * @since	1.2.0
	 */
	private function _getModuleById($id = 0)
	{
		$module = null;
		$_db	= JFactory::getDbo();
		$query	= $_db->getQuery(true);

		$query->select('m.id, m.title, m.module, m.position, m.content, m.showtitle, m.params');
		$query->from('#__modules AS m');
		$query->where('m.id = ' . $id);

		try
		{
			$this->_db->setQuery($query);
			$module	= $_db->loadObject();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		return $module;

	}

}
