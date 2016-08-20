<?php
use Page\Generals as Generals;
use Page\NewsletterEditPage as NlEdit;
use Page\NewsletterManagerPage as NlManage;
use Page\MainviewPage as MainView;

// @ToDo: Check "entered" values for publish_up/_down, set usable values (diff between both values) and check result in FE

/**
 * Class TestNewslettersDetailsCest
 *
 * This class contains all methods to test manipulation of a single newsletter at back end
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

 * @since   2.0.0
 */
class TestNewslettersDetailsCest
{
	/**
	 * Test method to login into backend
	 *
	 * @param   \Page\Login                 $loginPage
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
	 * Test method to create a single newsletter from main view and cancel creation
	 *
	 * @param   AcceptanceTester            $I
	 *
	 * @before  _login
	 *
	 * @after   _logout
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function CreateOneNewsletterCancelMainView(AcceptanceTester $I)
	{
		$I->wantTo("Create one Newsletter and cancel from main view");
		$I->amOnPage(MainView::$url);
		$I->waitForElement(Generals::$pageTitle);
		$I->see(Generals::$extension, Generals::$pageTitle);
		$I->click(MainView::$addNewsletterButton);

		$this->_fillFormSimple($I);
 		$I->click(NlEdit::$toolbar['Back']);

		$I->see(Generals::$extension, Generals::$pageTitle);
	}

	/**
	 * Test method to create a single newsletter from main view, save it and go back to main view
	 *
	 * @param   AcceptanceTester            $I
	 *
	 * @before  _login
	 *
	 * @after   _logout
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function CreateOneNewsletterCompleteMainView(AcceptanceTester $I)
	{
		$I->wantTo("Create one Newsletter, archive and delete from main view");
		$I->amOnPage(MainView::$url);
		$I->waitForElement(Generals::$pageTitle);
		$I->see(Generals::$extension, Generals::$pageTitle);
		$I->click(MainView::$addNewsletterButton);

		$this->_fillFormSimpleWithCampaign($I);

		$I->click(NlEdit::$toolbar['Save & Close']);
		$this->_checkSuccess($I);

		$I->HelperArcDelItems($I, new NlManage(), new NlEdit());
		$I->see('Newsletters', Generals::$pageTitle);
	}

	/**
	 * Test method to create a single Newsletter from list view and cancel creation
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
	public function CreateOneNewsletterCancelListView(AcceptanceTester $I)
	{
		$I->wantTo("Create one Newsletter cancel list view");
		$I->amOnPage(NlManage::$url);

		$I->click(Generals::$toolbar['New']);

		$this->_fillFormExtended($I);

        $I->click(NlEdit::$toolbar['Cancel']);
        $I->see("Newsletters", Generals::$pageTitle);
	}

	/**
	 * Test method to create a single Newsletter from list view, save it and go back to list view
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
	public function CreateOneNewsletterListView(AcceptanceTester $I)
	{
		$I->wantTo("Create one Newsletter list view");
		$I->amOnPage(NlManage::$url);

		$I->click(Generals::$toolbar['New']);

		$this->_fillFormSimple($I);

		$I->click(NlEdit::$toolbar['Save & Close']);

		$I->waitForElement(Generals::$alert_header);
		$this->_checkSuccess($I);

		$I->HelperArcDelItems($I, new NlManage(), new NlEdit());
		$I->see('Newsletters', Generals::$pageTitle);
	}

	/**
	 * Test method to create multiple newsletters from list view
	 * this is only to create automated some test data!!!!!
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
/*	public function CreateMultipleNewslettersListView(AcceptanceTester $I)
	{
		$I->wantTo("Create multiple Newsletters from list view");
		$I->amOnPage(NlManage::$url);

		for ($i = 1; $i <= 25; $i++)
		{
			$I->click(Generals::$toolbar['New']);

			$I->fillField(NlEdit::$from_name, NlEdit::$field_from_name);
			$I->fillField(NlEdit::$from_email, NlEdit::$field_from_email);
			$I->fillField(NlEdit::$reply_email, NlEdit::$field_reply_email);
			$I->fillField(NlEdit::$subject, 'Newsletter for testing ' . $i);
			$I->fillField(NlEdit::$description, NlEdit::$field_description . ' ' . $i);

			//select attachment
			if (($i % 3) == 0)
			{
				Helper->fillReadonlyInput($I, NlEdit::$attachment_id, NlEdit::$attachment, NlEdit::$field_attachment);
			}

			// fill publish and unpublish
			if (($i % 4) == 0)
			{
				$I->click(NlEdit::$publish_up_button);
				$I->clickAndWait(NlEdit::$today_up, 1);
				$I->click(NlEdit::$publish_down_button);
				$I->clickAndWait(NlEdit::$today_down, 1);
			}

			$I->scrollTo(NlEdit::$legend_templates);
			$I->click(NlEdit::$template_html);
			$I->click(NlEdit::$template_text);

			$I->scrollTo(NlEdit::$legend_recipients);
			$I->click(sprintf(NlEdit::$mls_accessible, 2));
			//		$I->click(sprintf(NlEdit::$mls_nonaccessible, 3));
			//		$I->click(sprintf(NlEdit::$mls_internal, 4));

			$I->scrollTo(NlEdit::$legend_content);
			$I->doubleClick(sprintf(NlEdit::$available_content, ($i % 6) + 1));
//			$I->wait(2);

		$I->click(NlEdit::$toolbar['Save & Close']);

		$I->waitForElement(Generals::$alert_header);
		$I->see("Message", Generals::$alert_header);
		$I->see(NlEdit::$success_saved, Generals::$alert_msg);
	}
	}
*/
	/**
	 * Test method to create same single Newsletter twice from main view
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
	public function CreateNewsletterTwiceListView(AcceptanceTester $I)
	{
		$I->wantTo("Create Newsletter twice list view");
		$I->amOnPage(NlManage::$url);

		$I->click(Generals::$toolbar['New']);

		$this->_fillFormSimple($I);

		$I->click(NlEdit::$toolbar['Save & Close']);
		$this->_checkSuccess($I);
		$I->see('Newsletters', Generals::$pageTitle);

		$I->click(Generals::$toolbar['New']);

		$this->_fillFormSimple($I);

		$I->click(NlEdit::$toolbar['Save & Close']);
		$this->_checkSuccess($I);

		$I->see(Generals::$alert_warn_txt, Generals::$alert_header);
		$I->see(sprintf(NlEdit::$warn_save, NlEdit::$field_subject), Generals::$alert);

		$I->see("Newsletters", Generals::$pageTitle);

		$I->HelperArcDelItems($I, new NlManage(), new NlEdit());
		$I->see('Newsletters', Generals::$pageTitle);
	}

	/**
	 * Test method to create send newsletter to test recipients
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
	public function SendNewsletterToTestrecipients(AcceptanceTester $I)
	{
		$I->wantTo("Send newsletter to test recipients");
		$I->amOnPage(NlManage::$url);

		$I->click(Generals::$toolbar['New']);

		$content_title = $this->_fillFormSimple($I);

		$start  = strpos($content_title, "=") + 2;
		$content_title  = substr($content_title, $start);

		// change to tab 2
		$I->scrollTo(Generals::$sys_message_container, 0, -100);
		$I->click(NlEdit::$tab2);
		$I->switchToIFrame(NlEdit::$tab2_iframe);
		$I->wait(1);
		$I->see($content_title, NlEdit::$tab2_editor);
		$I->switchToIFrame();

		// change to tab 3
		$I->click(NlEdit::$tab3);
		$I->see($content_title, NlEdit::$tab3_editor);


		// change to tab 4
		$I->click(NlEdit::$tab4);
		$I->scrollTo(NlEdit::$tab4_preview_html);
		$I->switchToIFrame(NlEdit::$tab4_preview_html_iframe);
		$I->scrollTo(NlEdit::$tab4_preview_html_divider, 0, 20); // scroll to divider before article
		$I->wait(1);
		$I->see($content_title, NlEdit::$preview_html);
		$I->switchToIFrame();
		$I->switchToIFrame(NlEdit::$tab4_preview_text_iframe);
		$I->see($content_title, NlEdit::$preview_text);
		$I->switchToIFrame();

		// change to tab 5
		$I->scrollTo(Generals::$sys_message_container, 0, -100);
		$I->click(NlEdit::$tab5);
		$I->click(NlEdit::$button_send_test);

		$I->seeInPopup(NlEdit::$popup_send_confirm);
		$I->acceptPopup();

		$I->wait(2);
		$I->switchToIFrame(NlEdit::$tab5_send_iframe);
		$I->see(NlEdit::$success_send);
		$I->switchToIFrame();
		$I->wait(5);

		$I->see("Newsletters", Generals::$pageTitle);
	}

	/**
	 * Test method to create copy newsletter and send to real recipients
	 *
	 * @param   AcceptanceTester                $I
	 *
	 * @before  _login
	 *
	 * @after   _logout
	 *
	 * depends SendNewsletterToTestrecipients
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function SendCopyOfNewsletterToRealRecipients(AcceptanceTester $I)
	{
		$I->wantTo("Send a copy of a newsletter to real recipients");
		$I->amOnPage(NlManage::$url);

		$I->click(Generals::$first_list_entry);
		$I->clickAndWait(Generals::$toolbar['Duplicate'], 1);
		$I->see(NlEdit::$duplicate_prefix . NlEdit::$field_subject . "'");

		$I->click(NlEdit::$mark_to_send);
		$I->click(Generals::$toolbar['Send']);
		$I->see(NlEdit::$tab5_legend1);
		$I->click(NlEdit::$button_send);

		$I->seeInPopup(NlEdit::$popup_send_confirm);
		$I->acceptPopup();

		$I->wait(5);
		$I->switchToIFrame(NlEdit::$tab5_send_iframe);
		$I->see(NlEdit::$success_send);
		$I->switchToIFrame();
		$I->wait(15);

		$I->see("Newsletters", Generals::$pageTitle);
		$I->HelperArcDelItems($I, new NlManage(), new NlEdit());
		$I->see('Newsletters', Generals::$pageTitle);

		$I->clickAndWait(NlManage::$tab2, 1);
		$I->HelperArcDelItems($I, new NlManage(), new NlEdit());
		$I->see('Newsletters', Generals::$pageTitle);
	}

		/**
	 * Test method to logout from backend
	 *
	 * @param   AcceptanceTester    $I
	 * @param   \Page\Login         $loginPage
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function _logout(AcceptanceTester $I, \Page\Login $loginPage)
	{
		$loginPage->logoutFromBackend($I);
	}

	/**
	 * Test method to logout from backend
	 *
	 * @param   AcceptanceTester    $I
	 *
	 * @return  void
	 *
	 * @since   2.0.0
	 */
	public function _failed (AcceptanceTester $I){

	}

