<?php
namespace Page;

//use Codeception\Module\WebDriver;
//use Codeception\PHPUnit\Constraint\Page;

/**
 * Class SubscriberManagerPage
 *
 * @package Page
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
 *
 * @since   2.0.0
 */
class SubscriberManagerPage
{
	/**
	 * url of current page
	 *
	 * @var string
	 *
	 * @since   2.0.0
	 */
	public static $url      = '/administrator/index.php?option=com_bwpostman&view=subscribers';
	public static $section  = 'subscriber';
	public static $wait_db  = 1;

	/*
	 * Declare UI map for this page here. CSS or XPath allowed.
	 * public static $usernameField = '#username';
	 * public static $formSubmitButton = "#mainForm input[type=submit]";
	 */

	public static $tab_confirmed   = ".//*[@id='bwpostman_subscribers_tabs']/dt[2]";
	public static $tab_unconfirmed = ".//*[@id='bwpostman_subscribers_tabs']/dt[3]";
	public static $tab_testers     = ".//*[@id='bwpostman_subscribers_tabs']/dt[3]";

	public static $first_list_link          = ".//*[@id='main-table']/tbody/tr[1]/td[2]/a";
	public static $first_list_entry_tab2    = ".//*[@id='ub0']";

	// search subscriber
	public static $search_for_list_id               = "filter_search_filter_chzn";
	public static $search_for_list                  = ".//*[@id='filter_search_filter_chzn']";
	public static $search_for_value                 = ".//*[@id='filter_search_filter_chzn']/div/ul/li[contains(text(), '%s')]";

	/**
	 * Array of sorting criteria values for this page
	 *
	 * @var array
	 *
	 * @since 2.0.0
	 */
	public static $sort_data_array  = array(
		'sort_criteria' => array(
			'firstname'     => 'First name',
			'gender'        => 'Gender',
			'email'         => 'Email',
			'Email format'  => 'Email format',
			'user_id'       => 'Joomla! User-ID',
			'mailinglists'  => '# Mailinglists',
			'id'            => 'ID',
			'name'          => 'Last name'
		),

		'sort_criteria_select' => array(
			'firstname'     => 'First name',
			'gender'        => 'Gender',
			'email'         => 'Email',
			'Email format'  => 'Mail format',
			'user_id'       => 'Joomla! User-ID',
			'mailinglists'  => '# subscribed mailing lists',
			'id'            => 'ID',
			'name'          => 'Name'
		),

		'select_criteria' => array(
			'name'          => 'a.name',
			'firstname'     => 'a.firstname',
			'gender'        => 'a.gender',
			'email'         => 'a.email',
			'Email format'  => 'a.emailformat',
			'user_id'       => 'a.user_id',
			'mailinglists'  => 'mailinglists',
			'id'            => 'a.id',
		),
	);

	/**
	 * Array of criteria to select from database
	 *
	 * @var array
	 *
	 * @since 2.0.0
	 */
	public static $query_criteria = array(
		'name'          => 'a.name',
		'firstname'     => 'a.firstname',
		'gender'        => 'a.gender',
		'email'         => 'a.email',
		'Email format'  => 'a.emailformat',
		'user_id'       => 'a.user_id',
		'mailinglists'  => 'mailinglists',
		'id'            => 'a.id',
	);

	public static $search_data_array  = array(
		// enter default 'search by' as last array element
		'search_by'            => array(
			".//*[@id='filter_search_filter_chzn']/div/ul/li[2]",
			".//*[@id='filter_search_filter_chzn']/div/ul/li[3]",
			".//*[@id='filter_search_filter_chzn']/div/ul/li[4]",
			".//*[@id='filter_search_filter_chzn']/div/ul/li[5]",
			".//*[@id='filter_search_filter_chzn']/div/ul/li[6]",
		),
		'search_val'           => array("xx", "Andreas"),
		// array of arrays: outer array per search value, inner arrays per 'search by'
		'search_res'           => array(array(0, 0, 0, 0, 0), array(2, 1, 3, 3, 3)),
	);
	public static $search_clear_val     = 'Abbott';

	// Filter mail format
	public static $format_list_id       = "filter_emailformat_chzn";
	public static $format_list          = ".//*[@id='filter_emailformat_chzn']/a";
	public static $format_none          = ".//*[@id='filter_emailformat_chzn']/div/ul/li[text()='Select email format']";
	public static $format_text          = ".//*/li[text()='Text']";
	public static $format_html          = ".//*/li[text()='HTML']";
	public static $format_text_column   = ".//*[@id='j-main-container']/div[2]/div/dd[1]/table/tbody/*/td[5]";
	public static $format_text_text     = 'Text';
	public static $format_text_html     = 'HTML';

