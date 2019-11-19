<?php
/**
* @package Sj Basic News
* @version 3.0
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @copyright (c) 2012 YouTech Company. All Rights Reserved.
* @author YouTech Company http://www.smartaddons.com
*
*/
defined('_JEXEC') or die;

if(!empty($list)){
	$uniquied = 'sj_basic_news_'.time().rand();
	JHtml::stylesheet('modules/mod_sj_basic_news/assets/css/sj-basic-news.css');
	ImageHelper::setDefault($params);
?>
	<?php if($params->get('pretext') != null) {?>
		<div class="bs-pretext">
			<?php echo $params->get('pretext'); ?>
		</div>
	<?php }?>
	<div id="<?php echo $uniquied?>" class="sj-basic-news">
		<div id="owl-carousel-blog" class="bs-items">
			<?php  $i = 0;  foreach($list as $item){ $i++;
				
				$show_line = ($params->get('showline') == 1)?' bs-show-line':'';
				$last_class = ($i == count($list))?' last':'';
				$img = SjBasicNewsHelper::getAImage($item, $params);
			?>
			<div class="item  catItemView">
				<?php if($img){?>
				<div class="item-image">
					<a href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>" <?php echo SjBasicNewsHelper::parseTarget($params->get('link_target')); ?>>
						<?php
	    					 echo SjBasicNewsHelper::imageTag($img);
	    				?>
					</a>
				</div>
				<?php } ?>
				
				<div class="catItemHeader">
					<?php if($params->get('title_display') == 1) {?>
					<h3 class="catItemTitle">
						<a href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>" <?php echo SjBasicNewsHelper::parseTarget($params->get('link_target')); ?>>
							<?php echo SjBasicNewsHelper::truncate($item->title, $params->get('item_title_max_characs',25)); ?>
						</a>
					</h3>
					<?php }?>
				</div>
				<div class="catItemBody">
					<ul class="catToolbar">
						<li>
							<i class="fa fa-user" aria-hidden="true"></i>
							<?php echo $item->author; ?>
						</li>
						<?php if($params->get('cat_title_display') == 1 ){?>
						<li>
							<i class="fa fa-folder-open" aria-hidden="true"></i>
							<a href="<?php echo $item->catlink; ?>" title="<?php echo $item->category_title; ?>" <?php echo SjBasicNewsHelper::parseTarget($params->get('link_target')); ?> >
								<?php echo $item->category_title; ?>
							</a>
						</li>
						<?php } ?>
						
					</ul>
				</div>
				<?php if($params->get('cat_title_display') == 1 || $params->get('item_date_display') == 1 ){?>
				<div class="date">
					<span class="day"><?php echo JText::sprintf( JHtml::_('date', $item->created, JText::_('d'))); ?></span>
					<span class="month"><?php echo JText::sprintf( JHtml::_('date', $item->created, JText::_('M'))); ?></span>
					<span class="year"><?php echo JText::sprintf( JHtml::_('date', $item->created, JText::_('Y'))); ?></span>
				</div>
				<?php }?>
				<?php if($params->get('item_desc_display') == 1) {?>
				<p>
					<?php echo SjBasicNewsHelper::truncate($item->introtext, $params->get('item_desc_max_characs',200)); ?>
				</p>
				<?php } ?>
				<?php if($params->get('item_readmore_display') == 1){?>
				
				<a class="readmore" href="<?php echo $item->link ?>" title="<?php echo $item->title; ?>" <?php echo SjBasicNewsHelper::parseTarget($params->get('link_target')); ?>>
					<i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $params->get('item_readmore_text'); ?>
				</a>
				
				<?php }?>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php if($params->get('posttext') != null) {?>
	<div class="bs-posttext">
		<?php echo $params->get('posttext'); ?>
	</div>
	<?php }?>


<?php 
}else{
	echo JText::_('Has no content to show!');	
}?>