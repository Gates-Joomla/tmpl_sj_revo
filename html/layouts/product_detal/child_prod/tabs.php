<?php extract( $displayData );
	
	$class = null ;
	if( $i == 0  )
	{
		$class = 'select_tab';
	}#END IF

?>

<div class="<?= $class ?>" data-cat_id="<?= $item->virtuemart_category_id ?>" onclick="ChildProdShow(this)">
	<?= $item->category_name?>
</div>

