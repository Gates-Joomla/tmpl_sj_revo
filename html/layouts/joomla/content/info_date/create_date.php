<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

?>
<div class="date">
<span class="day"><?php echo JText::sprintf( JHtml::_('date', $displayData['item']->created, JText::_('d'))); ?></span>
<span class="month"><?php echo JText::sprintf( JHtml::_('date', $displayData['item']->created, JText::_('M'))); ?></span>
<span class="year"><?php echo JText::sprintf( JHtml::_('date', $displayData['item']->created, JText::_('Y'))); ?></span>
</div>
