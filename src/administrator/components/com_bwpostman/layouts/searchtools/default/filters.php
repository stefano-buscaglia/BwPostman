<?php
/**
 * BwPostman Newsletter Component
 *
 * BwPostman filter tool layout
 *
 * @package     Joomla.Admin
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$data	= $displayData;
$layout	= $data['tab'];

// Load the form filters
$filters		= $data['view']->filterForm->getFieldset($layout);

?>
<?php if ($filters) : ?>
	<?php foreach ($filters as $fieldName => $field) : ?>
		<?php if (($fieldName != 'filter_search') && (stripos($fieldName, 'filter_') !== false)) : ?>
			<div class="js-stools-field-filter">
				<?php echo $field->input; ?>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>