	/**
	 * Method to fill form without campaign ( that is: selecting other recipients) without check of required fields
	 * This method simply fills all fields, required or not
	 *
	 * @param AcceptanceTester $I
	 *
	 * @return string   $content_title  title of content
	 *
	 * @since   2.0.0
	 */
	private function _fillFormSimple(AcceptanceTester $I)
	{
		$I->fillField(NlEdit::$from_name, NlEdit::$field_from_name);
		$I->fillField(NlEdit::$from_email, NlEdit::$field_from_email);
		$I->fillField(NlEdit::$reply_email, NlEdit::$field_reply_email);
		$I->fillField(NlEdit::$subject, NlEdit::$field_subject);
		$I->fillField(NlEdit::$description, NlEdit::$field_description);

		//select attachment
		$this->_selectAttachment($I);

		// fill publish and unpublish
		$this->_fillPublishedDate($I);

		$I->scrollTo(NlEdit::$legend_templates);
		$I->click(NlEdit::$template_html);
		$I->click(NlEdit::$template_text);

		$this->_selectRecipients($I);

		// add content
		$I->scrollTo(NlEdit::$legend_content);
		$I->doubleClick(sprintf(NlEdit::$available_content, 2));
		$content_title = $I->grabTextFrom(sprintf(NlEdit::$selected_content, 1));
		$I->see($content_title, NlEdit::$selected_content_list);

		return $content_title;
	}

