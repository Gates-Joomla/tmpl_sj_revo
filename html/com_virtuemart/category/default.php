<?php
/**
 *
 * Show the products in a category
 *
 * @package    VirtueMart
 * @subpackage
 * @author RolandD
 * @author Max Milbers
 * @todo add pagination
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 9288 2016-09-12 15:20:56Z Milbo $
 */

defined ('_JEXEC') or die('Restricted access');

if(vRequest::getInt('dynamic')){
	if (!empty($this->products)) {
		if($this->fallback){
			$p = $this->products;
			$this->products = array();
			$this->products[0] = $p;
			vmdebug('Refallback');
		}

		echo shopFunctionsF::renderVmSubLayout($this->productsLayout,array('products'=>$this->products,'currency'=>$this->currency,'products_per_row'=>$this->perRow,'showRating'=>$this->showRating));

	}

	return ;
}
?> <div class="category-view"> <?php
$js = "
jQuery(document).ready(function () {
    jQuery('.orderlistcontainer').hover(
        function() { jQuery(this).find('.orderlist').stop().show()},
        function() { jQuery(this).find('.orderlist').stop().hide()}
    )
	
	// Click Button
	function display(view) {
		jQuery('.browse-view .row').removeClass('vm-list vm-grid').addClass(view);
		jQuery('.icon-list-grid .vm-view').removeClass('active');
		if(view == 'vm-list') {
			jQuery('.browse-view .product').addClass('col-lg-12');
			jQuery('.products-list .product .vm-product-media-container').addClass('col-md-4');
			jQuery('.products-list .product .product-info').addClass('col-md-8');
			jQuery('.icon-list-grid .' + view).addClass('active');
		}else{
			jQuery('.browse-view .product').removeClass('col-lg-12');
			jQuery('.products-list .product .vm-product-media-container').removeClass('col-md-4');
			jQuery('.products-list .product .product-info').removeClass('col-md-8');
			jQuery('.icon-list-grid .' + view).addClass('active');
		}
	}
		
    jQuery('.vm-view-list .vm-view').each(function() {
        var ua = navigator.userAgent,
        event = (ua.match(/iPad/i)) ? 'touchstart' : 'click';
        jQuery(this).bind(event, function() {
            jQuery(this).addClass(function() {
                if(jQuery(this).hasClass('active')) return '';
                return 'active';
            });
            jQuery(this).siblings('.vm-view').removeClass('active');
			catalog_mode = jQuery(this).data('view');
			display(catalog_mode);
			
        });

    });
});
";

vmJsApi::addJScript('vm.hover',$js);



// Show child categories

if (@$this->showcategory and empty($this->keyword)) {
	if (!empty($this->category->haschildren)) {
		echo ShopFunctionsF::renderVmSubLayout('categories',array('categories'=>$this->category->children));
	}
}

if($this->showproducts){
?>
<div class="browse-view">
<?php

if (@$this->showsearch or !empty($this->keyword)) {
	//id taken in the view.html.php could be modified
	$category_id  = vRequest::getInt ('virtuemart_category_id', 0); ?>

	<!--BEGIN Search Box -->
	<div class="virtuemart_search">
		<form action="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=category&limitstart=0', FALSE); ?>" method="get">
			<?php if(!empty($this->searchCustomList)) { ?>
			<div class="vm-search-custom-list">
				<?php echo $this->searchCustomList ?>
			</div>
			<?php } ?>

			<?php if(!empty($this->searchCustomValues)) { ?>
			<div class="vm-search-custom-values">
				<?php echo $this->searchCustomValues ?>
			</div>
			<?php } ?>
			
			<div class="vm-search-custom-search-input">
				<input name="keyword" class="inputbox" type="text" size="60" value="<?php echo $this->keyword ?>"/>
				<input type="submit" value="<?php echo vmText::_ ('COM_VIRTUEMART_SEARCH') ?>" class="button" onclick="this.form.keyword.focus();"/>
				<?php //echo VmHtml::checkbox ('searchAllCats', (int)$this->searchAllCats, 1, 0, 'class="changeSendForm"'); ?>
				<span class="vm-search-descr"> <?php echo vmText::_('COM_VM_SEARCH_DESC') ?></span>
			</div>

			<!-- input type="hidden" name="showsearch" value="true"/ -->
			<input type="hidden" name="view" value="category"/>
			<input type="hidden" name="option" value="com_virtuemart"/>
			<input type="hidden" name="virtuemart_category_id" value="<?php echo $category_id; ?>"/>
			<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>"/>
		</form>
	</div>
	<!-- End Search Box -->
<?php
	/*if(!empty($this->keyword)){
		?><h3><?php echo vmText::sprintf('COM_VM_SEARCH_KEYWORD_FOR', $this->keyword); ?></h3><?php
	}*/
	$j = 'jQuery(document).ready(function() {

jQuery(".changeSendForm")
	.off("change",Virtuemart.sendCurrForm)
    .on("change",Virtuemart.sendCurrForm);
})';

	vmJsApi::addJScript('sendFormChange',$j);
} ?>

