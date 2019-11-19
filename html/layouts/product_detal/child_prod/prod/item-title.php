<?php
	
	extract( $displayData );
	
?>

<div class="item-title ">
	<a href="<?= JRoute::_( $item->link )  ?>" title="<?= $item->product_name ?>">
		<?= $item->product_name ?>
	</a>
</div>