	/**
	 * Method to fill form with campaign (no other recipients to select) without check of required fields
	 * This method simply fills all fields, required or not
	 *
	 * @param AcceptanceTester $I
	 *
	 * @return string   $content_title  title of content
	 *
	 * @since   2.0.0
	 */
	private function _fillFormSimpleWithCampaign(AcceptanceTester $I)
	{
		$I->fillField(NlEdit::$from_name, NlEdit::$field_from_name);
		$I->fillField(NlEdit::$from_email, NlEdit::$field_from_email);
		$I->fillField(NlEdit::$reply_email, NlEdit::$field_reply_email);
		$I->fillField(NlEdit::$subject, NlEdit::$field_subject);
		$I->fillField(NlEdit::$description, NlEdit::$field_description);

		// select campaign
		$I->selectOption(NlEdit::$campaign, NlEdit::$campaign_selected);
		$I->dontSeeElement(NlEdit::$legend_recipients);

		//select attachment
		$this->_selectAttachment($I);

		// fill publish and unpublish
		$this->_fillPublishedDate($I);

		$I->scrollTo(NlEdit::$legend_templates);
		$I->click(NlEdit::$template_html);
		$I->click(NlEdit::$template_text);

		$content_1 = $I->grabTextFrom(sprintf(NlEdit::$available_content, 2));
		$I->click(sprintf(NlEdit::$available_content, 2));
		$I->click(NlEdit::$add_content);
		$I->see($content_1, NlEdit::$selected_content_list);
		$I->dontSee($content_1, NlEdit::$available_content_list);
	}

