<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');
global $leadingFlag;
$doc = JFactory::getDocument();
$app = JFactory::getApplication(); 

?>
   
<div class="blog <?php echo $this->pageclass_sfx;?>">
	
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<div class="page-header">
		<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
	</div>
	<?php endif; ?>
	<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
	<h2 class="heading-category"> <?php echo $this->escape($this->params->get('page_subheading')); ?>
		<?php if ($this->params->get('show_category_title')) : ?>
		<span class="subheading-category"><?php echo $this->category->title;?></span>
		<?php endif; ?>
	</h2>
	<?php endif; ?>
	
	<?php if ($this->params->get('show_tags', 1) && !empty($this->category->tags->itemTags)) : ?>
		<?php $this->category->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
		<?php echo $this->category->tagLayout->render($this->category->tags->itemTags); ?>
	<?php  endif; ?>
	
	<?php if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
	<div class="category-desc">
		<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
			<img src="<?php echo $this->category->getParams()->get('image'); ?>"/>
		<?php endif; ?>
		<?php if ($this->params->get('show_description') && $this->category->description) : ?>
			<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
		<?php endif; ?>
		<div class="clr"></div>
	</div>
	<?php endif; ?>
	
	<?php $leadingcount = 0; ?>
	<?php if (!empty($this->lead_items)) : ?>
	<div class="items-leading row">
		
		<?php foreach ($this->lead_items as &$item) : ?>
		<div class="item col-xs-12 col-lg-<?php echo round((12 / $this->columns));?> leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
			<div class="catItemView grid">
			<?php
				$this->item = &$item;
				// Begin: dunnv edited
				$leadingFlag = 1;
				echo $this->loadTemplate('item');
				$leadingFlag = 0;
				// End: dungnv edited
			?>
			</div>
		</div>
		
		<?php
			$leadingcount++;
		?>
		<?php endforeach; ?>
	</div><!-- end items-leading -->
	
	<?php endif; ?>
	<?php
	$introcount = (count($this->intro_items));
	$counter = 0;
?>
	<?php if (!empty($this->intro_items)) : ?>
	<?php foreach ($this->intro_items as $key => &$item) : ?>
	<?php
		$key = ($key - $leadingcount) + 1;
		$rowcount = (((int) $key - 1) % (int) $this->columns) + 1;
		$row = $counter / $this->columns;

		if ($rowcount == 1) : ?>
		<div class="items-row cols-<?php echo (int) $this->columns;?> <?php echo 'row-'.$row; ?> row">
		<?php endif; ?>
		
				<div class="item col-xs-12 col-lg-<?php echo round((12 / $this->columns));?> column-<?php echo $rowcount;?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
					<div class="catItemView grid">
					<?php
					$this->item = &$item;
					echo $this->loadTemplate('item');
					?>
					</div>
				</div>
				<?php $counter++; ?>
			<?php if (($rowcount == $this->columns) or ($counter == $introcount)): ?>			
		</div><!-- end row -->
			<?php endif; ?>
	<?php endforeach; ?>
	<?php endif; ?>
	
	<?php if (!empty($this->link_items)) : ?>
	<div class="items-more">
	<?php echo $this->loadTemplate('links'); ?>
	</div>
	<?php endif; ?>
	<?php if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
	<div class="cat-children">
		<h3> <?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?> </h3>
		<?php echo $this->loadTemplate('children'); ?> </div>
	<?php endif; ?>
	<?php if (($this->params->def('show_pagination', 1) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
	<div class="pagination row">
		<?php  if ($this->params->def('show_pagination_results', 1)) : ?>
		<div class="counter col-md-4"> <?php echo $this->pagination->getPagesCounter(); ?> </div>
		<?php endif; ?>
		<div class="col-md-8"><?php echo $this->pagination->getPagesLinks(); ?> </div>
	</div>
	<?php  endif; ?>
	
</div>
