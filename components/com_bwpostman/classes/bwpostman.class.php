<?php
/**
 * BwPostman Newsletter Component
 *
 * BwPostman main class for frontend.
 *
 * @version 2.0.0 bwpm
 * @package BwPostman-Site
 * @author Romana Boldt
 * @copyright (C) 2012-2016 Boldt Webservice <forum@boldt-webservice.de>
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
 * Class BwPostman
 *
 * @since       0.9.1
 */
class BwPostman {

	/**
	 * Method to write the BwPostman footer
	 *
	 * @since       0.9.1
	 */
	public static function footer()
	{

		$app = JFactory::getApplication();

		JPluginHelper::importPlugin('bwpostman','copyright');

		$copyright = '<span>BwPostman by </span><a href="http://www.boldt-webservice.de" target="_blank">Boldt Webservice</a>';

		$arguments = array(&$copyright);

		$app->triggerEvent('onPrepareBwpostman', $arguments);

		return $arguments[0];
	}
}