	/**
	 * Method to fill form with check of required fields
	 * This method fills in the end all fields, but meanwhile all required fields are omitted, one by one,
	 * to check if the related messages appears
	 * This method also checks removing content
	 *
	 * @param AcceptanceTester $I
	 *
	 * @since   2.0.0
	 */
	private function _fillFormExtended(AcceptanceTester $I)
	{
		// omit recipients
		$I->click(NlEdit::$toolbar['Save']);
		$I->seeInPopup(NlEdit::$msg_no_recipients);
		$I->acceptPopup();

		// always select recipients, without that other warnings don't appear
		$this->_selectRecipients($I);

		// omit from_name
		$I->scrollTo(NlEdit::$legend_general);
		$I->fillField(NlEdit::$from_name, '');
		$I->clickAndWait(NlEdit::$description, 1);
		$I->click(NlEdit::$toolbar['Save']);
		$I->see(Generals::$alert_warn_txt);
		$I->see(NlEdit::$msg_required_sender_name, Generals::$alert_msg);

		// omit from_email
		$this->_selectRecipients($I);
		$I->scrollTo(NlEdit::$legend_general);
		$I->fillField(NlEdit::$from_name, NlEdit::$field_from_name);
		$I->fillField(NlEdit::$from_email, '');
		$I->clickAndWait(NlEdit::$description, 1);
		$I->click(NlEdit::$toolbar['Save']);
		$I->see(Generals::$alert_warn_txt);
		$I->see(NlEdit::$msg_required_sender_email, Generals::$alert_msg);

		// omit reply_email
		$this->_selectRecipients($I);
		$I->scrollTo(NlEdit::$legend_general);
		$I->fillField(NlEdit::$from_name, NlEdit::$field_from_name);
		$I->fillField(NlEdit::$from_email, NlEdit::$field_reply_email);
		$I->fillField(NlEdit::$reply_email, '');
		$I->clickAndWait(NlEdit::$description, 1);
		$I->click(NlEdit::$toolbar['Save']);
		$I->see(Generals::$alert_warn_txt);
		$I->see(NlEdit::$msg_required_replyto_email, Generals::$alert_msg);

		// omit subject
		$this->_selectRecipients($I);
		$I->scrollTo(NlEdit::$legend_general);
		$I->fillField(NlEdit::$from_name, NlEdit::$field_from_name);
		$I->fillField(NlEdit::$from_email, NlEdit::$field_from_email);
		$I->fillField(NlEdit::$reply_email, NlEdit::$field_reply_email);
		$I->fillField(NlEdit::$subject, '');
		$I->clickAndWait(NlEdit::$description, 1);
		$I->click(NlEdit::$toolbar['Save']);
		$I->see(Generals::$alert_warn_txt);
		$I->see(NlEdit::$msg_required_subject, Generals::$alert_msg);

		$this->_selectRecipients($I);
		$I->scrollTo(NlEdit::$legend_general);
		$I->fillField(NlEdit::$from_email, NlEdit::$field_from_email);
		$I->fillField(NlEdit::$reply_email, NlEdit::$field_reply_email);
		$I->fillField(NlEdit::$subject, NlEdit::$field_subject);
		$I->fillField(NlEdit::$description, NlEdit::$field_description);
		$I->clickAndWait(NlEdit::$description, 1);

		//select attachment
		$this->_selectAttachment($I);

		// fill publish and unpublish
		$this->_fillPublishedDate($I);

		$I->scrollTo(NlEdit::$legend_templates);
		$I->wait(1);
		$I->click(NlEdit::$template_html);
		$I->click(NlEdit::$template_text);
		$I->scrollTo(NlEdit::$legend_recipients);

		// add content
		$I->scrollTo(NlEdit::$legend_content);
		// …by button
		$I->click(sprintf(NlEdit::$available_content, 5));
		$I->click(NlEdit::$add_content);
		// … by double click
		$I->doubleClick(sprintf(NlEdit::$available_content, 4));
		$I->doubleClick(sprintf(NlEdit::$available_content, 2));

		// remove content
		// …by button
		$I->click(sprintf(NlEdit::$selected_content, 3));
		$I->click(NlEdit::$remove_content);
		// …by double click
		$I->doubleClick(sprintf(NlEdit::$selected_content, 1));
		$I->wait(1);
	}

