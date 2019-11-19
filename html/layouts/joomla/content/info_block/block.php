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

    <div class="catItemBody">
        <ul class="catToolbar">
            <?php if ($displayData['position'] == 'above' && ($blockPosition == 0 || $blockPosition == 2)
                || $displayData['position'] == 'below' && ($blockPosition == 1)
                ) : ?>
                <?php if ($displayData['params']->get('show_publish_date')) : ?>
                    <li>
                    <?php echo JLayoutHelper::render('joomla.content.info_block.publish_date', $displayData); ?>
                    </li>
                <?php endif; ?>
            
            <?php endif; ?>
            
            <?php if ($displayData['position'] == 'above' && ($blockPosition == 0)
                    || $displayData['position'] == 'below' && ($blockPosition == 1 || $blockPosition == 2)
                    ) : ?>
                <?php if ($displayData['params']->get('show_modify_date')) : ?>
                    <li>
                    <?php echo JLayoutHelper::render('joomla.content.info_block.modify_date', $displayData); ?>
                    </li>
                <?php endif; ?>
            
                <?php if ($displayData['params']->get('show_author') && !empty($displayData['item']->author )) : ?>
                    <li>
                    <?php echo JLayoutHelper::render('joomla.content.info_block.author', $displayData); ?>
                    </li>
                <?php endif; ?>
    
                <?php if ($displayData['params']->get('show_hits')) : ?>
                    <li>
                    <?php echo JLayoutHelper::render('joomla.content.info_block.hits', $displayData); ?>
                    </li>
                <?php endif; ?>
                
            <?php endif; ?>
        </ul>
    </div>
  
