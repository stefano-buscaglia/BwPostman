<?php
/**
 * BwPostman Newsletter Component
 *
 * BwPostman templates table for backend.
 *
 * @version 2.0.0 bwpm
 * @package BwPostman-Admin
 * @author Karl Klostermann
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

/**
 * #__bwpostman_templates table handler
 * Table for storing the templates data
 *
 * @package		BwPostman-Admin
 *
 * @subpackage	Templates
 *
 * @since       1.1.0
 */
class BwPostmanTableTemplates extends JTable
{
	/**
	 * @var int Primary Key
	 *
	 * @since       1.1.0
	 */
	var $id = null;

	/**
	 * @var int asset_id
	 *
	 * @since       1.1.0
	 */
	var $asset_id = null;

	/**
	 * @var int standard template
	 *
	 * @since       1.1.0
	 */
	var $standard = 0;

	/**
	 * @var string title
	 *
	 * @since       1.1.0
	 */
	var $title = null;

	/**
	 * @var string description
	 *
	 * @since       1.1.0
	 */
	var $description = null;

	/**
	 * @var string thumbnail url
	 *
	 * @since       1.1.0
	 */
	var $thumbnail = null;

	/**
	 * @var string tpl_html
	 *
	 * @since       1.1.0
	 */
	var $tpl_html = null;

	/**
	 * @var string tpl_css
	 *
	 * @since       1.1.0
	 */
	var $tpl_css = null;

	/**
	 * @var string tpl_article
	 *
	 * @since       1.1.0
	 */
	var $tpl_article = null;

	/**
	 * @var string tpl_divider
	 *
	 * @since       1.1.0
	 */
	var $tpl_divider = null;

	/**
	 * @var int tpl_id
	 *
	 * @since       1.1.0
	 */
	var $tpl_id = null;

	/**
	 * @var string basics
	 *
	 * @since       1.1.0
	 */
	var $basics = null;

	/**
	 * @var string header
	 *
	 * @since       1.1.0
	 */
	var $header = null;

	/**
	 * @var string intro
	 *
	 * @since       1.1.0
	 */
	var $intro = null;

	/**
	 * @var string article
	 *
	 * @since       1.1.0
	 */
	var $article = null;

	/**
	 * @var string footer
	 *
	 * @since       1.1.0
	 */
	var $footer = null;

	/**
	 * @var string button1
	 *
	 * @since       1.1.0
	 */
	var $button1 = null;

	/**
	 * @var string button2
	 *
	 * @since       1.1.0
	 */
	var $button2 = null;

	/**
	 * @var string button3
	 *
	 * @since       1.1.0
	 */
	var $button3 = null;

	/**
	 * @var string button4
	 *
	 * @since       1.1.0
	 */
	var $button4 = null;

	/**
	 * @var string button5
	 *
	 * @since       1.1.0
	 */
	var $button5 = null;

	/**
	 * @var int access
	 *
	 * @since       1.1.0
	 */
	var $access = 1;

	/**
	 * @var int Published
	 *
	 * @since       1.1.0
	 */
	var $published = 0;

	/**
	 * @var datetime creation date of the newsletter
	 *
	 * @since       1.1.0
	 */
	var $created_date = '0000-00-00 00:00:00';

	/**
	 * @var int Author
	 *
	 * @since       1.1.0
	 */
	var $created_by = 0;

	/**
	 * @var datetime last modification date of the newsletter
	 *
	 * @since       1.1.0
	 */
	var $modified_time = '0000-00-00 00:00:00';

	/**
	 * @var int user ID
	 *
	 * @since       1.1.0
	 */
	var $modified_by = 0;

	/**
	 * @var int Checked-out owner
	 *
	 * @since       1.1.0
	 */
	var $checked_out = 0;

	/**
	 * @var datetime Checked-out time
	 *
	 * @since       1.1.0
	 */
	var $checked_out_time = 0;

	/**
	 * @var int Archive-flag --> 0 = not archived, 1 = archived
	 *
	 * @since       1.1.0
	 */
	var $archive_flag = 0;

