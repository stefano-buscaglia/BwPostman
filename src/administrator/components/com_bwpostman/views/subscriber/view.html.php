<?php
/**
 * BwPostman Newsletter Component
 *
 * BwPostman single html subscribers view for backend.
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

// Import VIEW object class
jimport('joomla.application.component.view');

// Require helper class
require_once (JPATH_COMPONENT_ADMINISTRATOR.'/helpers/helper.php');
require_once (JPATH_COMPONENT_ADMINISTRATOR.'/helpers/htmlhelper.php');

/**
 * BwPostman Subscriber View
 *
 * @package 	BwPostman-Admin
 *
 * @subpackage 	Subscribers
 *
 * @since       0.9.1
 */
class BwPostmanViewSubscriber extends JViewLegacy
{
	/**
	 * property to hold form data
	 *
	 * @var array   $form
	 *
	 * @since       0.9.1
	 */
	protected $form;

	/**
	 * property to hold selected item
	 *
	 * @var object   $item
	 *
	 * @since       0.9.1
	 */
	protected $item;

	/**
	 * property to hold row object
	 *
	 * @var object   $row
	 *
	 * @since       0.9.1
	 */
	protected $row;

	/**
	 * property to hold state
	 *
	 * @var array|object  $state
	 *
	 * @since       0.9.1
	 */
	protected $state;

	/**
	 * property to hold obligation values
	 *
	 * @var array   $obligation
	 *
	 * @since       0.9.1
	 */
	protected $obligation;

	/**
	 * property to hold queue entries
	 *
	 * @var boolean $queueEntries
	 *
	 * @since       0.9.1
	 */
	public $queueEntries;

	/**
	 * property to hold template
	 *
	 * @var boolean $template
	 *
	 * @since       0.9.1
	 */
	public $template;

	/**
	 * property to hold import
	 *
	 * @var array $import
	 *
	 * @since       0.9.1
	 */
	public $import;

	/**
	 * property to hold lists
	 *
	 * @var array $lists
	 *
	 * @since       0.9.1
	 */
	public $lists;

	/**
	 * property to hold request url
	 *
	 * @var string $request_url
	 *
	 * @since       0.9.1
	 */
	public $request_url;

	/**
	 * property to hold raw format of request url
	 *
	 * @var string $request_url_raw
	 *
	 * @since       0.9.1
	 */
	public $request_url_raw;

