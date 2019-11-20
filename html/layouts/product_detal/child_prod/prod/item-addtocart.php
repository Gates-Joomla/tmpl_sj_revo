<?php
	extract( $displayData );
	
	
//	echo'<pre>';print_r( $itemId  );echo'</pre>'.__FILE__.' '.__LINE__;
//	die(__FILE__ .' '. __LINE__ );
	
	?>
<div class="item-addtocart">
	<div class="addtocart-area">
		<form method="post" class="product js-recalculate" action="#">
			<div class="vm-customfields-wrap">
			</div>
			<div class="addtocart-bar">
				 
				<!--<span class="quantity-box">
                    <input type="text" class="quantity-input js-recalculate"
                           name="quantity[]"
                           data-errstr="Вы можете приобрести этот товар только в партии, состоящей из %s единиц(ы) товара!"
                           value="1"
                           init="1"
                           step="1"/>
                </span>
				<span class="quantity-controls js-recalculate">
                    <input type="button" class="quantity-controls quantity-plus">
                    <input type="button" class="quantity-controls quantity-minus">
                </span>
                -->
				<span class="addtocart-button">
                    <input type="submit"
                           name="addtocart"
                           class="addtocart-button"
                           value="Добавить в корзину"
                           title="Добавить в корзину">	</span>
<!--                <input type="hidden" name="virtuemart_product_id[]" value="144">-->
				<noscript>
                    <input type="hidden" name="task" value="add"/>
                </noscript>
            </div>
            <input type="hidden" name="option" value="com_virtuemart">
			<input type="hidden" name="view" value="cart">
			<input type="hidden" name="virtuemart_product_id[]" value="<?= $item->virtuemart_product_id?>">
			<input type="hidden" name="pname" value="<?=$item->product_name?>">
			<input type="hidden" name="pid" value="<?= $item->virtuemart_product_id?>">
			<input type="hidden" name="Itemid" value="<?= $itemId ?>">	</form>
	</div>
</div>