	/**
	 * @var datetime Archive-date
	 *
	 * @since       1.1.0
	 */
	var $archive_date = '0000-00-00 00:00:00';

	/**
	 * @var int ID --> 0 = newsletter is not archived, another ID = account is archived by an administrator
	 *
	 * @since       1.1.0
	 */
	var $archived_by = 0;

	/**
	 * Constructor
	 *
	 * @param 	JDatabaseDriver  $db Database object
	 *
	 * @since 1.1.0
	 */
	public function __construct(& $db)
	{
		parent::__construct('#__bwpostman_templates', 'id', $db);
	}

	/**
	 * Alias function
	 *
	 * @return  string
	 *
	 * @since   1.1.0
	 */
	public function getAssetName()
	{
		return self::_getAssetName();
	}

	/**
	 * Alias function
	 *
	 * @return  string
	 *
	 * @since   1.1.0
	 */
	public function getAssetTitle()
	{
		return self::_getAssetTitle();
	}

	/**
	 * Alias function
	 *
	 * @return  string
	 *
	 * @since   1.1.0
	 */
	public function getAssetParentId()
	{
		return self::_getAssetParentId();
	}

	/**
	 * Method to compute the default name of the asset.
	 * The default name is in the form table_name.id
	 * where id is the value of the primary key of the table.
	 *
	 * @return  string
	 *
	 * @since   1.1.0
	 */
	protected function _getAssetName()
	{
		$k = $this->_tbl_key;
		return 'com_bwpostman.template.' . (int) $this->$k;
	}

	/**
	 * Method to return the title to use for the asset table.
	 *
	 * @return  string
	 *
	 * @since   1.1.0
	 */
	protected function _getAssetTitle()
	{
		return $this->title;
	}

	/**
	 * Method to get the parent asset id for the record
	 *
	 * @param   JTable   $table  A JTable object (optional) for the asset parent
	 * @param   integer  $id     The id (optional) of the content.
	 *
	 * @return  integer
	 *
	 * @since   1.1.0
	 */
	protected function _getAssetParentId(JTable $table = null, $id = null)
	{
		// Initialise variables.
		$assetId = null;
		$result  = 0;

		// Build the query to get the asset id for the component.
		$query = $this->_db->getQuery(true);
		$query->select($this->_db->quoteName('id'));
		$query->from($this->_db->quoteName('#__assets'));
		$query->where($this->_db->quoteName('name') . " LIKE 'com_bwpostman'");

		// Get the asset id from the database.
		$this->_db->setQuery($query);
		try
		{
			$result = $this->_db->loadResult();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
		}
		if ($result)
		{
			$assetId = (int) $result;
		}

		// Return the asset id.
		if ($assetId)
		{
			return $assetId;
		}
		else
		{
			return parent::_getAssetParentId($table, $id);
		}
	}

	/**
	 * Overloaded bind function
	 *
	 * @access public
	 *
	 * @param array|object  $data       Named array
	 * @param string        $ignore     Space separated list of fields not to bind
	 *
	 * @throws BwException
	 *
	 * @return boolean
	 *
	 * @since 1.1.0
	 */
	public function bind($data, $ignore='')
	{

		// Remove all HTML tags from the title and description
		$filter				= new JFilterInput(array(), array(), 0, 0);
		$this->title		= $filter->clean($this->title);
		$this->description	= $filter->clean($this->description);

		// Bind the rules.
		if (is_object($data))
		{
			if (property_exists($data, 'rules') && is_array($data->rules))
			{
				$rules = new JAccessRules($data->rules);
				$this->setRules($rules);
			}
		}
		elseif (is_array($data))
		{
			if (array_key_exists('rules', $data) && is_array($data['rules']))
			{
				$rules = new JAccessRules($data['rules']);
				$this->setRules($rules);
			}
		}
		else
		{
			throw new BwException(JText::sprintf('JLIB_DATABASE_ERROR_BIND_FAILED_INVALID_SOURCE_ARGUMENT', get_class($this)));
		}

		// Cast properties
		$this->id	= (int) $this->id;

		return parent::bind($data, $ignore);
	}

