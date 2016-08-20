<?php
use Step\Acceptance\Installation as InstallationTester;
use Page\Generals as Generals;
use Page\InstallationPage as InstallPage;

/**
* Class TestInstallationCest
*
* This class contains all methods to test installation, update and deinstallation of BwPostman
 *
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
 *
 * @since   2.0.0
*/
class TestInstallationCest
{
	/**
	 * Test method to login into backend
	 *
	 * @param   \Page\Login     $loginPage
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function _login(\Page\Login $loginPage)
	{
		$loginPage->logIntoBackend(Generals::$admin);
	}

	/**
	 * Test method to install BwPostman
	 *
	 * @param   AcceptanceTester                $I
	 *
	 * @before  _login
	 *
	 * @after   _logout
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function installation(AcceptanceTester $I)
	{
		$I->wantTo("Install BwPostman");
		$I->expectTo("see success message and component in menu");
		$I->amOnPage(InstallPage::$install_url);
		$I->waitForElement(Generals::$pageTitle);
		$I->see(InstallPage::$headingInstall);

		$I->attachFile(InstallPage::$installField, "com_bwpostman.zip");
		$I->clickAndWait(InstallPage::$installButton, 10);

		$I->waitForElement(Generals::$alert_success);
		$I->see(InstallPage::$installSuccessMsg, Generals::$alert_success);
		$I->dontSee("Error", Generals::$alert_heading);
	}

	/**
	 * Test method to update BwPostman
	 *
	 * @param   AcceptanceTester                $I
	 *
	 * @before  _login
	 *
	 * @after   _logout
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function update(AcceptanceTester $I)
	{
		$I->wantTo("update BwPostman");
		$I->expectTo("see success message and component in menu");
		$I->amOnPage(InstallPage::$install_url);
		$I->waitForElement(Generals::$pageTitle);
		$I->see(InstallPage::$headingInstall);

		$I->attachFile(InstallPage::$installField, "com_bwpostman.zip");
		$I->clickAndWait(InstallPage::$installButton, 10);

		$I->waitForElement(Generals::$alert_success);
		$I->see(InstallPage::$installSuccessMsg, Generals::$alert_success);
		$I->dontSee("Error", Generals::$alert_heading);
	}

	/**
	 * Test method to uninstall BwPostman
	 *
	 * @param   AcceptanceTester                $I
	 *
	 * @before  _login
	 *
	 * @after   _logout
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function uninstall(AcceptanceTester $I)
	{
		$I->wantTo("uninstall BwPostman");
		$I->expectTo("see success message and component not in menu");
		$I->amOnPage(InstallPage::$uninstall_url);
		$I->waitForElement(Generals::$pageTitle);
		$I->see(InstallPage::$headingManage);

		$I->fillField(Generals::$search_field, Generals::$extension);
		$I->click(Generals::$search_button);
		$I->click(Generals::$first_list_entry);
		$I->click(InstallPage::$delete_button);
		$I->acceptPopup();

		$I->waitForElement(Generals::$alert_success);
		$I->see(InstallPage::$uninstallSuccessMsg, Generals::$alert_success);
	}

	/**
	 * Test method to logout from backend
	 *
	 * @param   AcceptanceTester        $I
	 * @param   \Page\Login             $loginPage
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function _logout(AcceptanceTester $I, \Page\Login $loginPage)
	{
		$loginPage->logoutFromBackend($I);
	}
}