	// Filter mailinglist
	public static $ml_list_id       = "filter_mailinglist_chzn";
	public static $ml_list          = ".//*[@id='filter_mailinglist_chzn']/a";
	public static $ml_select        = ".//*/li[text()='04 Mailingliste 14 A']";


	public static $filter_subs_result   = array(
											'c.abbott@tester-net.nil',
											'c.breidenbach@tester-net.nil',
											'a.daum@tester-net.nil',
											'erwin.haeberle@tester-net.nil',
											'i.lueck@tester-net.nil',
											's.otte@tester-net.nil',
											'nils.rhodes@tester-net.nil',
											'l.wunderlich@tester-net.nil',
											'lili.zech@tester-net.nil'
										);

	public static $pagination_data_array  = array(
		'p1_val1'              => "Abbott",
		'p1_field1'            => ".//*[@id='j-main-container']/div[2]/div/dd[1]/table/tbody/tr[1]/td[2]",
		'p1_val_last'          => "Alexander",
		'p1_field_last'        => ".//*[@id='j-main-container']/div[2]/div/dd[1]/table/tbody/tr[10]/td[2]",

		'p2_val1'              => "Altmann",
		'p2_field1'            => ".//*[@id='j-main-container']/div[2]/div/dd[1]/table/tbody/tr[1]/td[2]",
		'p2_val_last'          => "Atkins",
		'p2_field_last'        => ".//*[@id='j-main-container']/div[2]/div/dd[1]/table/tbody/tr[10]/td[2]",

		'p3_val1'              => "Auer",
		'p3_field1'            => ".//*[@id='j-main-container']/div[2]/div/dd[1]/table/tbody/tr[1]/td[2]",
		'p3_val3'              => "Barrenbruegge",
		'p3_field3'            => ".//*[@id='j-main-container']/div[2]/div/dd[1]/table/tbody/tr[10]/td[2]",

		'p_prev_val1'          => "Willis",
		'p_prev_field1'        => ".//*[@id='j-main-container']/div[2]/div/dd[1]/table/tbody/tr[1]/td[2]",
		'p_prev_val_last'      => "Zabel",
		'p_prev_field_last'    => ".//*[@id='j-main-container']/div[2]/div/dd[1]/table/tbody/tr[10]/td[2]",

		'p_last_val1'          => "Zauner",
		'p_last_field1'        => ".//*[@id='j-main-container']/div[2]/div/dd[1]/table/tbody/tr[1]/td[2]",
		'p_last_val_last'      => "Zuschuss",
		'p_last_field_last'    => ".//*[@id='j-main-container']/div[2]/div/dd[1]/table/tbody/tr[8]/td[2]",
	);
	public static $arc_del_array    = array(
		'section'   => 'subscriber',
		'url'   => '/administrator/index.php?option=com_bwpostman&view=subscribers',
	);

	public static $import_csv_button    = ".//*[@id='fileformatcsv']";
	public static $import_xml_button    = ".//*[@id='fileformatxml']";

	public static $import_csv_file    = "import_demo.csv";
	public static $import_xml_file    = "import_demo.xml";

	public static $import_search_button = ".//*[@id='importfile']";

	public static $import_csv_delimiter = ".//*[@id='delimiter_chzn']/a/span";
	public static $import_csv_separator = ".//*[@id='enclosure_chzn']/a/span";
	public static $import_csv_caption   = ".//*[@id='caption']";

	public static $import_button_further = ".//*[@id='adminForm']/fieldset/div/div/table/tbody/tr[6]/td/input";
	public static $import_button_import  = ".//*[@id='adminForm']/fieldset[2]/div/table/tbody/tr/td/input";

	public static $import_legend_step_2 = ".//*[@id='adminForm']/fieldset[2]/legend";
	public static $import_legend_mls    = ".//*[@id='adminForm']/fieldset[2]/div/div[2]/fieldset/div[1]/div/fieldset/legend/span[2]";
	public static $import_legend_format = ".//*[@id='adminForm']/fieldset[2]/div/div[3]";

	public static $import_cb_text_format  = ".//*[@id='emailformat0']";
	public static $import_cb_html_format  = ".//*[@id='emailformat1']";
	public static $import_cb_confirm_subs = ".//*[@id='confirm']";

	public static $import_csv_field_0   = "Column_0 (name)";
	public static $import_csv_field_1   = "Column_1 (firstname)";
	public static $import_csv_field_2   = "Column_2 (email)";
	public static $import_csv_field_3   = "Column_3 (emailformat)";
	public static $import_csv_field_4   = "Column_4 (status)";