	/**
	 * Overloaded check method to ensure data integrity
	 *
	 * @access public
	 *
	 * @return boolean True
	 *
	 * @since 1.1.0
	 */
	public function check()
	{
		$app	= JFactory::getApplication();
		$_db	= $this->_db;
		$query	= $this->_db->getQuery(true);
		$fault	= false;
		$xid    = 0;

		// unset standard template if task is save2copy
		$jinput	= JFactory::getApplication()->input;
		$task = $jinput->get('task', 0);
		if ($task == 'save2copy') $this->standard = 0;

		// *** prepare the template data ***
		$item = $this;

		// user-made html template
		if ($item->tpl_id == 0)
		{
			if (isset($this->article) && is_array($this->article))
			{
				$registry = new JRegistry();
				$registry->loadArray($this->article);
				$this->article = (string) $registry;
			}
		}
		// user-made text template
		elseif ($item->tpl_id == 998)
		{
			if (isset($this->article) && is_array($this->article))
			{
				$registry = new JRegistry();
				$registry->loadArray($this->article);
				$this->article = (string) $registry;
			}
		}
		// pre-installed text template
		elseif ($item->tpl_id > 999)
		{
			// first get templates tpls
			$tpl_id		= $item->tpl_id;
			$tpl_model	= JModelLegacy::getInstance( 'templates_tpl', 'BwPostmanModel' );
			$tpl		= $tpl_model->getItem($tpl_id);

			// get template model
			$model		= JModelLegacy::getInstance( 'template', 'BwPostmanModel' );
			// make html template data
			$this->tpl_html	= $model->makeTexttemplate($item, $tpl);
			if ($this->footer['show_impressum'] == 1)
				$this->tpl_html = $this->tpl_html . '[%impressum%]';

			// make article template data
			$article			= $tpl->article_tpl;
			$readon				= $tpl->readon_tpl;
			$this->tpl_article	= $this->article['show_readon'] != 1 ? str_replace('[%readon_button%]', '', $article) : str_replace('[%readon_button%]', $readon, $article);

			//  set divider template
			$this->tpl_divider	= $tpl->divider_tpl;

			// convert object array to string
			self::converttostr($this);
		}
		// pre-installed html template
		else
		{
			// first get templates tpls
			$tpl_id		= $item->tpl_id;
			$tpl_model	= JModelLegacy::getInstance( 'templates_tpl', 'BwPostmanModel' );
			$tpl		= $tpl_model->getItem($tpl_id);

			// get template model
			$model		= JModelLegacy::getInstance( 'template', 'BwPostmanModel' );
			// make html template data
			$this->tpl_html = $model->makeTemplate($item, $tpl);
			if ($this->footer['show_impressum'] == 1)
				$this->tpl_html = $this->tpl_html . '[%impressum%]';

			// make css data
			$this->tpl_css = $model->replaceZooms($tpl->css, $item);

			// make article template data
			$article			= $model->replaceZooms($tpl->article_tpl, $item);
			$readon				= $model->makeButton($tpl->readon_tpl, $item);
			$this->tpl_article	= $this->article['show_readon'] != 1 ? str_replace('[%readon_button%]', '', $article) : str_replace('[%readon_button%]', $readon, $article);

			//  set divider template and replace placeholder
			$tpl->divider_tpl	= $model->replaceZooms($tpl->divider_tpl, $item);
			$this->tpl_divider	= str_replace('[%divider_color%]', $item->article['divider_color'], $tpl->divider_tpl);

			// convert object array to string
			self::converttostr($this);
		}
		// *** end prepare the template data ***

		// Check for valid title
		if (trim($this->title) == '')
		{
			$app->enqueueMessage(JText::_('COM_BWPOSTMAN_TPL_ERROR_TITLE'), 'error');
			$fault	= true;
		}

		// Check for valid title
		if (trim($this->description) == '')
		{
			$app->enqueueMessage(JText::_('COM_BWPOSTMAN_TPL_ERROR_DESCRIPTION'), 'error');
			$fault	= true;
		}

		// Check for existing title
		$query->select($_db->quoteName('id'));
		$query->from($_db->quoteName('#__bwpostman_templates'));
		$query->where($_db->quoteName('title') . ' = ' . $_db->quote($this->title));

		$_db->setQuery($query);

		try
		{
			$xid = intval($this->_db->loadResult());
		}
		catch (RuntimeException $e)
		{
			$app->enqueueMessage($e->getMessage(), 'error');
		}

		if ($xid && $xid != intval($this->id))
		{
			$app->enqueueMessage((JText::sprintf('COM_BWPOSTMAN_TPL_ERROR_TITLE_DOUBLE', $this->title, $xid)), 'error');
			return false;
		}

		if ($fault) {
			$app->setUserState('com_bwpostman.edit.template.data', $this);
			return false;
		}
		return true;
	}

