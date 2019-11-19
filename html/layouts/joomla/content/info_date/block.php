<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$blockPosition = $displayData['params']->get('info_block_position', 0);

?>
    <?php if ($displayData['params']->get('show_create_date')) : ?>
        <?php echo JLayoutHelper::render('joomla.content.info_date.create_date', $displayData); ?>
    <?php endif; ?>  
