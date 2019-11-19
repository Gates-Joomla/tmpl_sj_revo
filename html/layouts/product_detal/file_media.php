<?php
	extract( $displayData );
	
//	echo'<pre>';print_r( $product->product_sku );echo'</pre>'.__FILE__.' '.__LINE__;
//	die(__FILE__ .' '. __LINE__ );
	
	?>
<div class="product-field-display">
	<div class="Artikul">
		<p>
			<span style="font-size: 10pt; color: #777;">
				Артикул товара: <?= $product->product_sku ?>
			</span>
		</p>
	</div>
	<?php
	foreach( $product->customfieldsSorted['textpr2'] as $item )
	{
		echo $item->display	;
	}#END FOREACH
	?>
</div>
	
	