	/**
	 * property to hold result
	 *
	 * @var string $result
	 *
	 * @since       0.9.1
	 */
	public $result;

	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise a JError object.
	 *
	 * @since       0.9.1
	 */
	public function display($tpl=null)
	{
		$app	= JFactory::getApplication();
		$jinput	= JFactory::getApplication()->input;
		$params = JComponentHelper::getParams('com_bwpostman');

		if (!BwPostmanHelper::canView('subscriber'))
		{
			$app->enqueueMessage(JText::sprintf('COM_BWPOSTMAN_VIEW_NOT_ALLOWED', JText::_('COM_BWPOSTMAN_SUB')), 'error');
			$app->redirect('index.php?option=com_bwpostman');
		}

		//check for queue entries
		$this->queueEntries	= BwPostmanHelper::checkQueueEntries();

		$layout = $jinput->get('layout', '');

		switch ($layout)
		{
			case 'export':
				self::_displayExportForm();
				break;
			case 'import':
			case 'import1':
			case 'import2':
				self::_displayImportForm();
				break;
			case 'edit':
			default:
				// get template name
				$this->template	= $app->getTemplate();

				// Get the data from the model
				$this->form		= $this->get('Form');
				$this->item		= $this->get('Item');
				$this->state	= $this->get('State');

				if ($this->item->id)
				{
					$app->setUserState('com_bwpostman.subscriber.new_test', $this->item->status);
					$app->setUserState('com_bwpostman.subscriber.subscriber_id', $this->item->id);
				}

				// Get show fields
				if (!$params->get('show_name_field'))		$this->form->setFieldAttribute('name', 'type', 'hidden');
				if (!$params->get('show_firstname_field'))	$this->form->setFieldAttribute('firstname', 'type', 'hidden');
				if (!$params->get('show_gender'))	        $this->form->setFieldAttribute('gender', 'type', 'hidden');
				if (!$params->get('show_special'))	        $this->form->setFieldAttribute('special', 'type', 'hidden');
				if (!$params->get('show_emailformat')) {
					$this->form->setFieldAttribute('emailformat', 'type', 'hidden');
				}
				else
				{
					$this->form->setFieldAttribute('default_emailformat', 'default', $params->get('default_emailformat'));
				}

				// Set required fields
				$this->obligation['name']		    = $params->get('name_field_obligation');
				$this->obligation['firstname']  	= $params->get('firstname_field_obligation');
				$this->obligation['special']	    = $params->get('special_field_obligation');
				$this->obligation['special_label']	= JText::_($params->get('special_label'));
				if ($params->get('name_field_obligation')) 		$this->form->setFieldAttribute('name', 'required', 'true');
				if ($params->get('firstname_field_obligation'))	$this->form->setFieldAttribute('firstname', 'required', 'true');
				if ($params->get('special_field_obligation'))	$this->form->setFieldAttribute('special', 'required', true);

				// Set label and description/tooltip for additional field
				if ($params->get('special_desc') != '') 		$this->form->setFieldAttribute('special', 'description', $params->get('special_desc'));
				if ($params->get('special_label') != '') 		$this->form->setFieldAttribute('special', 'label', $params->get('special_label'));

				$this->addToolbar();
		}
		parent::display($tpl);
	}

	/**
	 * View Import Forms
	 *
	 * @access	private
	 *
	 * @since       0.9.1
	 */
	private function _displayImportForm()
	{
		$app		= JFactory::getApplication();
		$params 	= JComponentHelper::getParams('com_bwpostman');
		$session 	= JFactory::getSession();
		$template	= $app->getTemplate();
		$uri		= JUri::getInstance();
		$uri_string	= str_replace('&', '&amp;', $uri->toString());

		$import					= array();
		$lists					= array();
		$session_delimiter		= ';';
		$session_enclosure		= '"';
		$result                 = true;

		$app->setUserState('com_bwpostman.subscriber.import', true);

		// Get the data from the model
		$this->form		= $this->get('Form');
		$this->state	= $this->get('State');

		// Get general import data from the session (fileformat, filename ...)
		$import_general_data = $session->get('import_general_data');
		if(isset($import_general_data) && is_array($import_general_data)) $import = $import_general_data;

		// get the fileformat select list for the layouts import1 and import2
		$lists['fileformat']	= BwPostmanHTMLHelper::getFileFormatList(isset ($import['fileformat']) ? $import['fileformat'] : '');

		// Get the csv-delimiter select list for the layouts import1 and import2
		// Delimiter which is stored in the session
		if (isset($import['delimiter'])) $session_delimiter = $import['delimiter'];

		$lists['delimiter']	= BwPostmanHTMLHelper::getDelimiterList($session_delimiter);

		// Get the csv-enclosure select list for the layouts import1 and import2
		// Enclosure which is stored in the session
		if (isset($import['enclosure'])) $session_enclosure = $import['enclosure'];

		$lists['enclosure']	= BwPostmanHTMLHelper::getEnclosureList($session_enclosure);

		// Get the import database fields list for the layout import2
		$lists['db_fields']	= BwPostmanHTMLHelper::getDbFieldsList();

		// Build the select list for the importfile fields from the session object for the layout import2
		$import_fields = $session->get('import_fields');
		if (isset($import_fields)) {
			$lists['import_fields']	= JHtml::_('select.genericlist', $import_fields, 'import_fields[]', 'class="inputbox" size="10" multiple="multiple" style="padding: 6px; width: 260px;"', 'value', 'text');
		}

		// Get the emailformat select list for the layout import2
		$lists['emailformat']	= BwPostmanHTMLHelper::getMailFormatList($params->get('default_emailformat'));

		// Get import result data from the session for the layout import2
		$import_result = $session->get('import_result');
		if(isset($import_result) && is_array($import_result)){
			$result = $import_result;
		}

		// Save a reference into view
		$this->import       = $import;
		$this->lists        = $lists;
		$this->request_url  = $uri_string;
		$this->result       = $result;
		$this->template     = $template;

		$this->addToolbar();
	}

