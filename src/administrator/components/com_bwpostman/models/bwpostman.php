<?php
/**
 * BwPostman Newsletter Component
 *
 * BwPostman main model for backend.
 *
 * @version 2.0.0 bwpm
 * @package BwPostman-Admin
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

// Import MODEL object class
jimport('joomla.application.component.model');

/**
 * BwPostman cover page model
 *
 * @package		BwPostman-Admin
 * @subpackage	CoverPage
 *
 * @since       0.9.1
 */
class BwPostmanModelBwPostman extends JModelLegacy
{
	/**
	 * General statistic data
	 *
	 * @var array
	 *
	 * @since       0.9.1
	 */
	var $_general = null;

	/**
	 * Archive statistic data
	 *
	 * @var array
	 *
	 * @since       0.9.1
	 */
	var $_archive = null;

	/**
	 * Constructor
	 *
	 * @since       0.9.1
	 */
	public function __construct()
	{
		parent::__construct();

	}

	/**
	 * Method to get general statistic data
	 *
	 * @access 	public
	 *
	 * @return 	array       associative array of General Data
	 *
	 * @since       0.9.1
	 */
	public function getGeneraldata()
	{
		$_general	= array();
		$_db		= $this->_db;
		$query		= $_db->getQuery(true);

		// Get # of all unsent newsletters
		$query->select('COUNT(*)');
		$query->from($_db->quoteName('#__bwpostman_newsletters'));
		$query->where($_db->quoteName('mailing_date') . ' = ' . $_db->quote('0000-00-00 00:00:00'));
		$query->where($_db->quoteName('archive_flag') . ' = ' . (int) 0);

		$_db->setQuery($query);
		try
		{
			$_general['nl_unsent'] = $_db->loadResult();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		// Get # of all sent newsletters
		$query->clear();
		$query->select('COUNT(*)');
		$query->from($_db->quoteName('#__bwpostman_newsletters'));
		$query->where($_db->quoteName('mailing_date') . ' != ' . $_db->quote('0000-00-00 00:00:00'));
		$query->where($_db->quoteName('archive_flag') . ' = ' . (int) 0);

		$_db->setQuery($query);
		try
		{
			$_general['nl_sent'] = $_db->loadResult();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		// Get # of all subscribers
		$query->clear();
		$query->select('COUNT(*)');
		$query->from($_db->quoteName('#__bwpostman_subscribers'));
		$query->where($_db->quoteName('status') . ' != ' . (int) 9);
		$query->where($_db->quoteName('archive_flag') . ' = ' . (int) 0);

		$_db->setQuery($query);
		try
		{
			$_general['sub'] = $_db->loadResult();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		// Get # of all test-recipients
		$query->clear();
		$query->select('COUNT(*)');
		$query->from($_db->quoteName('#__bwpostman_subscribers'));
		$query->where($_db->quoteName('status') . ' = ' . (int) 9);
		$query->where($_db->quoteName('archive_flag') . ' = ' . (int) 0);

		$_db->setQuery($query);
		try
		{
			$_general['test'] = $_db->loadResult();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		// Get # of all campaigns
		$query->clear();
		$query->select('COUNT(*)');
		$query->from($_db->quoteName('#__bwpostman_campaigns'));
		$query->where($_db->quoteName('archive_flag') . ' = ' . (int) 0);

		$_db->setQuery($query);
		try
		{
			$_general['cam'] = $_db->loadResult();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		// Get # of all published mailinglists
		$query->clear();
		$query->select('COUNT(*)');
		$query->from($_db->quoteName('#__bwpostman_mailinglists'));
		$query->where($_db->quoteName('published') . ' = ' . (int) 1);
		$query->where($_db->quoteName('archive_flag') . ' = ' . 0);

		$_db->setQuery($query);
		try
		{
			$_general['ml_published'] = $_db->loadResult();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		// Get # of all unpublished mailinglists
		$query->clear();
		$query->select('COUNT(*)');
		$query->from($_db->quoteName('#__bwpostman_mailinglists'));
		$query->where($_db->quoteName('published') . ' = ' . (int) 0);
		$query->where($_db->quoteName('archive_flag') . ' = ' . 0);

		$_db->setQuery($query);
		try
		{
			$_general['ml_unpublished'] = $_db->loadResult();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		// Get # of all html templates
		$query->clear();
		$query->select('COUNT(*)');
		$query->from($_db->quoteName('#__bwpostman_templates'));
		$query->where($_db->quoteName('archive_flag') . ' = ' . (int) 0);
		$query->where($_db->quoteName('tpl_id') . ' < ' . $_db->quote('998'));

		$_db->setQuery($query);
		try
		{
			$_general['html_templates'] = $_db->loadResult();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		// Get # of all text templates
		$query->clear();
		$query->select('COUNT(*)');
		$query->from($_db->quoteName('#__bwpostman_templates'));
		$query->where($_db->quoteName('archive_flag') . ' = ' . (int) 0);
		$query->where($_db->quoteName('tpl_id') . ' > ' . $_db->quote('997'));

		$_db->setQuery($query);
		try
		{
			$_general['text_templates'] = $_db->loadResult();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		// Get total # of general statistic
		$_general[] = array_sum($_general);

		return $_general;
	}

	/**
	 * Method to get archive statistic data
	 *
	 * @access 	public
	 *
	 * @return 	array       associative array of Archive data
	 *
	 * @since
	 */
	public function getArchivedata()
	{
		$_archive	= array();
		$_db		= $this->_db;
		$query		= $_db->getQuery(true);

		// Get # of all archived newsletters
		$query->select('COUNT(*)');
		$query->from($_db->quoteName('#__bwpostman_newsletters'));
		$query->where($_db->quoteName('archive_flag') . ' = ' . (int) 1);

		$_db->setQuery($query);
		try
		{
			$_archive['arc_nl'] = $_db->loadResult();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		// Get # of all archived subscribers
		$query->clear();
		$query->select('COUNT(*)');
		$query->from($_db->quoteName('#__bwpostman_subscribers'));
		$query->where($_db->quoteName('archive_flag') . ' = ' . (int) 1);

		$_db->setQuery($query);
		try
		{
			$_archive['arc_sub'] = $_db->loadResult();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		// Get # of all archived campaigns
		$query->clear();
		$query->select('COUNT(*)');
		$query->from($_db->quoteName('#__bwpostman_campaigns'));
		$query->where($_db->quoteName('archive_flag') . ' = ' . (int) 1);

		$_db->setQuery($query);
		try
		{
			$_archive['arc_cam'] = $_db->loadResult();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		// Get # of all archived mailinglists
		$query->clear();
		$query->select('COUNT(*)');
		$query->from($_db->quoteName('#__bwpostman_mailinglists'));
		$query->where($_db->quoteName('archive_flag') . ' = ' . (int) 1);

		$_db->setQuery($query);
		try
		{
			$_archive['arc_ml'] = $_db->loadResult();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		// Get # of all html templates
		$query->clear();
		$query->select('COUNT(*)');
		$query->from($_db->quoteName('#__bwpostman_templates'));
		$query->where($_db->quoteName('archive_flag') . ' = ' . (int) 1);
		$query->where($_db->quoteName('tpl_id') . ' < ' . $_db->quote('998'));

		$_db->setQuery($query);
		try
		{
			$_general['arc_html_templates'] = $_db->loadResult();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		// Get # of all text templates
		$query->clear();
		$query->select('COUNT(*)');
		$query->from($_db->quoteName('#__bwpostman_templates'));
		$query->where($_db->quoteName('archive_flag') . ' = ' . (int) 1);
		$query->where($_db->quoteName('tpl_id') . ' > ' . $_db->quote('997'));

		$_db->setQuery($query);
		try
		{
			$_general['arc_text_templates'] = $_db->loadResult();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}

		// Get total # of general statistic
		$_archive[] = array_sum($_archive);

		return $_archive;
	}
}