	/**
	 * Method to select attachment for newsletter
	 *
	 * @param AcceptanceTester $I
	 *
	 * @since   2.0.0
	 */
	private function _selectAttachment(AcceptanceTester $I)
	{
		$I->clickAndWait(NlEdit::$attachment_select_button, 1);
		$I->switchToIFrame(Generals::$media_frame);
		$I->switchToIFrame(Generals::$image_frame);
		$I->clickAndWait(NlEdit::$attachment_select, 1);
		$I->switchToIFrame();
		$I->switchToIFrame(Generals::$media_frame);
		$I->clickAndWait(NlEdit::$attachment_insert, 1);
		$I->switchToIFrame();
	}

	/**
	 * Method to check success for filling form
	 *
	 * @param AcceptanceTester $I
	 *
	 * @since   2.0.0
	 */
	private function _checkSuccess(AcceptanceTester $I)
	{
		$I->see("Message", Generals::$alert_header);
		$I->see(NlEdit::$success_saved, Generals::$alert_msg);

		$I->see(NlEdit::$field_subject, NlEdit::$success_inList_subject);
		$I->see(NlEdit::$field_description, NlEdit::$success_inList_desc);
		$I->see(Generals::$admin['author'], NlEdit::$success_inList_author);
	}

	/**
	 * Method to select recipients for newsletter
	 *
	 * @param AcceptanceTester $I
	 *
	 * @since   2.0.0
	 */
	private function _selectRecipients(AcceptanceTester $I)
	{
		$I->scrollTo(NlEdit::$legend_recipients);
		$I->click(sprintf(Generals::$mls_accessible, 2));
//		$I->click(sprintf(Generals::$mls_nonaccessible, 3));
//		$I->click(sprintf(Generals::$mls_internal, 4));
	}

	/**
	 * Method to fill published and unpublished fields
	 *
	 * @param AcceptanceTester $I
	 *
	 * @since   2.0.0
	 */
	private function _fillPublishedDate(AcceptanceTester $I)
	{
		$I->clickAndWait(NlEdit::$publish_up_button, 1);
		$I->clickAndWait(NlEdit::$today_up, 1);
		$I->clickAndWait(NlEdit::$publish_down_button, 1);
		$I->clickAndWait(NlEdit::$today_down, 1);
	}
}