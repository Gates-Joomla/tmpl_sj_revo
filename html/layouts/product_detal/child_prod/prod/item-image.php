<?php
	extract( $displayData );?>


<div class="item-image cf">
	<a href="<?= JRoute::_( $item->link )  ?>" title="<?= $item->product_name ?>">
		<img width="230"
		     src="<?=$item->images[0]->file_url?>"
		     alt="<?= $item->product_name ?>"
		     title="<?= $item->product_name ?>">
	</a>
</div>
