<?php
	extract( $displayData );
	$currency = CurrencyDisplay::getInstance();
	
	
	$Price =  $currency->createPriceDiv('salesPrice', $description = 'От', $item->prices, FALSE, FALSE, 1.0, FALSE);
 
	
	?>
<div class="item-price">
		<div class="PricesalesPrice vm-display vm-price-value">
			<span class="PricesalesPrice"><?= $Price ?></span>
		</div>
	</div>
