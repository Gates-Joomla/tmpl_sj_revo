<?php
	extract( $displayData ); ?>
<div class="item-addtocart">
	<div class="addtocart-area">
		<form method="post" class="product js-recalculate" action="#">
			<div class="vm-customfields-wrap">
			</div>
			<div class="addtocart-bar">
				<!-- <label for="quantity144" class="quantity_box">Кол-во: </label> -->
				<span class="quantity-box">
<input type="text" class="quantity-input js-recalculate" name="quantity[]" data-errstr="Вы можете приобрести этот товар только в партии, состоящей из %s единиц(ы) товара!" value="1" init="1" step="1">
</span>
				<span class="quantity-controls js-recalculate">
<input type="button" class="quantity-controls quantity-plus">
<input type="button" class="quantity-controls quantity-minus">
</span>
				<span class="addtocart-button">
<input type="submit" name="addtocart" class="addtocart-button" value="Купить" title="Купить">	</span> <input type="hidden" name="virtuemart_product_id[]" value="144">
				<noscript><input type="hidden" name="task" value="add"/></noscript> </div>	<input type="hidden" name="option" value="com_virtuemart">
			<input type="hidden" name="view" value="cart">
			<input type="hidden" name="virtuemart_product_id[]" value="144">
			<input type="hidden" name="pname" value="Стол Т300 (800х600х752)">
			<input type="hidden" name="pid" value="144">
			<input type="hidden" name="Itemid" value="130">	</form>
	</div>
</div>