	/**
	 * View Export Form
	 *
	 * @access	private
	 *
	 * @since       0.9.1
	 */
	private function _displayExportForm()
	{
		$app = JFactory::getApplication();

		$template	= $app->getTemplate();
		$uri		= JUri::getInstance();
		$uri_string	= str_replace('&', '&amp;', $uri->toString());

		// Get the select lists for the export_fields, file format, delimiter, enclosure
		$lists['export_fields']	= BwPostmanHTMLHelper::getExportFieldsList();
		$lists['fileformat']	= BwPostmanHTMLHelper::getFileFormatList();
		$lists['delimiter']		= BwPostmanHTMLHelper::getDelimiterList();
		$lists['enclosure']		= BwPostmanHTMLHelper::getEnclosureList();

		// We need a RAW-view for the export function
		$uri->setVar('format','raw');

		// Save a reference into view
		$this->lists            = $lists;
		$this->request_url_raw  = $uri_string;
		$this->template         = $template;

		$this->addToolbar();
	}

	/**
	 * View Validation Form
	 *
	 * @access	private
	 * @param 	string $tpl Template
	 *
	 * @since       0.9.1
	 */
	private function _displayValidationForm($tpl)
	{
		$session 	= JFactory::getSession();
		$uri		= JUri::getInstance();
		$uri_string	= $uri->toString();

		// Get the result data from the session
		$validation_res = $session->get('validation_res');
		$row            = new stdClass();
		if (isset($validation_res) && (is_array($validation_res))) {
			foreach ($validation_res AS $key => $value) {
				$row->$key = $value;
			}
		}

		// Save a reference into view
		$this->request_url	= str_replace('&', '&amp;', $uri_string);
		$this->row          = $row;

		// Get document object, set document title and add css
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_BWPOSTMAN_SUB_VALIDATION_RESULT'));
		$document->addStyleSheet(JUri::root(true) . '/administrator/components/com_bwpostman/assets/css/bwpostman_backend.css');

		// Set toolbar items
		JToolbarHelper::title(JText::_('COM_BWPOSTMAN_SUB_VALIDATION_RESULT'), 'subscribers');
		JToolbarHelper::cancel('subscriber.finishValidation', 'COM_BWPOSTMAN_SUB_VALIDATION_FINISH');

		// Set parent display
		parent::display($tpl);
	}