	public static $import_xml_field_0   = "Field_0 (name)";
	public static $import_xml_field_1   = "Field_1 (firstname)";
	public static $import_xml_field_2   = "Field_2 (email)";
	public static $import_xml_field_3   = "Field_3 (emailformat)";
	public static $import_xml_field_4   = "Field_4 (status)";

	public static $import_csv_subscribers   = array(
		array(
			'name' => 'Muster',
			'firstname' => 'Max',
			'email' => 'test1@test-domain.nul',
			'emailformat' => '1',
			'status' => '1',
		),
		array(
			'name' => 'Muster',
			'firstname' => 'Moritz',
			'email' => 'test2@test-domain.nul',
			'emailformat' => '1',
			'status' => '1',
		),
		array(
			'name' => 'Muster',
			'firstname' => 'Brunhilde',
			'email' => 'test3@test-domain.nul',
			'emailformat' => '1',
			'status' => '1',
		),
		array(
			'name' => 'Muster',
			'firstname' => 'Adelgunde',
			'email' => 'test4@test-domain.nul',
			'emailformat' => '1',
			'status' => '1',
		),
		array(
			'name' => 'Muster',
			'firstname' => 'Erika',
			'email' => 'test5@test-domain.nul',
			'emailformat' => '1',
			'status' => '1',
		),
		array(
			'name' => 'Muster',
			'firstname' => 'Eugen',
			'email' => 'test6@test-domain.nul',
			'emailformat' => '0',
			'status' => '1',
		),
	);

	public static $import_xml_subscribers   = array(
		array(
			'name' => 'Muster',
			'firstname' => 'Maximilian',
			'email' => 'test7@test-domain.nul',
			'emailformat' => '1',
			'status' => '1',
		),
		array(
			'name' => 'Muster',
			'firstname' => 'Emil',
			'email' => 'test8@test-domain.nul',
			'emailformat' => '1',
			'status' => '1',
		),
		array(
			'name' => 'Muster',
			'firstname' => 'Hanni',
			'email' => 'test9@test-domain.nul',
			'emailformat' => '1',
			'status' => '1',
		),
		array(
			'name' => 'Muster',
			'firstname' => 'Nanni',
			'email' => 'test10@test-domain.nul',
			'emailformat' => '1',
			'status' => '1',
		),
	);

	public static $import_mls_target    = ".//*[@id='adminForm']/fieldset[2]/div/div[2]/fieldset/div[1]/div/fieldset/div/p[2]/label";

	public static $import_msg_success   = "The import has successfully been completed.";

	public static $export_csv_confirmed   = ".//*[@id='status1']";
	public static $export_csv_unconfirmed = ".//*[@id='status0']";
	public static $export_csv_testers     = ".//*[@id='status9']";

	public static $export_csv_unarchived = ".//*[@id='archive0']";
	public static $export_csv_archived   = ".//*[@id='archive1']";

	public static $export_legend_fields = ".//*[@id='adminForm']/fieldset/div/table/tbody/tr[5]/td[1]";

	public static $export_button_up     = ".//*[@id='adminForm']/fieldset/div/table/tbody/tr[5]/td[2]/span[1]/input";
	public static $export_button_down   = ".//*[@id='adminForm']/fieldset/div/table/tbody/tr[5]/td[2]/span[2]/input";
	public static $export_button_remove = ".//*[@id='adminForm']/fieldset/div/table/tbody/tr[5]/td[2]/span[3]/input";
	public static $export_button_export = ".//*[@id='adminForm']/fieldset/div/table/tbody/tr[6]/td/input";

	/**
	 * @param \AcceptanceTester $I
	 * @param boolean           $activated
	 *
	 * @since 2.0.0
	 */
	public static function gotoSubscribersListTab(\AcceptanceTester $I, $activated)
	{
		if ($activated)
		{
			$tab = self::$tab_confirmed;
		}
		else
		{
			$tab = self::$tab_unconfirmed;
		}

		$I->amOnPage(self::$url);
		$I->see('Subscribers', Generals::$pageTitle);
		$I->clickAndWait($tab, 1);
	}

	/**
	 * @param \AcceptanceTester $I
	 * @param string            $search_value
	 * @param string            $search_for_value
	 *
	 * @since 2.0.0
	 */
	public static function filterForSubscriber(\AcceptanceTester $I, $search_value, $search_for_value)
	{
		$I->fillField(Generals::$search_field, $search_value);
		$I->clickAndWait(Generals::$filterbar_button, 1);
		$I->clickSelectList(Generals::$search_list, $search_for_value, self::$search_for_list_id);
		$I->clickAndWait(Generals::$search_button, 1);
	}

}
