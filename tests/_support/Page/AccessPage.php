<?php
namespace Page;

/**
 * Class CampaignEditPage
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
class AccessPage
{
    // set array with all users
	public static $all_users = array(   array('user' =>'BwPostmanAdmin', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanAdmin'),
										array('user' =>'BwPostmanManager', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanManager'),
										array('user' =>'BwPostmanPublisher', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanPublisher'),
										array('user' =>'BwPostmanEditor', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanEditor'),
										array('user' =>'BwPostmanCampaignAdmin', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanCampaignAdmin'),
										array('user' =>'BwPostmanCampaignPublisher', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanCampaignPublisher'),
										array('user' =>'BwPostmanCampaignEditor', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanCampaignEditor'),
										array('user' =>'BwPostmanMailinglistAdmin', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanMailinglistAdmin'),
										array('user' =>'BwPostmanMailinglistPublisher', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanMailinglistPublisher'),
										array('user' =>'BwPostmanMailinglistEditor', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanMailinglistEditor'),
										array('user' =>'BwPostmanNewsletterAdmin', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanNewsletterAdmin'),
										array('user' =>'BwPostmanNewsletterPublisher', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanNewsletterPublisher'),
										array('user' =>'BwPostmanNewsletterEditor', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanNewsletterEditor'),
										array('user' =>'BwPostmanSubscriberAdmin', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanSubscriberAdmin'),
										array('user' =>'BwPostmanSubscriberPublisher', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanSubscriberPublisher'),
										array('user' =>'BwPostmanSubscriberEditor', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanSubscriberEditor'),
										array('user' =>'BwPostmanTemplateAdmin', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanTemplateAdmin'),
										array('user' =>'BwPostmanTemplatePublisher', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanTemplatePublisher'),
										array('user' =>'BwPostmanTemplateEditor', 'password' =>'BwPostmanTest', 'author' => 'BwPostmanTemplateEditor'),
									);

	// set variables with links from main view
	public static $main_list_buttons   = array(
		'Newsletters'        => ".//*[@id='cpanel']/div/div/a/span[.='Newsletters']",
		'Subscribers'        => ".//*[@id='cpanel']/div/div/a/span[.='Subscribers']",
		'Campaigns'          => ".//*[@id='cpanel']/div/div/a/span[.='Campaigns']",
		'Mailinglists'       => ".//*[@id='cpanel']/div/div/a/span[.='Mailinglists']",
		'Templates'          => ".//*[@id='cpanel']/div/div/a/span[.='Templates']",
		'Archive'            => ".//*[@id='cpanel']/div/div/a/span[.='Archive']",
		'Basic settings'     => ".//*[@id='cpanel']/div/div/a/span[.='Basic settings']",
		'Maintenance'        => ".//*[@id='cpanel']/div/div/a/span[.='Maintenance']",
	);

	public static $main_add_buttons   = array(
		'Newsletter'        => ".//*[@id='cpanel']/div/div/a/span[.='Add newsletter']",
		'Subscriber'        => ".//*[@id='cpanel']/div/div/a/span[.='Add subscriber']",
		'Test-Recipient'    => ".//*[@id='cpanel']/div/div/a/span[.='Add Test-Recipient']",
		'Campaign'          => ".//*[@id='cpanel']/div/div/a/span[.='Add campaign']",
		'Mailinglist'       => ".//*[@id='cpanel']/div/div/a/span[.='Add mailinglist']",
		'HTML-Template'     => ".//*[@id='cpanel']/div/div/a/span[.='Add HTML-Template']",
		'Text-Template'     => ".//*[@id='cpanel']/div/div/a/span[.='Add Text-Template']",
	);

	public static $forum_icon       = ".//*[@id='cpanel']/div/div/a/span[.='BwPostman Forum']";
	public static $help_button      = ".//*[@id='toolbar-help']/button";
	public static $options_button   = ".//*[@id='toolbar-options']/button";

	// statistics pane
	public static $link_statistics_general  = ".//*[@id='bwpostman_statistic-pane']/div/h3/a/span[.=' General statistics']";
	public static $table_statistics_general = ".//*[@id='bwpostman_statistic-pane']/div[2]/div/table";

	public static $link_statistics_archive  = ".//*[@id='bwpostman_statistic-pane']/div/h3/a/span[.=' Archive statistics']";
	public static $table_statistics_archive = ".//*[@id='bwpostman_statistic-pane']/div[3]/div/table";

	public static $statistics_general   = array(
		'Newsletters'       => array(
			".//*[@id='bwpostman_statistic-pane']/div/div/table/tbody/tr/td[.='# Unsent newsletters: ']",
			".//*[@id='bwpostman_statistic-pane']/div/div/table/tbody/tr/td[.='# Sent newsletters: ']",
		),
		'Subscribers'       => array(
			".//*[@id='bwpostman_statistic-pane']/div/div/table/tbody/tr/td[.='# Subscribers: ']",
			".//*[@id='bwpostman_statistic-pane']/div/div/table/tbody/tr/td[.='# Test-Recipients: ']",
		),
		'Campaigns'       => array(
			".//*[@id='bwpostman_statistic-pane']/div/div/table/tbody/tr/td[.='# Campaigns: ']",
		),
		'Mailinglists'       => array(
			".//*[@id='bwpostman_statistic-pane']/div/div/table/tbody/tr/td[.='# Public mailinglists: ']",
			".//*[@id='bwpostman_statistic-pane']/div/div/table/tbody/tr/td[.='# Internal mailinglists: ']",
		),
		'Templates'       => array(
			".//*[@id='bwpostman_statistic-pane']/div/div/table/tbody/tr/td[.='# HTML-Templates: ']",
			".//*[@id='bwpostman_statistic-pane']/div/div/table/tbody/tr/td[.='# Text-Templates: ']",
		),
	);

	public static $statistics_archive   = array(
		'Newsletters'       => array(
			".//*[@id='bwpostman_statistic-pane']/div/div/table/tbody/tr/td[.='# Archived newsletters: ']",
		),
		'Subscribers'       => array(
			".//*[@id='bwpostman_statistic-pane']/div/div/table/tbody/tr/td[.='# Archived subscribers: ']",
		),
		'Campaigns'       => array(
			".//*[@id='bwpostman_statistic-pane']/div/div/table/tbody/tr/td[.='# Archived campaigns: ']",
		),
		'Mailinglists'       => array(
			".//*[@id='bwpostman_statistic-pane']/div/div/table/tbody/tr/td[.='# Archived mailinglists: ']",
		),
		'Templates'       => array(
			".//*[@id='bwpostman_statistic-pane']/div/div/table/tbody/tr/td[.='# Archived HTML-Templates: ']",
			".//*[@id='bwpostman_statistic-pane']/div/div/table/tbody/tr/td[.='# Archived Text-Templates: ']",
		),
	);

	public static $j_menu_components     = ".//*[@id='menu']/li/a[contains(text(), 'Components')]";
	public static $j_menu_bwpostman      = ".//*[@id='menu']/li/ul/li/a[contains(text(), 'BwPostman')]";

	public static $j_menu_bwpostman_sub         = ".//*[@id='nav-empty']";
	public static $j_menu_bwpostman_sub_item    = ".//*[@id='nav-empty']/li/a[contains(text(), '%s')]";
	public static $list_view_no_permission      = "No permission for view %s.";

	public static $checkbox_identifier  = ".//*[@id='cb%s']";
	public static $checkout_icon        = ".//*[@id='main-table']/tbody/tr[%s]/td[%s]/a/span[contains(@class, 'icon-checkedout')]";


	// set permission variables
	// set list view permission arrays
	public static $BwPostmanAdmin_main_list_permissions = array(
		'Newsletters'       => true,
		'Subscribers'       => true,
		'Campaigns'         => true,
		'Mailinglists'      => true,
		'Templates'         => true,
		'Archive'           => true,
		'Basic settings'    => true,
		'Maintenance'       => true,
	);

	public static $BwPostmanManager_main_list_permissions = array(
		'Newsletters'       => true,
		'Subscribers'       => true,
		'Campaigns'         => true,
		'Mailinglists'      => true,
		'Templates'         => true,
		'Archive'           => true,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	public static $BwPostmanPublisher_main_list_permissions = array(
		'Newsletters'       => true,
		'Subscribers'       => true,
		'Campaigns'         => true,
		'Mailinglists'      => true,
		'Templates'         => true,
		'Archive'           => false,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	public static $BwPostmanEditor_main_list_permissions = array(
		'Newsletters'       => true,
		'Subscribers'       => true,
		'Campaigns'         => true,
		'Mailinglists'      => true,
		'Templates'         => true,
		'Archive'           => false,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	public static $BwPostmanCampaignAdmin_main_list_permissions = array(
		'Newsletters'       => false,
		'Subscribers'       => false,
		'Campaigns'         => true,
		'Mailinglists'      => false,
		'Templates'         => false,
		'Archive'           => true,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	public static $BwPostmanCampaignPublisher_main_list_permissions = array(
		'Newsletters'       => false,
		'Subscribers'       => false,
		'Campaigns'         => true,
		'Mailinglists'      => false,
		'Templates'         => false,
		'Archive'           => false,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	public static $BwPostmanCampaignEditor_main_list_permissions = array(
		'Newsletters'       => false,
		'Subscribers'       => false,
		'Campaigns'         => true,
		'Mailinglists'      => false,
		'Templates'         => false,
		'Archive'           => false,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	public static $BwPostmanMailinglistAdmin_main_list_permissions = array(
		'Newsletters'       => false,
		'Subscribers'       => false,
		'Campaigns'         => false,
		'Mailinglists'      => true,
		'Templates'         => false,
		'Archive'           => true,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	public static $BwPostmanMailinglistPublisher_main_list_permissions = array(
		'Newsletters'       => false,
		'Subscribers'       => false,
		'Campaigns'         => false,
		'Mailinglists'      => true,
		'Templates'         => false,
		'Archive'           => false,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	public static $BwPostmanMailinglistEditor_main_list_permissions = array(
		'Newsletters'       => false,
		'Subscribers'       => false,
		'Campaigns'         => false,
		'Mailinglists'      => true,
		'Templates'         => false,
		'Archive'           => false,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	public static $BwPostmanNewsletterAdmin_main_list_permissions = array(
		'Newsletters'       => true,
		'Subscribers'       => false,
		'Campaigns'         => false,
		'Mailinglists'      => false,
		'Templates'         => false,
		'Archive'           => true,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	public static $BwPostmanNewsletterPublisher_main_list_permissions = array(
		'Newsletters'       => true,
		'Subscribers'       => false,
		'Campaigns'         => false,
		'Mailinglists'      => false,
		'Templates'         => false,
		'Archive'           => false,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	public static $BwPostmanNewsletterEditor_main_list_permissions = array(
		'Newsletters'       => true,
		'Subscribers'       => false,
		'Campaigns'         => false,
		'Mailinglists'      => false,
		'Templates'         => false,
		'Archive'           => false,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	public static $BwPostmanSubscriberAdmin_main_list_permissions = array(
		'Newsletters'       => false,
		'Subscribers'       => true,
		'Campaigns'         => false,
		'Mailinglists'      => false,
		'Templates'         => false,
		'Archive'           => true,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	public static $BwPostmanSubscriberPublisher_main_list_permissions = array(
		'Newsletters'       => false,
		'Subscribers'       => true,
		'Campaigns'         => false,
		'Mailinglists'      => false,
		'Templates'         => false,
		'Archive'           => false,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	public static $BwPostmanSubscriberEditor_main_list_permissions = array(
		'Newsletters'       => false,
		'Subscribers'       => true,
		'Campaigns'         => false,
		'Mailinglists'      => false,
		'Templates'         => false,
		'Archive'           => false,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	public static $BwPostmanTemplateAdmin_main_list_permissions = array(
		'Newsletters'       => false,
		'Subscribers'       => false,
		'Campaigns'         => false,
		'Mailinglists'      => false,
		'Templates'         => true,
		'Archive'           => true,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	public static $BwPostmanTemplatePublisher_main_list_permissions = array(
		'Newsletters'       => false,
		'Subscribers'       => false,
		'Campaigns'         => false,
		'Mailinglists'      => false,
		'Templates'         => true,
		'Archive'           => false,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	public static $BwPostmanTemplateEditor_main_list_permissions = array(
		'Newsletters'       => false,
		'Subscribers'       => false,
		'Campaigns'         => false,
		'Mailinglists'      => false,
		'Templates'         => true,
		'Archive'           => false,
		'Basic settings'    => false,
		'Maintenance'       => false,
	);

	// set add permission arrays
	public static $BwPostmanAdmin_main_add_permissions = array(
		'Newsletter'        => true,
		'Subscriber'        => true,
		'Test-Recipient'    => true,
		'Campaign'          => true,
		'Mailinglist'       => true,
		'HTML-Template'     => true,
		'Text-Template'     => true,
	);


	public static $BwPostmanManager_main_add_permissions = array(
		'Newsletter'        => true,
		'Subscriber'        => true,
		'Test-Recipient'    => true,
		'Campaign'          => true,
		'Mailinglist'       => true,
		'HTML-Template'     => true,
		'Text-Template'     => true,
	);

	public static $BwPostmanPublisher_main_add_permissions = array(
		'Newsletter'        => true,
		'Subscriber'        => true,
		'Test-Recipient'    => true,
		'Campaign'          => true,
		'Mailinglist'       => true,
		'HTML-Template'     => true,
		'Text-Template'     => true,
	);

	public static $BwPostmanEditor_main_add_permissions = array(
		'Newsletter'        => true,
		'Subscriber'        => true,
		'Test-Recipient'    => true,
		'Campaign'          => true,
		'Mailinglist'       => true,
		'HTML-Template'     => true,
		'Text-Template'     => true,
	);

	public static $BwPostmanCampaignAdmin_main_add_permissions = array(
		'Newsletter'        => false,
		'Subscriber'        => false,
		'Test-Recipient'    => false,
		'Campaign'          => true,
		'Mailinglist'       => false,
		'HTML-Template'     => false,
		'Text-Template'     => false,
	);

	public static $BwPostmanCampaignPublisher_main_add_permissions = array(
		'Newsletter'        => false,
		'Subscriber'        => false,
		'Test-Recipient'    => false,
		'Campaign'          => true,
		'Mailinglist'       => false,
		'HTML-Template'     => false,
		'Text-Template'     => false,
	);

	public static $BwPostmanCampaignEditor_main_add_permissions = array(
		'Newsletter'        => false,
		'Subscriber'        => false,
		'Test-Recipient'    => false,
		'Campaign'          => true,
		'Mailinglist'       => false,
		'HTML-Template'     => false,
		'Text-Template'     => false,
	);

	public static $BwPostmanMailinglistAdmin_main_add_permissions = array(
		'Newsletter'        => false,
		'Subscriber'        => false,
		'Test-Recipient'    => false,
		'Campaign'          => false,
		'Mailinglist'       => true,
		'HTML-Template'     => false,
		'Text-Template'     => false,
	);

	public static $BwPostmanMailinglistPublisher_main_add_permissions = array(
		'Newsletter'        => false,
		'Subscriber'        => false,
		'Test-Recipient'    => false,
		'Campaign'          => false,
		'Mailinglist'       => true,
		'HTML-Template'     => false,
		'Text-Template'     => false,
	);

	public static $BwPostmanMailinglistEditor_main_add_permissions = array(
		'Newsletter'        => false,
		'Subscriber'        => false,
		'Test-Recipient'    => false,
		'Campaign'          => false,
		'Mailinglist'       => true,
		'HTML-Template'     => false,
		'Text-Template'     => false,
	);

	public static $BwPostmanNewsletterAdmin_main_add_permissions = array(
		'Newsletter'        => true,
		'Subscriber'        => false,
		'Test-Recipient'    => false,
		'Campaign'          => false,
		'Mailinglist'       => false,
		'HTML-Template'     => false,
		'Text-Template'     => false,
	);

	public static $BwPostmanNewsletterPublisher_main_add_permissions = array(
		'Newsletter'        => true,
		'Subscriber'        => false,
		'Test-Recipient'    => false,
		'Campaign'          => false,
		'Mailinglist'       => false,
		'HTML-Template'     => false,
		'Text-Template'     => false,
	);

	public static $BwPostmanNewsletterEditor_main_add_permissions = array(
		'Newsletter'        => true,
		'Subscriber'        => false,
		'Test-Recipient'    => false,
		'Campaign'          => false,
		'Mailinglist'       => false,
		'HTML-Template'     => false,
		'Text-Template'     => false,
	);

	public static $BwPostmanSubscriberAdmin_main_add_permissions = array(
		'Newsletter'        => false,
		'Subscriber'        => true,
		'Test-Recipient'    => true,
		'Campaign'          => false,
		'Mailinglist'       => false,
		'HTML-Template'     => false,
		'Text-Template'     => false,
	);

	public static $BwPostmanSubscriberPublisher_main_add_permissions = array(
		'Newsletter'        => false,
		'Subscriber'        => true,
		'Test-Recipient'    => true,
		'Campaign'          => false,
		'Mailinglist'       => false,
		'HTML-Template'     => false,
		'Text-Template'     => false,
	);

	public static $BwPostmanSubscriberEditor_main_add_permissions = array(
		'Newsletter'        => false,
		'Subscriber'        => true,
		'Test-Recipient'    => true,
		'Campaign'          => false,
		'Mailinglist'       => false,
		'HTML-Template'     => false,
		'Text-Template'     => false,
	);

	public static $BwPostmanTemplateAdmin_main_add_permissions = array(
		'Newsletter'        => false,
		'Subscriber'        => false,
		'Test-Recipient'    => false,
		'Campaign'          => false,
		'Mailinglist'       => false,
		'HTML-Template'     => true,
		'Text-Template'     => true,
	);

	public static $BwPostmanTemplatePublisher_main_add_permissions = array(
		'Newsletter'        => false,
		'Subscriber'        => false,
		'Test-Recipient'    => false,
		'Campaign'          => false,
		'Mailinglist'       => false,
		'HTML-Template'     => true,
		'Text-Template'     => true,
	);

	public static $BwPostmanTemplateEditor_main_add_permissions = array(
		'Newsletter'        => false,
		'Subscriber'        => false,
		'Test-Recipient'    => false,
		'Campaign'          => false,
		'Mailinglist'       => false,
		'HTML-Template'     => true,
		'Text-Template'     => true,
	);

	// set list action permission arrays
	public static $BwPostmanAdmin_item_permissions = array(
		'Newsletters'       =>
			array(
				'permissions'       =>
					array(
						'Create'            => true,
						'Edit'              => true,
						'EditOwn'           => true,
						'ModifyState'       => true,
						'ModifyStateOwn'    => true,
						'Archive'           => true,
						'Restore'           => true,
						'Delete'            => true,
						'SendNewsletter'    => true,
					),
                'own'   =>
                    array(
                        'itemid'        => 1,
                        'check content' => "Template Gedicht 1",
                    ),
                'other'   =>
                    array(
                        'itemid'        => 169,
                        'check content' => "Newsletter for testing 18",
                    ),
                'check column'  => "Subject",
                'check locator' => ".//*[@id='jform_subject']",
				'check link'    => ".//*[@id='main-table']/tbody/tr/td/a[contains(text(), '%s')]",
				'publish_by_icon'   => array(
						'publish_button'    =>  ".//*[@id='main-table']/tbody/tr[1]/td[8]/a",
						'publish_result'    =>  ".//*[@id='main-table']/tbody/tr[1]/td[8]/a/span[contains(@class, 'icon-publish')]",
						'unpublish_button'  =>  ".//*[@id='main-table']/tbody/tr[1]/td[8]/a",
						'unpublish_result'  =>  ".//*[@id='main-table']/tbody/tr[1]/td[8]/a/span[contains(@class, 'icon-unpublish')]",
					),
				'publish_by_toolbar'   => array(
						'publish_button'    =>  ".//*[@id='ub0']",
						'publish_result'    =>  ".//*[@id='main-table']/tbody/tr[1]/td[8]/a/span[contains(@class, 'icon-publish')]",
						'unpublish_button'  =>  ".//*[@id='ub0']",
						'unpublish_result'  =>  ".//*[@id='main-table']/tbody/tr[1]/td[8]/a/span[contains(@class, 'icon-unpublish')]",
					),
			),

		'Subscribers'       =>
            array(
                'permissions'       =>
                    array(
                        'Create'            => true,
                        'Edit'              => true,
                        'EditOwn'           => true,
                        'ModifyState'       => true,
                        'ModifyStateOwn'    => true,
                        'Archive'           => true,
                        'Restore'           => true,
                        'Delete'            => true,
                    ),
                'own'   =>
                    array(
                        'itemid'        => 2,
                        'check content' => "Rebmann",
                    ),
                'other'   =>
                    array(
                        'itemid'        => 22,
                        'check content' => "Schenk",
                    ),
                'check column'  => "Last name",
                'check locator' => ".//*[@id='jform_name']",
                'check link'    => ".//*[@id='main-table']/tbody/tr/td/a[contains(text(), '%s')]",
            ),

		'Campaigns'         =>
            array(
                'permissions'       =>
                    array(
                        'Create'            => true,
                        'Edit'              => true,
                        'EditOwn'           => true,
                        'ModifyState'       => true,
                        'ModifyStateOwn'    => true,
                        'Archive'           => true,
                        'Restore'           => true,
                        'Delete'            => true,
                    ),
                'own'   =>
                    array(
                        'itemid'        => 1,
                        'check content' => "01 Kampagne 2 A",
                    ),
                'other'   =>
                    array(
                        'itemid'        => 19,
                        'check content' => "04 Kampagne 12 A",
                    ),
                'check column'  => "Campaign title",
                'check locator' => ".//*[@id='jform_title']",
                'check link'    => ".//*[@id='main-table']/tbody/tr/td/a[contains(text(), '%s')]",
            ),

        'Mailinglists'      =>
            array(
                'permissions'       =>
                    array(
                        'Create'            => true,
                        'Edit'              => true,
                        'EditOwn'           => true,
                        'ModifyState'       => true,
                        'ModifyStateOwn'    => true,
                        'Archive'           => true,
                        'Restore'           => true,
                        'Delete'            => true,
                    ),
                'own'   =>
                    array(
                        'itemid'        => 17,
                        'check content' => "05 Mailingliste 18 A",
                    ),
                'other'   =>
                    array(
                        'itemid'        => 3,
                        'check content' => "01 Mailingliste 4 A",
                    ),
                'check column'  => "Title",
                'check locator' => ".//*[@id='jform_title']",
                'check link'    => ".//*[@id='main-table']/tbody/tr/td/a[contains(text(), '%s')]",
                'publish_by_icon'   => array(
                    'publish_button'    =>  ".//*[@id='main-table']/tbody/tr[1]/td[4]/a",
                    'publish_result'    =>  ".//*[@id='main-table']/tbody/tr[1]/td[4]/a/span[contains(@class, 'icon-publish')]",
                    'unpublish_button'  =>  ".//*[@id='main-table']/tbody/tr[1]/td[4]/a",
                    'unpublish_result'  =>  ".//*[@id='main-table']/tbody/tr[1]/td[4]/a/span[contains(@class, 'icon-unpublish')]",
                ),
                'publish_by_toolbar'   => array(
                    'publish_button'    =>  ".//*[@id='cb0']",
                    'publish_result'    =>  ".//*[@id='main-table']/tbody/tr[1]/td[4]/a/span[contains(@class, 'icon-publish')]",
                    'unpublish_button'  =>  ".//*[@id='cb0']",
                    'unpublish_result'  =>  ".//*[@id='main-table']/tbody/tr[1]/td[4]/a/span[contains(@class, 'icon-unpublish')]",
                ),
            ),

        'Templates'         =>
            array(
                'permissions'       =>
                    array(
                        'Create'            => true,
                        'Edit'              => true,
                        'EditOwn'           => true,
                        'ModifyState'       => true,
                        'ModifyStateOwn'    => true,
                        'Archive'           => true,
                        'Restore'           => true,
                        'Delete'            => true,
                    ),
                'own'   =>
                    array(
                        'itemid'        => 7,
                        'check content' => "Standard Deep Blue",
                    ),
                'other'   =>
                    array(
                        'itemid'        => 8,
                        'check content' => "Standard Soft Blue",
                    ),
                'check column'  => "Title",
                'check locator' => ".//*[@id='jform_title']",
                'check link'    => ".//*[@id='main-table']/tbody/tr/td/a[contains(text(), '%s')]",
                'publish_by_icon'   => array(
                    'publish_button'    =>  ".//*[@id='main-table']/tbody/tr[4]/td[6]/a",
                    'publish_result'    =>  ".//*[@id='main-table']/tbody/tr[4]/td[6]/a/span[contains(@class, 'icon-publish')]",
                    'unpublish_button'  =>  ".//*[@id='main-table']/tbody/tr[4]/td[6]/a",
                    'unpublish_result'  =>  ".//*[@id='main-table']/tbody/tr[4]/td[6]/a/span[contains(@class, 'icon-unpublish')]",
                ),
                'publish_by_toolbar'   => array(
                    'publish_button'    =>  ".//*[@id='cb3']",
                    'publish_result'    =>  ".//*[@id='main-table']/tbody/tr[4]/td[6]/a/span[contains(@class, 'icon-publish')]",
                    'unpublish_button'  =>  ".//*[@id='cb3']",
                    'unpublish_result'  =>  ".//*[@id='main-table']/tbody/tr[4]/td[6]/a/span[contains(@class, 'icon-unpublish')]",
                ),
            ),

        'Archive'           => true,

        'Maintenance'         =>
            array(
                'permissions'       =>
                    array(
                        'Admin' => true,
                    ),
            ),
    );

// publish mailinglists
	public static $publish_by_icon   = array(
		'publish_button'    =>  ".//.//*[@id='main-table']/tbody/tr[3]/td[4]/a",
		'publish_result'    =>  ".//.//*[@id='main-table']/tbody/tr[3]/td[4]/a/span[contains(@class, 'icon-publish')]",
		'unpublish_button'  =>  ".//.//*[@id='main-table']/tbody/tr[4]/td[4]/a",
		'unpublish_result'  =>  ".//.//*[@id='main-table']/tbody/tr[4]/td[4]/a/span[contains(@class, 'icon-unpublish')]",
	);

	public static $publish_by_toolbar   = array(
		'publish_button'    =>  ".//*[@id='cb5']",
		'publish_result'    =>  ".//.//*[@id='main-table']/tbody/tr[6]/td[4]/a/span[contains(@class, 'icon-publish')]",
		'unpublish_button'  =>  ".//*[@id='cb6']",
		'unpublish_result'  =>  ".//.//*[@id='main-table']/tbody/tr[7]/td[4]/a/span[contains(@class, 'icon-unpublish')]",
	);



	// set array with direct links to parts of BwPostman
	public static $direct_links = array (
									'direct_link_cam_lists' => '/administrator/index.php?option=com_bwpostman&view=campaigns',
									'direct_link_cam_create' => '/administrator/index.php?option=com_bwpostman&view=campaign&task=add',
									'direct_link_cam_edit_allowed' => '/administrator/index.php?option=com_bwpostman&view=campaign&layout=edit&id=18',
									'direct_link_cam_edit_forbidden' => '/administrator/index.php?option=com_bwpostman&view=campaign&layout=edit&id=1',
									'direct_link_cam_archive' => '/administrator/index.php?option=com_bwpostman&controller=campaigns&tmpl=component&view=campaigns&&layout=default_confirmarchive',
									'direct_link_cam_checkin' => '/administrator/index.php?option=com_bwpostman&view=campaigns&task=campaigns.checkin',

									'direct_link_ml_lists' => '/administrator/index.php?option=com_bwpostman&view=mailinglists',
									'direct_link_ml_create' => '/administrator/index.php?option=com_bwpostman&view=mailinglist&task=add',
									'direct_link_ml_edit_allowed' => '/administrator/index.php?option=com_bwpostman&view=mailinglist&layout=edit&id=11',
									'direct_link_ml_edit_forbidden' => '/administrator/index.php?option=com_bwpostman&view=mailinglist&layout=edit&id=1',
									'direct_link_ml_archive' => '/administrator/index.php?option=com_bwpostman&controller=mailinglist&task=mailinglist.archive',
									'direct_link_ml_checkin' => '/administrator/index.php?option=com_bwpostman&view=mailinglist&',

									'direct_link_nl_lists' => '/administrator/index.php?option=com_bwpostman&view=newsletters',
									'direct_link_nl_create' => '/administrator/index.php?option=com_bwpostman&view=newsletter&task=add&layout=edit_basic',
									'direct_link_nl_edit_allowed' => '/administrator/index.php?option=com_bwpostman&view=newsletter&layout=edit&id=119',
									'direct_link_nl_edit_forbidden' => '/administrator/index.php?option=com_bwpostman&view=newsletter&layout=edit&id=1',
									'direct_link_nl_archive' => '/administrator/index.php?option=com_bwpostman&view=newsletter&',
									'direct_link_nl_checkin' => '/administrator/index.php?option=com_bwpostman&view=newsletter&',
									'direct_link_nl_send' => '/administrator/index.php?option=com_bwpostman&view=newsletter&',
									'direct_link_nl_copy' => '/administrator/index.php?option=com_bwpostman&view=newsletter&',
									'direct_link_nl_publish' => '/administrator/index.php?option=com_bwpostman&view=newsletter&',
									'direct_link_nl_unpublish' => '/administrator/index.php?option=com_bwpostman&view=newsletter&',

									'direct_link_subs_lists' => '/administrator/index.php?option=com_bwpostman&view=subscribers',
									'direct_link_subs_create' => '/administrator/index.php?option=com_bwpostman&view=subscriber&task=add',
									'direct_link_subs_edit_allowed' => '/administrator/index.php?option=com_bwpostman&view=subscriber&layout=edit&id=',
									'direct_link_subs_edit_forbidden' => '/administrator/index.php?option=com_bwpostman&view=subscriber&layout=edit&id=',
									'direct_link_subs_archive' => '/administrator/index.php?option=com_bwpostman&view=subscriber&',
									'direct_link_subs_checkin' => '/administrator/index.php?option=com_bwpostman&view=subscriber&',
									'direct_link_subs_import' => '/administrator/index.php?option=com_bwpostman&view=subscriber&',
									'direct_link_subs_export' => '/administrator/index.php?option=com_bwpostman&view=subscriber&',
									'direct_link_subs_batch' => '/administrator/index.php?option=com_bwpostman&view=subscriber&',

									'direct_link_tpl_lists' => '/administrator/index.php?option=com_bwpostman&view=templates',
									'direct_link_tpl_create_html' => '/administrator/index.php?option=com_bwpostman&view=template&layout=default_html',
									'direct_link_tpl_create_text' => '/administrator/index.php?option=com_bwpostman&view=template&layout=default_text',
									'direct_link_tpl_edit_allowed' => '/administrator/index.php?option=com_bwpostman&view=template&layout=edit&id=',
									'direct_link_tpl_edit_forbidden' => '/administrator/index.php?option=com_bwpostman&view=template&layout=edit&id=',
									'direct_link_tpl_archive' => '/administrator/index.php?option=com_bwpostman&view=template&',
									'direct_link_tpl_checkin' => '/administrator/index.php?option=com_bwpostman&view=template&',
									'direct_link_tpl_set_default' => '/administrator/index.php?option=com_bwpostman&view=template&',
									'direct_link_tpl_install' => '/administrator/index.php?option=com_bwpostman&view=template&',

									'direct_link_maintenance_view' => '/administrator/index.php?option=com_bwpostman&view=maintenance',
									'direct_link_maintenance_save' => '/administrator/index.php?option=com_bwpostman&view=maintenance&task=maintenance.saveTables',
									'direct_link_maintenance_restore' => '/administrator/index.php?option=com_bwpostman&view=maintenance&task=maintenance.restoreTables',
									'direct_link_maintenance_check' => '/administrator/index.php?option=com_bwpostman&view=maintenance&layout=checkTables',
									'direct_link_maintenance_options' => '/administrator/index.php?option=com_config&view=component&component=com_bwpostman&path=',

									'direct_link_options' => '/administrator/index.php?option=com_config&view=component&component=com_bwpostman',
								);

	// set array with button links from main view of BwPostman to parts of BwPostman
	// @ToDo: Fill with values
	public static $button_links = array (
									'button_link_cam_lists' => '',
									'button_link_cam_create' => '',
									'button_link_cam_edit_allowed' => '',
									'button_link_cam_edit_forbidden' => '',
									'button_link_cam_archive' => '',
									'button_link_cam_checkin' => '',

									'button_link_ml_lists' => '',
									'button_link_ml_create' => '',
									'button_link_ml_edit_allowed' => '',
									'button_link_ml_edit_forbidden' => '',
									'button_link_ml_archive' => '',
									'button_link_ml_checkin' => '',

									'button_link_nl_lists' => '',
									'button_link_nl_create' => '',
									'button_link_nl_edit_allowed' => '',
									'button_link_nl_edit_forbidden' => '',
									'button_link_nl_archive' => '',
									'button_link_nl_checkin' => '',
									'button_link_nl_send' => '',
									'button_link_nl_copy' => '',
									'button_link_nl_publish' => '',
									'button_link_nl_unpublish' => '',

									'button_link_subs_lists' => '',
									'button_link_subs_create' => '',
									'button_link_subs_edit_allowed' => '',
									'button_link_subs_edit_forbidden' => '',
									'button_link_subs_archive' => '',
									'button_link_subs_checkin' => '',
									'button_link_subs_import' => '',
									'button_link_subs_export' => '',
									'button_link_subs_batch' => '',

									'button_link_tpl_lists' => '',
									'button_link_tpl_create' => '',
									'button_link_tpl_edit_allowed' => '',
									'button_link_tpl_edit_forbidden' => '',
									'button_link_tpl_archive' => '',
									'button_link_tpl_checkin' => '',
									'button_link_tpl_set_default' => '',
									'button_link_tpl_install' => '',

									'button_link_maintenance_view' => '',
									'button_link_maintenance_save' => '',
									'button_link_maintenance_restore' => '',
									'button_link_maintenance_check' => '',
								);

	// set arrays possible results of each link
	// @ToDo: Fill with values
	public static $possible_link_results = array (
												'direct_link_cam_lists' => array(
													'allowed'   => '',
													'forbidden' => 'No permission for view Campaigns.',
												),
												'direct_link_cam_create' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_cam_edit' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_cam_archive' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_cam_checkin' => array(
													'allowed'   => '',
													'forbidden' => '',
												),

												'direct_link_ml_lists' => array(
													'allowed'   => '',
													'forbidden' => 'No permission for view Mailinglists.',
												),
												'direct_link_ml_create' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_ml_edit' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_ml_archive' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_ml_checkin' => array(
													'allowed'   => '',
													'forbidden' => '',
												),

												'direct_link_nl_lists' => array(
													'allowed'   => '',
													'forbidden' => 'No permission for view Newsletters.',
												),
												'direct_link_nl_create' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_nl_edit' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_nl_archive' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_nl_checkin' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_nl_send' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_nl_copy' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_nl_publish' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_nl_unpublish' => array(
													'allowed'   => '',
													'forbidden' => '',
												),

												'direct_link_subs_lists' => array(
													'allowed'   => '',
													'forbidden' => 'No permission for view Subscribers.',
												),
												'direct_link_subs_create' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_subs_edit' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_subs_archive' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_subs_checkin' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_subs_import' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_subs_export' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_subs_batch' => array(
													'allowed'   => '',
													'forbidden' => '',
												),

												'direct_link_tpl_lists' => array(
													'allowed'   => '',
													'forbidden' => 'No permission for view Templates.',
												),
												'direct_link_tpl_create_html' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_tpl_create_text' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_tpl_edit' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_tpl_archive' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_tpl_checkin' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_tpl_set_default' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_tpl_install' => array(
													'allowed'   => '',
													'forbidden' => '',
												),

												'direct_link_maintenance_view' => array(
													'allowed'   => '',
													'forbidden' => 'No permission for view Maintenance.',
												),
												'direct_link_maintenance_save' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_maintenance_restore' => array(
													'allowed'   => '',
													'forbidden' => '',
												),
												'direct_link_maintenance_check' => array(
													'allowed'   => '',
													'forbidden' => '',
												),

												'direct_link_options' => array(
													'allowed'   => '',
													'forbidden' => 'You are not authorised to view this resource.',
												),
	);

	// set arrays with group permissions to parts of BwPostman
	// @ToDo: Fill with values
	// @ToDo: Reflect how to solve this task for all usergroups
	public static $group_permission = array (
	);

	// Messages
	public static $checkin_success_text = "One %s successfully checked in";
	public static $checkin_error_text   = "Check-in failed with the following error: The user checking in does not match the user who checked out the item.";

}