	/**
	 * Add the page title, styles and toolbar.
	 *
	 *
	 * @since       0.9.1
	 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);
		$uri		= JUri::getInstance();
		$userId		= JFactory::getUser()->get('id');
		$layout		= JFactory::getApplication()->input->get('layout', '');
		$tester		= false;
		$status 	= 1;

		if (is_object($this->item)) {
			$status	= $this->item->status;
		}

		if (JFactory::getApplication()->getUserState('com_bwpostman.subscriber.new_test', $status) == '9') {
			$tester	= true;
		}

		// Get document object, set document title and add css
		$document	= JFactory::getDocument();
		$document->addStyleSheet(JUri::root(true) . '/administrator/components/com_bwpostman/assets/css/bwpostman_backend.css');

		$alt 	= "COM_BWPOSTMAN_BACK";
		$bar	= JToolbar::getInstance('toolbar');

		switch ($layout) {
			case 'export':
				// Get document object, set document title and add css
				$document->setTitle(JText::_('COM_BWPOSTMAN_SUB_EXPORT_SUBS'));

				// Set toolbar items
				JToolbarHelper::title(JText::_('COM_BWPOSTMAN_SUB_EXPORT_SUBS'), 'upload');
				JToolbarHelper::cancel('subscriber.cancel');
				break;

			case 'import':
				// Set toolbar items
				$document->setTitle(JText::_('COM_BWPOSTMAN_SUB_IMPORT_SUBS'));
				JToolbarHelper::title(JText::_('COM_BWPOSTMAN_SUB_IMPORT_SUBS'), 'download');
				JToolbarHelper::cancel('subscriber.cancel');
				break;

			case 'import1':
				$document->setTitle(JText::_('COM_BWPOSTMAN_SUB_IMPORT_SUBS'));
				$backlink 	= 'index.php?option=com_bwpostman&view=subscriber&layout=import';
				JToolbarHelper::title(JText::_('COM_BWPOSTMAN_SUB_IMPORT_SUBS'), 'download');
				$bar->appendButton('Link', 'arrow-left', $alt, $backlink);
				JToolbarHelper::cancel('subscriber.cancel');
				break;

			case 'import2':
				$document->setTitle(JText::_('COM_BWPOSTMAN_SUB_IMPORT_RESULT'));
				$backlink = 'index.php?option=com_bwpostman&view=subscriber&layout=import1';
				JToolbarHelper::title(JText::_('COM_BWPOSTMAN_SUB_IMPORT_RESULT'), 'info');
				$bar->appendButton('Link', 'arrow-left', $alt, $backlink);
				JToolbarHelper::cancel('subscriber.cancel');
				break;

			case 'edit':
			default:
				if ($tester) {
					$title	= (JText::_('COM_BWPOSTMAN_TEST_DETAILS'));
				}
				else {
					$title	= (JText::_('COM_BWPOSTMAN_SUB_DETAILS'));
				}
				$document->setTitle($title);

				// Set toolbar title and items
				$checkedOut		= !($this->item->checked_out == 0 || $this->item->checked_out == $userId);

				// Set toolbar title depending on the state of the item: Is it a new item? --> Create; Is it an existing record? --> Edit
				// For new records, check the create permission.
				if ($this->item->id < 1 && BwPostmanHelper::canAdd('subscriber')) {
					JToolbarHelper::save('subscriber.save');
					JToolbarHelper::apply('subscriber.apply');
					JToolbarHelper::cancel('subscriber.cancel');
					JToolbarHelper::title($title .': <small>[ ' . JText::_('NEW').' ]</small>', 'plus');
				}
				else {
					// Can't save the record if it's checked out.
					if (!$checkedOut) {
						// Since it's an existing record, check the edit permission, or fall back to edit own if the owner.
						if (BwPostmanHelper::canEdit('subscriber', $this->item)) {
							JToolbarHelper::save('subscriber.save');
							JToolbarHelper::apply('subscriber.apply');
						}
					}
					// Rename the cancel button for existing items
					JToolbarHelper::cancel('subscriber.cancel', 'JTOOLBAR_CLOSE');
					JToolbarHelper::title($title .': <small>[ ' . JText::_('EDIT').' ]</small>', 'edit');
				}

				$backlink 	= $_SERVER['HTTP_REFERER'];
				$siteURL 	= $uri->base();

				// If we came from the cover page we will show a back-button
				if ($backlink == $siteURL.'index.php?option=com_bwpostman') {
					JToolbarHelper::spacer();
					JToolbarHelper::divider();
					JToolbarHelper::spacer();
					JToolbarHelper::back();
				}
		}
		JToolbarHelper::spacer();
		JToolbarHelper::divider();
		JToolbarHelper::spacer();

		$link   = BwPostmanHTMLHelper::getForumLink();

		JToolbarHelper::help(JText::_("COM_BWPOSTMAN_FORUM"), false, $link);
	}
}
