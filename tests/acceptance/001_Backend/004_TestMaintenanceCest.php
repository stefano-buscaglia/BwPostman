<?php
use Page\Generals as Generals;
use Page\MaintenancePage as MaintenancePage;
use Page\MainviewPage as MainView;

/**
* Class TestMaintenanceCest
*
* This class contains all methods to test maintenance functionality at back end
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
class TestMaintenanceCest
{
	/**
	 * Test method to login into backend
	 *
	 * @param   \Page\Login     $loginPage
	 *
	 * @group   component
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
	 * Test method to save tables
	 *
	 * @param   AcceptanceTester                $I
	 *
	 * @before  _login
	 *
	 * @after   _logout
	 *
	 * @group   component
	 * @group   004_maintenance
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function saveTables(AcceptanceTester $I)
	{
		$I->wantTo("Save tables");
		$I->expectTo("see file in download directory");
		$I->amOnPage(MainView::$url);
		$I->click(MainView::$maintenanceButton);

		$I->waitForElement(Generals::$pageTitle);
		$I->see(MaintenancePage::$heading);

		$path       = '/home/romana/Downloads/';
		$filename   = 'BwPostman_' . str_replace('.', '_', Generals::$versionToTest) . '_Tables_' . date("Y-m-d_H-i")  . '.xml';

		$I->clickAndWait(MaintenancePage::$saveTablesButton, 5);

		$I->assertTrue(file_exists($path . $filename));
//		$I->assertTrue(unlink($path . $filename));
	}

	/**
	 * Test method to check tables
	 *
	 * @param   AcceptanceTester                $I
	 *
	 * @before  _login
	 *
	 * @after   _logout
	 *
	 * @group   component
	 * @group   004_maintenance
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function checkTables(AcceptanceTester $I)
	{
		$I->wantTo("Check tables");
		$I->expectTo("see 'Result check okay'");
		$I->amOnPage(MainView::$url);
		$I->click(MainView::$maintenanceButton);

		$I->waitForElement(Generals::$pageTitle);
		$I->see(MaintenancePage::$heading);

		$I->click(MaintenancePage::$checkTablesButton);
		$I->waitForElement(MaintenancePage::$step1Field);
		$I->waitForElement(MaintenancePage::$step2Field);
		$I->waitForElement(MaintenancePage::$step3Field);
		$I->wait(10);
		$I->waitForElement(MaintenancePage::$step4Field);
		$I->waitForElement(MaintenancePage::$step5Field);
		$I->waitForElement(MaintenancePage::$step5SuccessClass);
		$I->see(MaintenancePage::$step5SuccessMsg, MaintenancePage::$step5SuccessClass);
		$I->click(MaintenancePage::$checkBackButton);

	}

	/**
	 * Test method to restore tables
	 *
	 * @param   AcceptanceTester                $I
	 *
	 * @before  _login
	 *
	 * @after   _logout
	 *
	 * @group   component
	 * @group   004_maintenance
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function restoreTables(AcceptanceTester $I)
	{
		$I->wantTo("Restore tables");
		$I->expectTo("see 'Result check okay'");
		$I->amOnPage(MainView::$url);
		$I->click(MainView::$maintenanceButton);

		$I->waitForElement(Generals::$pageTitle);
		$I->see(MaintenancePage::$heading);

		$I->click(MaintenancePage::$restoreTablesButton);
		$I->waitForElement(MaintenancePage::$headingRestoreFile);

		$I->attachFile(".//*[@id='restorefile']", "BwPostman_2_0_0_Tables.xml");
		$I->click(".//*[@id='adminForm']/fieldset/div[2]/div/table/tbody/tr[2]/td/input");
		$I->dontSeeElement(Generals::$alert_error);

		$I->waitForElement(MaintenancePage::$step1Field);
		$I->waitForElement(MaintenancePage::$step2Field);
		$I->waitForElement(MaintenancePage::$step3Field);
		$I->wait(20);
		$I->waitForElement(MaintenancePage::$step4Field);
		$I->waitForElement(MaintenancePage::$step5Field);
		$I->wait(15);
		$I->waitForElement(MaintenancePage::$step6Field);
		$I->waitForElement(MaintenancePage::$step7Field);
		$I->waitForElement(MaintenancePage::$step8Field);
		$I->waitForElement(MaintenancePage::$step9Field);
		$I->waitForElement(MaintenancePage::$step10Field);
		$I->waitForElement(MaintenancePage::$step11Field);
		$I->waitForElement(MaintenancePage::$step11SuccessClass);
		$I->see(MaintenancePage::$step11SuccessMsg, MaintenancePage::$step11SuccessClass);
		$I->clickAndWait(MaintenancePage::$checkBackButton, 2);
	}

	/**
	 * Test method to check forum link
	 *
	 * @param   AcceptanceTester                $I
	 *
	 * @before  _login
	 *
	 * after   _logout
	 *
	 * @group   component
	 * @group   004_maintenance
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function testForumLink(AcceptanceTester $I)
	{
		$I->wantTo("test forum link");
		$I->expectTo("see new page with forum of BwPostman");
		$I->amOnPage(MainView::$url);
		$I->click(MainView::$maintenanceButton);

		$I->waitForElement(Generals::$pageTitle);
		$I->see(MaintenancePage::$heading);

		$I->click(MaintenancePage::$forumButton);
		$I->switchToWindow("new");
		$I->see("In this category you can ask your questions for the Joomla! extension BwPostman.");
	}

	/**
	 * Test method to check button basic settings
	 *
	 * @param   AcceptanceTester                $I
	 *
	 * before  _login
	 *
	 * @after   _logout
	 *
	 * @group   component
	 * @group   004_maintenance
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function testBasicSettings(AcceptanceTester $I)
	{
		$I->wantTo("test basic settings button");
		$I->expectTo("see configuration page");
		$I->amOnPage(MainView::$url);
		$I->click(MainView::$maintenanceButton);

		$I->waitForElement(Generals::$pageTitle);
		$I->see(MaintenancePage::$heading);

		$I->click(MaintenancePage::$settingsButton);
		$I->see(MaintenancePage::$headingSettings);

		$I->click(MaintenancePage::$cancelSettingsButton);
	}

	/**
	 * Test method to logout from backend
	 *
	 * @param   AcceptanceTester        $I
	 * @param   \Page\Login             $loginPage
	 *
	 * @group   component
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
