<?php
	extract( $displayData );
	
	
	$product_model->addImages($item);
 
 
	if( $i >0  )
	{
	    $cls = 'hidden' ;
    }#END IF
?>
<div class="respl-item category-21 isotope-item <?= $cls ?>"
     data-product_price="2631"
     data-created="1487166731"
     data-latest="1569820770"
     data-ordering="0" data-topten="0"
     data-title="стол т300 (800х600х752)"
     data-id="144" data-catid="<?= $item->virtuemart_category_id ?>" style="">
	<div class="item-inner">
		
		
		<?= $this->sublayout('item-image' , [ 'item' => $item ] );  ?>
        
        <?= $this->sublayout('item-title' , [ 'item' => $item ] );  ?>
		
		<?= $this->sublayout('item-price' , [ 'item' => $item ] );  ?>
		
        <?= $this->sublayout('item-addtocart' , [
                'item' => $item ,
                'itemId' =>$itemId ,
		] );  ?>
    </div>
</div>