<h1 class="cate-title"><?php echo vmText::_($this->category->category_name); ?></h1>
<?php // Show child categories
if(!empty($this->orderByList)) { ?>
<div class="orderby-displaynumber top">

	<div class="vm-view-list col-md-2 col-sm-3 col-xs-12">
		<div class="icon-list-grid">
			<div class="vm-view vm-grid active" data-view="vm-grid"><i class="listing-icon"></i></div>
			<div class="vm-view vm-list" data-view="vm-list"><i class="listing-icon"></i></div>
		</div>
    </div>
	
	<div class="toolbar-center col-md-10 col-sm-9 col-xs-12">
		<?php echo $this->orderByList['orderby']; ?>
		<div class="orderlistcontainer limitbox">
		<?php echo $this->vmPagination->getLimitBox ($this->category->limit_list_step); ?>
		</div>
		<div class="orderlistcontainer counter">
		<?php echo $this->vmPagination->getResultsCounter ();?>
		</div>
		
	</div>
</div> <!-- end of orderby-displaynumber -->

<?php } ?>



	<?php
	if (!empty($this->products)) {
	//revert of the fallback in the view.html.php, will be removed vm3.2
	if($this->fallback){
		$p = $this->products;
		$this->products = array();
		$this->products[0] = $p;
		vmdebug('Refallback');
	}

	echo shopFunctionsF::renderVmSubLayout($this->productsLayout,array('products'=>$this->products,'currency'=>$this->currency,'products_per_row'=>$this->perRow,'showRating'=>$this->showRating));
	?>
	
	<div class="orderby-displaynumber bottom">
		<div class="vm-view-list col-md-2 col-sm-3 col-xs-12">
			<div class="icon-list-grid">
				<div class="vm-view vm-grid active" data-view="vm-grid"><i class="listing-icon"></i></div>
				<div class="vm-view vm-list" data-view="vm-list"><i class="listing-icon"></i></div>
			</div>
		</div>
		
		<div class="toolbar-center col-md-10 col-sm-9 col-xs-12">
        
            <?php //echo $this->orderByList['orderby']; ?>
		
			<div class="orderlistcontainer limitbox">
				<?php echo $this->vmPagination->getLimitBox ($this->category->limit_list_step); ?>
			</div>
			<div class="orderlistcontainer counter">
			<?php echo $this->vmPagination->getResultsCounter ();?>
			</div>
			
		</div>

	</div> <!-- end of orderby-displaynumber -->
	<?php if(!empty($this->orderByList)) { ?>
	<div class="vm-pagination vm-pagination-bottom"><?php echo $this->vmPagination->getPagesLinks (); ?><span class="vm-page-counter"><?php echo $this->vmPagination->getPagesCounter (); ?></span></div>
	<?php } ?>
	
<?php } elseif (!empty($this->keyword)) {
	echo vmText::_ ('COM_VIRTUEMART_NO_RESULT') . ($this->keyword ? ' : (' . $this->keyword . ')' : '');
}
?>
</div>

<?php }

    if (empty($this->keyword) and !empty($this->category) and !empty($this->category->category_description)) {
	    # extract( $displayData );
	    $displayData = [ 'category'=>$this->category    ];
	    # Расположение слоя
	    # /templates/sj_revo/html/layouts/product_detal/child_prod.php
	    echo JLayoutHelper::render('category.category_description', $displayData);
    
}
	
	?>
 
</div>

<?php
if(VmConfig::get ('jdynupdate', TRUE)){
	$j = "Virtuemart.container = jQuery('.category-view');
	Virtuemart.containerSelector = '.category-view';";

	//vmJsApi::addJScript('ajaxContent',$j);
}
?>
<!-- end browse-view -->