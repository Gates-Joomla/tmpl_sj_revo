<?php
	extract( $displayData );
	
 
	
	?>

    
 
<div class="product-field-display">
 
	<?php
	foreach( $product->customfieldsSorted['textpr2'] as $item )
	{
		echo $item->display	;
	}#END FOREACH
	?>
</div>
	
	

