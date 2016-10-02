<?php
/**
 * BwPostman User2Subscriber Plugin
 *
 * BwPostman helper class for plugin.
 *
 * @version 2.0.0 bwpmprs
 * @package BwPostman User2Subscriber Plugin
 * @author Romana Boldt
 * @copyright (C) 2016 Boldt Webservice <forum@boldt-webservice.de>
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

/**
 * Class BwPostmanHelper
 *
 * @since 2.0.0
 */
abstract class BWPM_User2SubscriberHelper {
	/**
	 * Method to check if user has a subscription
	 *
	 * @param   string  $user_mail
	 *
	 * @return  bool                true if subscription present
	 *
	 * @since  2.0.0
	 */
	public static function hasSubscription($user_mail)
	{
		if ($user_mail == '')
		{
			return false;
		}

		$_db	= JFactory::getDbo();
		$query	= $_db->getQuery(true);

		$query->select($_db->quoteName('email'));
		$query->from($_db->quoteName('#__bwpostman_subscribers'));
		$query->where($_db->quoteName('email') . ' = ' . $_db->quote($user_mail));

		$_db->setQuery($query);

		$result  = $_db->loadResult();

		if ($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Method to update user ID in table subscribers
	 *
	 * @param   string  $user_mail
	 * @param   int     $user_id
	 *
	 * @return  bool                true if subscription present and update okay
	 *
	 * @since  2.0.0
	 */
	public static function updateUserIdAtSubscriber($user_mail, $user_id)
	{
		if ($user_id == 0)
		{
			return false;
		}

		$_db	= JFactory::getDbo();
		$query	= $_db->getQuery(true);

		$query->update($_db->quoteName('#__bwpostman_subscribers'));
		$query->set($_db->quoteName('user_id') . " = " . $_db->quote($user_id));
		$query->where($_db->quoteName('email') . ' = ' . $_db->quote($user_mail));

		$_db->setQuery($query);

		$result  = $_db->execute();

		if ($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Method to get subscription email from BwPostman
	 *
	 * @param   int  $user_id
	 *
	 * @return  array|bool     subscriber mailaddress and id, or false on error
	 *
	 * @since  2.0.0
	 */
	public static  function getSubscriptionData($user_id)
	{
		if ($user_id == 0)
		{
			return true;
		}

		$_db	= JFactory::getDbo();
		$query	= $_db->getQuery(true);

		$query->select($_db->quoteName('email'));
		$query->select($_db->quoteName('id'));
		$query->from($_db->quoteName('#__bwpostman_subscribers'));
		$query->where($_db->quoteName('user_id') . ' = ' . $_db->quote($user_id));

		$_db->setQuery($query);

		$subscriber  = $_db->loadAssoc();

		return $subscriber;
	}

	/**
	 * Method to create user data array
	 *
	 * @param string        $user_mail
	 * @param int           $user_id
	 * @param array         $subscriber_data
	 * @param array         $mailinglist_ids
	 *
	 * @return object       $subscriber
	 *
	 * @since 2.0.0
	 */
	public static function createSubscriberData($user_mail, $user_id, $subscriber_data, $mailinglist_ids)
	{
		$params = JComponentHelper::getParams('com_bwpostman');
		$date   = JFactory::getDate();
		$time   = $date->toSql();

		// @Todo: For version 2.0.0 of component replace $_SERVER['REMOTE_ADDR'] with the following
		$remote_ip  = JFactory::getApplication()->input->server->get('REMOTE_ADDR', '', '');

		foreach ($subscriber_data as $key => $value) {
			if (strpos($key, 'bwp-') === 0) {
				$captcha = $key;
				break;
			}
		}

//		$captcha    = 'bwp-' . BwPostmanHelper::getCaptcha(1);

			$subscriber = new stdClass();

		$subscriber->id                = 0;
		$subscriber->user_id           = $user_id;
		$subscriber->gender            = \Joomla\Utilities\ArrayHelper::getValue($subscriber_data, 'gender', '', 'string');
		$subscriber->name              = \Joomla\Utilities\ArrayHelper::getValue($subscriber_data, 'name', '', 'string');
		$subscriber->firstname         = \Joomla\Utilities\ArrayHelper::getValue($subscriber_data, 'firstname', '', 'string');
		$subscriber->special           = \Joomla\Utilities\ArrayHelper::getValue($subscriber_data, 'special', '', 'string');
		$subscriber->email             = $user_mail;
		$subscriber->emailformat       = \Joomla\Utilities\ArrayHelper::getValue($subscriber_data, 'emailformat', 1, 'int');
		$subscriber->mailinglists      = $mailinglist_ids;
		$subscriber->activation        = self::createActivation();
		$subscriber->editlink          = self::createEditlink();
		$subscriber->status            = 0;
		$subscriber->registration_date = $time;
		$subscriber->registered_by     = 0;
		$subscriber->registration_ip   = $remote_ip;
		$subscriber->confirmed_by      = 0;
		$subscriber->archived_by       = 0;
		$subscriber->{$captcha}        = '1';
		$subscriber->agreecheck        = '1';

		return $subscriber;
	}

	/**
	 * Method to create the activation and check if the sting does not exist twice or more
	 *
	 * @return string   $activation
	 *
	 * @since       2.0.0
	 */
	public static  function createActivation()
	{
		// @ToDo: When this method has moved to helper class, this one here is redundant
		$_db                = JFactory::getDbo();
		$query              = $_db->getQuery(true);
		$current_activation = null;
		$match_activation   = true;

		while ($match_activation)
		{
			$current_activation = JApplicationHelper::getHash(JUserHelper::genRandomPassword());

			$query->select($_db->quoteName('activation'));
			$query->from($_db->quoteName('#__bwpostman_subscribers'));
			$query->where($_db->quoteName('activation') . ' = ' . $_db->quote($current_activation));

			$_db->setQuery($query);

			$activation = $_db->loadResult();

			if ($activation == $current_activation)
			{
				$match_activation = true;
			}
			else
			{
				$match_activation = false;
			}
		}

		return $current_activation;
	}

	/**
	 * Method to create the editlink and check if the sting does not exist twice or more
	 *
	 * @return string   $editlink
	 *
	 * @since       0.9.1
	 */
	public static function createEditlink()
	{
		// @ToDo: When this method has moved to helper class, this one here is redundant
		$_db                = JFactory::getDbo();
		$query              = $_db->getQuery(true);
		$current_editlink   = null;
		$match_editlink     = true;

		while ($match_editlink)
		{
			$current_editlink = JApplicationHelper::getHash(JUserHelper::genRandomPassword());

			$query->select($_db->quoteName('editlink'));
			$query->from($_db->quoteName('#__bwpostman_subscribers'));
			$query->where($_db->quoteName('editlink') . ' = ' . $_db->quote($current_editlink));

			$_db->setQuery($query);

			$editlink = $_db->loadResult();

			if ($editlink == $current_editlink)
			{
				$match_editlink = true;
			}
			else
			{
				$match_editlink = false;
			}
		}

		return $current_editlink;
	}

	/**
	 * Method to save subscriber data into table
	 *
	 * @param   object   $data              subscriber data
	 *
	 * @return  int      $subscriber_id     id of saved subscriber
	 *
	 * @throws exception
	 *
	 * @since       2.0.0
	 */
	public static function saveSubscriber($data)
	{
		// @Todo: As from version 2.0.0 BwPostmanModelRegister->save() may be used
		JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_bwpostman/tables');
		$table  = JTable::getInstance('Subscribers', 'BwPostmanTable');

		// Bind the data.
		if (!$table->bind($data))
		{
			return false;
		}

		// Check the data.
		/* @ToDo: spam check as yet implemented is evil to implement in registration form of Joomla.
		 * Better solution would be a plugin for spam check to outsource spam check from table check.
		 */
		/*
		$check_data = \Joomla\Utilities\ArrayHelper::fromObject($data);
		JFactory::getApplication()->setUserState('com_bwpostman.subscriber.register.data', $check_data);
		if (!$table->check())
		{
			return false;
		}
		*/

		// Store the data.
		if (!$table->store())
		{
			// Allow an exception to be thrown.
			throw  new Exception($table->getError());
		}

		$subscriber_id = self::getSubscriberIdByEmail($data->email);

		return $subscriber_id;
	}

	/**
	 * Method to save subscribed mailinglists
	 *
	 * @param   int     $subscriber_id
	 * @param   array   $mailinglist_ids
	 *
	 * @return bool     true on success
	 *
	 * @since       2.0.0
	 */
	public static function saveSubscribersMailinglists($subscriber_id, $mailinglist_ids)
	{
		// @Todo: As from version 2.0.0 helper class of component may be used
		$_db   = JFactory::getDbo();

		foreach ($mailinglist_ids as $mailinglist_id)
		{
			$query = $_db->getQuery(true);

			$query->insert($_db->quoteName('#__bwpostman_subscribers_mailinglists'));
			$query->columns(array(
				$_db->quoteName('subscriber_id'),
				$_db->quoteName('mailinglist_id')
			));
			$query->values(
				$_db->quote($subscriber_id) . ',' .
				$_db->quote($mailinglist_id)
			);
			$_db->setQuery($query);

			$_db->execute();
		}

		return true;
	}

	/**
	 * Method to get the subscriber id by email address
	 *
	 * @param   string  $email
	 *
	 * @return  int     $id
	 *
	 * @since       2.0.0
	 */
	protected static function getSubscriberIdByEmail($email)
	{
		$_db    = JFactory::getDbo();
		$query = $_db->getQuery(true);

		$query->select($_db->quoteName('id'));
		$query->from($_db->quoteName('#__bwpostman_subscribers'));
		$query->where($_db->quoteName('email') . ' = ' . $_db->quote($email));

		$_db->setQuery($query);

		$id = $_db->loadResult();

		return  $id;
	}
}