	/**
	 * Overridden JTable::store to set created/modified and user id.
	 *
	 * @param   boolean  $updateNulls  True to update fields even if they are null.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   1.1.0
  	 */
	public function store($updateNulls = false)
	{
		$date = JFactory::getDate();
		$user = JFactory::getUser();

		// trim leading and last <style>-tag
		$this->tpl_css = trim($this->tpl_css);
		$this->tpl_css = ltrim($this->tpl_css, '<style type="text/css">');
		$this->tpl_css = rtrim($this->tpl_css, '</style>');

		if ($this->id)
		{
			// Existing mailing list
			$this->modified_time = $date->toSql();
			$this->modified_by = $user->get('id');
		}
		else
		{
			// New mailing list
			$this->created_date = $date->toSql();
			$this->created_by = $user->get('id');
		}
		$res	= parent::store($updateNulls);
		JFactory::getApplication()->setUserState('com_bwpostman.edit.template.id', $this->id);

		return $res;
	}

	/**
	 * Convert object array to string
	 *
	 * @access private
	 *
	 * @param   object  $data
	 *
	 * @return object   $data
	 *
	 * @since 1.1.0
	 */
	private function converttostr($data)
	{
    // array to string
		if (isset($data->basics) && is_array($data->basics))
		{
			$registry = new JRegistry();
			$registry->loadArray($data->basics);
			$data->basics = (string) $registry;
		}
		if (isset($data->header) && is_array($data->header))
		{
			$registry = new JRegistry();
			$registry->loadArray($data->header);
			$data->header = (string) $registry;
		}
		if (isset($data->intro) && is_array($data->intro))
		{
			$registry = new JRegistry();
			$registry->loadArray($data->intro);
			$data->intro = (string) $registry;
		}
		if (isset($data->article) && is_array($data->article))
		{
			$registry = new JRegistry();
			$registry->loadArray($data->article);
			$data->article = (string) $registry;
		}
		if (isset($data->footer) && is_array($data->footer))
		{
			$registry = new JRegistry();
			$registry->loadArray($data->footer);
			$data->footer = (string) $registry;
		}
		if (isset($data->button1) && is_array($data->button1))
		{
			$registry = new JRegistry();
			$registry->loadArray($data->button1);
			$data->button1 = (string) $registry;
		}
		if (isset($data->button2) && is_array($data->button2))
		{
			$registry = new JRegistry();
			$registry->loadArray($data->button2);
			$data->button2 = (string) $registry;
		}
		if (isset($data->button3) && is_array($data->button3))
		{
			$registry = new JRegistry();
			$registry->loadArray($data->button3);
			$data->button3 = (string) $registry;
		}
		if (isset($data->button4) && is_array($data->button4))
		{
			$registry = new JRegistry();
			$registry->loadArray($data->button4);
			$data->button4 = (string) $registry;
		}
		if (isset($data->button5) && is_array($data->button5))
		{
			$registry = new JRegistry();
			$registry->loadArray($data->button5);
			$data->button5 = (string) $registry;
		}
		return $data;
	}
}
