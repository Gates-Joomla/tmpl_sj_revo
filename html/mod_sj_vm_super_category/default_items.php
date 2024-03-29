<?php
/**
 * @package Sj Super Categories for JoomShopping
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2014 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */

defined('_JEXEC') or die;
$currency = CurrencyDisplay::getInstance();
$small_image_config = array(
    'type' => $params->get('imgcfg_type'),
    'width' => $params->get('imgcfg_width'),
    'height' => $params->get('imgcfg_height'),
    'quality' => 90,
    'function' => ($params->get('imgcfg_function') == 'none') ? null : 'resize',
    'function_mode' => ($params->get('imgcfg_function') == 'none') ? null : substr($params->get('imgcfg_function'), 7),
    'transparency' => $params->get('imgcfg_transparency', 1) ? true : false,
    'background' => $params->get('imgcfg_background'));
if (!empty($child_items)) {
	$app = JFactory::getApplication();
	$k = $app->input->getInt('ajax_limit_start', 0);
	$i = 0;
	$count = count($child_items);
	if ($params->get('type_show') == 'slider') { 
		echo '<div class="ltabs-items-inner owl2-carousel ltabs-slider ">';
	} 
	foreach ($child_items as $item) {
		$i++;$k++; ?>
		
	
		<?php if ($params->get('type_show') == 'loadmore'){ ?>
		  <div class="spcat-item new-spcat-item">
       <?php } ?>
		
			
				<?php if( $i%4 == 1 ):?>
				<div class="ltabs-item">
					<div class="item-first">
						<?php
						$item_img = SjVMSuperCategoriesHelper::getVmImage($item, $params, 'imgcfg');
						if ($item_img) {
							?>
							<div class="item-image">
								<a href="<?php echo $item->link ?>"
								   title="<?php echo $item->title; ?>" <?php echo SjVMSuperCategoriesHelper::parseTarget($params->get('link_target')); ?> >
									<?php echo SjVMSuperCategoriesHelper::imageTag($item_img, $small_image_config); ?>
									<span class="image-border"></span>
								</a>
								<?php if ($params->get('item_addtocart_display', 1)) {
									$_item['product'] = $item; ?>
									<div class="item-addtocart">
										<?php echo shopFunctionsF::renderVmSubLayout('addtocart', $_item); ?>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
						<div class="item-info">
							<?php if ($params->get('item_title_display', 1) == 1) { ?>
							<h3 class="item-title">
								<a href="<?php echo $item->link; ?>"
								   title="<?php echo $item->title ?>" <?php echo SjVMSuperCategoriesHelper::parseTarget($params->get('link_target')); ?> >
									<?php echo SjVMSuperCategoriesHelper::truncate($item->title, (int)$params->get('item_title_max_characters', 25)); ?>
								</a>
							</h3>
							<?php } ?>
							<?php if ((int)$params->get('item_prices_display', 1) && ( !empty($item->prices['salesPrice']) || !empty($item->prices['salesPriceWithDiscount'])) ) { ?>
					
							 <div class="group-price">
								<div class="product-price">
									<div class="PricesalesPrice">
										<?php
										if (!empty($item->prices['salesPrice'])) {
											echo $currency->createPriceDiv('salesPrice', JText::_("Price: "), $item->prices, false, false, 1.0, true);
										}
										if (!empty($item->prices['salesPriceWithDiscount'])) {
											echo $currency->createPriceDiv('salesPriceWithDiscount', JText::_("Price: "), $item->prices, false, false, 1.0, true);
										} ?>
									</div>
									<div class="PricebasePriceVariant">
										<?php echo $currency->createPriceDiv ('basePriceVariant', '', $item->prices, false, false, 1.0, true);?>
									</div>
								</div>
							</div>
							
							
							
							<?php } ?>
							<?php if ((int)$params->get('item_description_display', 1) && SjVMSuperCategoriesHelper::_trimEncode($item->_description) != '') { ?>
							<div class="item-desc">
								<?php echo $item->_description;?>
							</div>
							<?php } ?>
							<?php if ((int)$params->get('item_prices_display_promotion', 1) == 1 && ( !empty($item->prices['salesPrice']) || !empty($item->prices['salesPriceWithDiscount'])) ) { ?>
							<div class="item-prices_promotion">
								<?php
								/*$price = (int)$item->prices['product_price'] - (int)$item->prices['salesPrice'];
									if (!empty($item->prices['salesPrice'])) {
										echo $currency->createPriceDiv('salesPrice', JText::_("Price: "), $price, false, false, 1.0, true);
									}
									if (!empty($item->prices['salesPriceWithDiscount'])) {
										echo $currency->createPriceDiv('salesPriceWithDiscount', JText::_("Price: "), $price, false, false, 1.0, true);
									}*/
									if(!empty($item->prices['discountAmount'])){
											echo $currency->createPriceDiv('discountAmount', JText::_("Price: "), $item->prices, false, false, 1.0, true);
									 }
								?>
							</div>
							<?php } ?>
							<div class="other-infor">
								<?php if ($params->get('item_created_display', 1) == 1) { ?>
									<div class="created-date ">
										<?php
										echo JHTML::_('date', $item->created_on, JText::_('DATE_FORMAT_LC3'));
										?>
									</div>
								<?php } ?>
			
								<?php if ($params->get('item_readmore_display') == 1) { ?> 
									<div class="item-readmore">
										<a href="<?php echo $item->link; ?>"
									   title="<?php echo $item->title ?>" <?php echo SjVMSuperCategoriesHelper::parseTarget($params->get('link_target')); ?> >
											<?php echo $params->get('item_readmore_text','Read More'); ?>
										</a>
									</div>
								<?php } ?>
							
							</div>
						</div>
					</div>
				<?php endif; ?>
				
				<?php if( $i%4 == 2 ) :?>
				<div class="items-list">	
					<div class="right-container">
					
				<?php endif; ?>
				
				<?php if( $i%4 > 1 || $i%4 == 0 ) : ?>
					<div class="item">
						<?php
						$item_img = SjVMSuperCategoriesHelper::getVmImage($item, $params, 'imgcfg');
						if ($item_img) {
							?>
							<div class="item-image">
								<a href="<?php echo $item->link ?>"
								   title="<?php echo $item->title; ?>" <?php echo SjVMSuperCategoriesHelper::parseTarget($params->get('link_target')); ?> >
									<?php echo SjVMSuperCategoriesHelper::imageTag($item_img, $small_image_config); ?>
									<span class="image-border"></span>
								</a>
								
							</div>
						<?php } ?>
						<div class="item-info">
							<?php if ($params->get('item_title_display', 1) == 1) { ?>
							<h3 class="item-title">
								<a href="<?php echo $item->link; ?>"
								   title="<?php echo $item->title ?>" <?php echo SjVMSuperCategoriesHelper::parseTarget($params->get('link_target')); ?> >
									<?php echo SjVMSuperCategoriesHelper::truncate($item->title, (int)$params->get('item_title_max_characters', 25)); ?>
								</a>
							</h3>
							<?php } ?>
							<?php if ((int)$params->get('item_prices_display', 1) && ( !empty($item->prices['salesPrice']) || !empty($item->prices['salesPriceWithDiscount'])) ) { ?>
							<div class="group-price">
								<div class="product-price">
									<div class="PricesalesPrice">
										<?php
										if (!empty($item->prices['salesPrice'])) {
											echo $currency->createPriceDiv('salesPrice', JText::_("Price: "), $item->prices, false, false, 1.0, true);
										}
										if (!empty($item->prices['salesPriceWithDiscount'])) {
											echo $currency->createPriceDiv('salesPriceWithDiscount', JText::_("Price: "), $item->prices, false, false, 1.0, true);
										} ?>
									</div>
									<div class="PricebasePriceVariant">
										<?php echo $currency->createPriceDiv ('basePriceVariant', '', $item->prices, false, false, 1.0, true);?>
									</div>
								</div>
							</div>
							<?php } ?>
							<?php if ((int)$params->get('item_description_display', 1) && SjVMSuperCategoriesHelper::_trimEncode($item->_description) != '') { ?>
							<div class="item-desc">
								<?php echo $item->_description;?>
							</div>
							<?php } ?>
							<?php if ((int)$params->get('item_prices_display_promotion', 1) == 1 && ( !empty($item->prices['salesPrice']) || !empty($item->prices['salesPriceWithDiscount'])) ) { ?>
							<div class="item-prices_promotion">
								<?php
								/*$price = (int)$item->prices['product_price'] - (int)$item->prices['salesPrice'];
									if (!empty($item->prices['salesPrice'])) {
										echo $currency->createPriceDiv('salesPrice', JText::_("Price: "), $price, false, false, 1.0, true);
									}
									if (!empty($item->prices['salesPriceWithDiscount'])) {
										echo $currency->createPriceDiv('salesPriceWithDiscount', JText::_("Price: "), $price, false, false, 1.0, true);
									}*/
									if(!empty($item->prices['discountAmount'])){
											echo $currency->createPriceDiv('discountAmount', JText::_("Price: "), $item->prices, false, false, 1.0, true);
									 }
								?>
							</div>
							<?php } ?>
							<div class="other-infor">
								<?php if ($params->get('item_created_display', 1) == 1) { ?>
									<div class="created-date ">
										<?php
										echo JHTML::_('date', $item->created_on, JText::_('DATE_FORMAT_LC3'));
										?>
									</div>
								<?php } ?>
			
								<?php if ($params->get('item_readmore_display') == 1) { ?> 
									<div class="item-readmore">
										<a href="<?php echo $item->link; ?>"
									   title="<?php echo $item->title ?>" <?php echo SjVMSuperCategoriesHelper::parseTarget($params->get('link_target')); ?> >
											<?php echo $params->get('item_readmore_text','Read More'); ?>
										</a>
									</div>
								<?php } ?>
								
							</div>
						</div>
					</div>
				<?php endif; ?>
				
				<?php  if( $i%4 == 0 || $i == $count ):?>
					</div>
					</div>
					</div>
				<?php endif; ?>
			
		 <?php if ($params->get('type_show') == 'loadmore'){ ?>
        </div>
    <?php }?>
	
        <?php
        if($params->get('type_show') == 'loadmore'){
        $clear = 'clr1';
        if ($k % 2 == 0) $clear .= ' clr2';
        if ($k % 3 == 0) $clear .= ' clr3';
        if ($k % 4 == 0) $clear .= ' clr4';
        if ($k % 5 == 0) $clear .= ' clr5';
        if ($k % 6 == 0) $clear .= ' clr6';
        ?>
        <div class="<?php echo $clear; ?>"></div>
        <?php } ?>
		
	<?php
	} ?>

	<?php if ($params->get('type_show') == 'slider') { ?>
			</div>
	<?php } ?>
<?php
}else{ echo 'Has no content to show';}?>


<?php if ($params->get('type_show') == 'slider') { ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            var $tag_id = $('#<?php echo $tag_id; ?>'),
                parent_active = 	$('.spcat-items-selected', $tag_id),
                total_product = parent_active.data('total'),
                tab_active = $('.ltabs-items-inner',parent_active),
                nb_column1 = <?php echo $params->get('nb-column1'); ?>,
                nb_column2 = <?php echo $params->get('nb-column2'); ?>,
                nb_column3 = <?php echo $params->get('nb-column3'); ?>,
                nb_column4 = <?php echo $params->get('nb-column4'); ?>;

            tab_active.owlCarousel({
                nav: <?php echo $params->get('display_nav_s') ; ?>,
                dots: false,
                margin: 30,
                loop:  <?php echo $params->get('display_loop_s') ; ?>,
                autoplay: <?php echo $params->get('autoplay_s'); ?>,
                autoplayHoverPause: <?php echo $params->get('pausehover_s') ; ?>,
                autoplayTimeout: <?php echo $params->get('autoplay_timeout_s') ; ?>,
                autoplaySpeed: <?php echo $params->get('autoplay_speed_s') ; ?>,
                mouseDrag: <?php echo  $params->get('mousedrag_s'); ?>,
                touchDrag: <?php echo $params->get('touchdrag_s'); ?>,
                navRewind: true,
                navText: [ '', '' ],
                responsive: {
                    0: {
                        items: nb_column4,
                        nav: total_product <= nb_column4 ? false : ((<?php echo $params->get('display_nav_s') ; ?>) ? true: false),
                    },
                    480: {
                        items: nb_column3,
                        nav: total_product <= nb_column3 ? false : ((<?php echo $params->get('display_nav_s') ; ?>) ? true: false),
                    },
                    768: {
                        items: nb_column2,
                        nav: total_product <= nb_column2 ? false : ((<?php echo $params->get('display_nav_s') ; ?>) ? true: false),
                    },
                    1200: {
                        items: nb_column1,
                        nav: total_product <= nb_column1 ? false : ((<?php echo $params->get('display_nav_s') ; ?>) ? true: false),
                    },
                }
            });

        });
    </script>
<?php } ?>