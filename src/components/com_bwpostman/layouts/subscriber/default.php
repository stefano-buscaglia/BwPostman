<?php
/**
 * BwPostman Newsletter Component
 *
 * BwPostman subscriber data fields layout
 *
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$subscriber = $displayData['subscriber'];
$params     = JComponentHelper::getParams('com_bwpostman', true);
$lists      = $displayData['lists'];
?>

<div class="contentpane<?php echo $params->get('pageclass_sfx'); ?>">
	<?php // Show pretext only if set in basic parameters
		if ($params->get('pretext')) :
		 ?>
		<p class="pre_text"><?php echo nl2br($params->get('pretext')); ?></p>
	<?php endif;
	// End: Show pretext only if set in basic parameters ?>

	<?php // Show editlink only if the user is not logged in
		if (JFactory::getUser()->get('guest')) :
		 ?>
		<p class="user_edit"><a href="<?php echo JRoute::_('index.php?option=com_bwpostman&amp;view=edit'); ?>"><?php echo JText::_('COM_BWPOSTMAN_LINK_TO_EDITLINKFORM'); ?></a></p>
	<?php endif;
	// End: Show editlink only if the user is not logged in ?>

	<?php // Show formfield gender only if enabled in basic parameters
		if ($params->get('show_gender') == 1) {  ?>
		<div class="edit_gender">
			<label id="gendermsg"> <?php echo JText::_('COM_BWPOSTMAN_GENDER'); ?>:</label>
			<?php echo $lists['gender']; ?>
		</div>
	<?php } // End gender ?>

	<?php // Show first name-field only if set in basic parameters
		if ($params->get('show_firstname_field') || $params->get('firstname_field_obligation')) :
		 ?>
		<p class="user_firstname input<?php echo ($params->get('firstname_field_obligation')) ? '-append' : ''?>">
			<label id="firstnamemsg" for="firstname"
					<?php if ((!empty($subscriber->err_code)) && ($subscriber->err_code == 1)) echo "class=\"invalid\""; ?>>
					<?php echo JText::_('COM_BWPOSTMAN_FIRSTNAME'); ?>: </label>
			<?php // Is filling out the firstname field obligating
				if ($params->get('firstname_field_obligation')) : {
				 ?>
				<input type="text" name="firstname" id="firstname" size="40"
					value="<?php if (!empty($subscriber->firstname)) { echo $subscriber->firstname; } ?>"
					class="<?php if ((!empty($subscriber->err_code)) && ($subscriber->err_code == 1)) { echo "invalid"; } else { echo "inputbox required";} ?>"
					maxlength="50" /> <span class="append-area"><i class="icon-star"></i></span>
				<?php }
				else : { ?>
					<input type="text" name="firstname" id="firstname" size="40"
						value="<?php echo $subscriber->firstname; ?>"
						class="<?php if ((!empty($subscriber->err_code)) && ($subscriber->err_code == 1)) { echo "invalid"; } else { echo "inputbox";} ?>"
						maxlength="50" />
			<?php } endif;
			// End: Is filling out the firstname field obligating ?>
		</p>
	<?php endif;
	// End: Show first name-field only if set in basic parameters ?>


	<?php // Show name-field only if set in basic parameters
		if ($params->get('show_name_field') || $params->get('name_field_obligation')) :
		 ?>
		<p class="user_name edit_name input<?php echo ($params->get('name_field_obligation')) ? '-append' : ''?>">
			<label id="namemsg" for="name"
				<?php if ((!empty($subscriber->err_code)) && ($subscriber->err_code == 1)) echo "class=\"invalid\""; ?>>
				<?php echo JText::_('COM_BWPOSTMAN_NAME'); ?>: </label>
			<?php // Is filling out the name field obligating
				if ($params->get('name_field_obligation')) : {
				 ?>
				<input type="text" name="name" id="name" size="40" value="<?php echo $subscriber->name; ?>"
					class="<?php if ((!empty($subscriber->err_code)) && ($subscriber->err_code == 1)) { echo "invalid"; } else { echo "inputbox required";} ?>"
					maxlength="50" />  <span class="append-area"><i class="icon-star"></i></span> <?php }
				else : { ?> <input type="text" name="name" id="name" size="40" value="<?php echo $subscriber->name; ?>"
					class="<?php if ((!empty($subscriber->err_code)) && ($subscriber->err_code == 1)) { echo "invalid"; } else { echo "inputbox";} ?>"
					maxlength="50" /> <?php }
				endif;
			// End: Is filling out the name field obligating ?>
		</p>
	<?php endif;
	// End: Show name-fields only if set in basic parameters ?>

	<?php // Show special only if set in basic parameters or required
		if ($params->get('show_special') || $params->get('special_field_obligation')) :
		if($params->get('special_desc') != '')
		{
			$tip    =  JText::_($params->get('special_desc'));
		}
		else
		{
			$tip    =  JText::_('COM_BWPOSTMAN_SPECIAL');
		} ?>

		<p class="edit_special input<?php echo ($params->get('special_field_obligation')) ? '-append' : ''?>">
			<label id="specialmsg hasTooltip" title="<?php echo JHtml::tooltipText($tip); ?>" for="special"
				<?php if ((!empty($subscriber->err_code)) && ($subscriber->err_code == 1)) echo "class=\"invalid\""; ?>>
				<?php
				if($params->get('special_label') != '')
				{
					echo JText::_($params->get('special_label'));
				}
				else
				{
					echo JText::_('COM_BWPOSTMAN_SPECIAL');
				}
				?>:
			</label>
			<?php // Is filling out the special field obligating
				if ($params->get('special_field_obligation')) : {  ?>
				<input	type="text" name="special" id="special" size="40" value="<?php echo $subscriber->special; ?>"
					class="<?php if ((!empty($subscriber->err_code)) && ($subscriber->err_code == 1)) { echo "invalid"; } else { echo "inputbox";} ?>"
					maxlength="50" /> <span class="append-area"><i class="icon-star"></i></span>
			<?php }
			else : { ?>
				<input	type="text" name="special" id="special" size="40" value="<?php echo $subscriber->special; ?>"
					class="<?php if ((!empty($subscriber->err_code)) && ($subscriber->err_code == 1)) { echo "invalid"; } else { echo "inputbox";} ?>"
					maxlength="50" />
			<?php } endif; // End: Is filling out the special field obligating ?>
		</p>
	<?php endif; // End: Show special field only if set in basic parameters ?>


	<p class="user_email edit_email input-append">
		<label id="emailmsg" for="email"
			<?php if ((!empty($subscriber->err_code)) && ($subscriber->err_code != 1)) echo "class=\"invalid\""; ?>>
			<?php echo JText::_('COM_BWPOSTMAN_EMAIL'); ?>:
		</label>
		<input type="text" id="email" name="email" size="40" value="<?php echo $subscriber->email; ?>"
			class="<?php if ((!empty($subscriber->err_code)) && ($subscriber->err_code != 1)) { echo "invalid"; } else { echo "inputbox required validate-email";} ?>"
			maxlength="100" />  <span class="append-area"><i class="icon-star"></i></span>
	</p>
	<?php // Show formfield email format only if enabled in basic parameters
		if ($params->get('show_emailformat') == 1) {
		 ?>
		<div class="user_mailformat edit_emailformat">
			<label id="emailformatmsg"> <?php echo JText::_('COM_BWPOSTMAN_EMAILFORMAT'); ?>: </label>
			<?php echo $lists['emailformat']; ?>
		</div>
	<?php }
	else {
		// hidden field with the default email format
		?>
		<input type="hidden" name="emailformat" value="<?php echo $params->get('default_emailformat'); ?>" />
	<?php }
	// End email format
	?>

	<?php // Show available mailinglists
		if ($lists['available_mailinglists']) :

		?>
		<div class="maindivider<?php echo $params->get('pageclass_sfx'); ?>"></div>

		<div class="contentpane<?php echo $params->get('pageclass_sfx'); ?>">
			<?php
			$n	= count($lists['available_mailinglists']);
			if ($n == 1) { ?>
				<input title="mailinglists_array" type="checkbox" style="display: none;" id="<?php echo "mailinglists0"; ?>" name="<?php echo "mailinglists[]"; ?>" value="<?php echo $lists['available_mailinglists'][0]->id; ?>" checked="checked" />
			<?php }
			else { ?>
				<p class="mail_available">
					<?php echo JText::_('COM_BWPOSTMAN_MAILINGLISTS'); ?>
				</p>
				<?php foreach ($lists['available_mailinglists'] as $i => $item) : ?>
					<p class="mail_available_list <?php echo "mailinglists$i"; ?>">
						<input title="mailinglists_array" type="checkbox" id="<?php echo "mailinglists$i"; ?>" name="<?php echo "mailinglists[]"; ?>" value="<?php echo $item->id; ?>"
							<?php if ((is_array($subscriber->mailinglists)) && (in_array((int)$item->id, $subscriber->mailinglists))) echo "checked=\"checked\""; ?> />
						<span class="mail_available_list_title"><?php echo "$item->title: "; ?></span><?php echo "$item->description"; ?>
					</p>
				<?php endforeach; ?>
				<div class="maindivider<?php echo $params->get('pageclass_sfx'); ?>"></div>
			<?php } ?>
		</div>

	<?php endif;
	// End Mailinglists ?>


</div>
