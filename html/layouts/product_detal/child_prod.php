<?php
	
	extract( $displayData );
	$doc = JFactory::getDocument();
	$doc->addStyleSheet('/templates/sj_revo/html/layouts/product_detal/child_prod/prod.css');
	$doc->addScript('/templates/sj_revo/html/layouts/product_detal/child_prod/prod.js');
	
	if( !isset($Child) )
	{
		$Child = null ;
	}#END IF
	
	?>
	
	<div id="child_prod">
	    <div class="row">
		    <div class=" col-sm-12">
	
	
	
<?php
    $newArr = [] ;
	foreach( $Child as $item )
	{
		$newArr[$item->virtuemart_category_id][] = $item ;
	}#END FOREACH
	
	$i = null ;
	foreach( $newArr as $virtuemart_category_id => $category )
	{
		
	 //   echo'<pre>';print_r( $category[0]->category_name );echo'</pre>'.__FILE__.' '.__LINE__;
	    
		$tabsHtml.=  $this->sublayout('tabs' , [ 'item' => $category[0] , 'i' => $i ] );

		foreach( $category as $item )
		{
			$itemHtml .=  $this->sublayout('prod' , [ 'product_model'=>$product_model ,'item' => $item , 'i' => $i ] );
	    }#END FOREACH
		
		$i++;
  
	}#END FOREACH
        ?>
            <div id="tabs-child">
				<?= $tabsHtml ?>
            </div>
            <div id="item-child">
				<?= $itemHtml ?>
            </div>
 
		</div>
	</div>
	</div>
	
<?php
	

