<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$class = ' class="first"';
$lang	= JFactory::getLanguage();

if (count($this->items[$this->parent->id]) > 0 && $this->maxLevelcat != 0) :
?>
	<?php foreach($this->items[$this->parent->id] as $id => $item) : ?>
		<?php
		if ($this->params->get('show_empty_categories_cat') || $item->numitems || count($item->getChildren())) :
		if (!isset($this->items[$this->parent->id][$id + 1]))
		{
			$class = ' class="last"';
		}
		?>
		<div <?php echo $class; ?> >
		<?php $class = ''; ?>
			<h3 class="item-title">				
				<?php
                $cat_title = $this->escape($item->title);
                $new_title = JString::strpos($cat_title, '|');
                $newcat_title = ($new_title !== false) ? '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($item->id)) . '" title="'.JString::substr($cat_title, 0, $new_title).'">' . JString::substr($cat_title, 0, $new_title) . '</a>': '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($item->id)) . '" title="'.$this->escape($item->title).'">' . $this->escape($item->title) . '</a>';
                echo $newcat_title;
                ?>
				<?php if ($this->params->get('show_cat_num_articles_cat') == 1) :?>
					<span class="badge badge-info tip hasTooltip" title="<?php echo JHtml::tooltipText('COM_CONTENT_NUM_ITEMS'); ?>">
						<?php echo $item->numitems; ?>
					</span>
				<?php endif; ?>
				<?php if (count($item->getChildren()) > 0) : ?>
					<a href="#category-<?php echo $item->id;?>" data-toggle="collapse" data-toggle="button" class="btn btn-mini pull-right"><span class="icon-plus"></span></a>
				<?php endif;?>
			</h3>
			<?php if ($this->params->get('show_description_image') && $item->getParams()->get('image')) : ?>
				<img src="<?php echo $item->getParams()->get('image'); ?>"/>
			<?php endif; ?>
			<?php if ($this->params->get('show_subcat_desc_cat') == 1) :?>
				<?php if ($item->description) : ?>
					<div class="category-desc">
						<?php echo JHtml::_('content.prepare', $item->description, '', 'com_content.categories'); ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if (count($item->getChildren()) > 0) :?>
				<div class="collapse fade" id="category-<?php echo $item->id;?>">
				<?php
				$this->items[$item->id] = $item->getChildren();
				$this->parent = $item;
				$this->maxLevelcat--;
				echo $this->loadTemplate('items');
				$this->parent = $item->getParent();
				$this->maxLevelcat++;
				?>
				</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
