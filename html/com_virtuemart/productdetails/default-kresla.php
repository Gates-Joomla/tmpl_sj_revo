<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

/* Let's see if we found the product */
if (empty($this->product)) {
    echo vmText::_('COM_VIRTUEMART_PRODUCT_NOT_FOUND');
    echo '<br /><br />  ' . $this->continue_link_html;
    return;
}
	
	$product_model = VmModel::getModel('product');
	$ChildIds = $product_model->getProductChildIds ( $this->product->virtuemart_product_id );
	
	$Pch = $product_model->getProducts($ChildIds);
	
	
	
	echo shopFunctionsF::renderVmSubLayout('askrecomjs',array('product'=>$this->product));
	
	


vmJsApi::jDynUpdate();
vmJsApi::addJScript('updDynamicListeners',"
jQuery(document).ready(function() { // GALT: Start listening for dynamic content update.
    // If template is aware of dynamic update and provided a variable let's
    // set-up the event listeners.
    if (Virtuemart.container)
        Virtuemart.updateDynamicUpdateListeners();

}); ");

if(vRequest::getInt('print',false)){ ?>
<body onload="javascript:print();">
<?php } ?>

<div class="productdetails-view productdetails">
   <?php
    // Product Navigation
    if (VmConfig::get('product_navigation', 1)) {
    ?>
        <div class="product-neighbours">
        <?php
        if (!empty($this->product->neighbours ['previous'][0])) {
        $prev_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['previous'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id, FALSE);
        echo JHtml::_('link', $prev_link, $this->product->neighbours ['previous'][0]
            ['product_name'], array('rel'=>'prev', 'class' => 'previous-page','data-dynamic-update' => '0'));
        }
        if (!empty($this->product->neighbours ['next'][0])) {
        $next_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['next'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id, FALSE);
        echo JHtml::_('link', $next_link, $this->product->neighbours ['next'][0] ['product_name'], array('rel'=>'next','class' => 'next-page','data-dynamic-update' => '0'));
        }
        ?>
        <div class="clear"></div>
        </div>
    <?php } // Product Navigation END
    ?>
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="vm-product-media-container">
				<?php echo $this->loadTemplate('images'); ?>
			</div>
		</div>
		<div class="col-md-6 col-sm-12">
			<div class="vm-product-container">
				<div class="vm-product-top-container">
					<?php // Back To Category Button
				if ($this->product->virtuemart_category_id) {
					$catURL =  JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$this->product->virtuemart_category_id, FALSE);
					$categoryName = $this->product->category_name ;
				} else {
					$catURL =  JRoute::_('index.php?option=com_virtuemart');
					$categoryName = vmText::_('COM_VIRTUEMART_SHOP_HOME') ;
				}
				?>
			   
			
				<?php // Product Title   ?>
				<h1><?php echo $this->product->product_name ?></h1>
                
                <?php
                    # РЕЙТИНГ + ИЗБРАНОЕ + ПОДЕЛИТСЯ
                    # Расположение слоя
                    # /templates/sj_revo/html/layouts/product_detal/rating.php
                    echo JLayoutHelper::render('product_detal.rating', ['product'=>$this->product]);
                ?>
  
                
                
                    
				<?php // Product Title END   ?>
			
				<?php // afterDisplayTitle Event
				echo $this->product->event->afterDisplayTitle ?>
			
				<?php
				// Product Edit Link
				echo $this->edit_link;
				// Product Edit Link END
				?>
				<?php
					
				
     
     
				// PDF - Print - Email Icon
				
				if (VmConfig::get('show_emailfriend') || VmConfig::get('show_printicon') || VmConfig::get('pdf_icon')) {
				?>
					<div class="icons">
					<?php

					$link = 'index.php?tmpl=component&option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->virtuemart_product_id;

					echo $this->linkIcon($link . '&format=pdf', 'COM_VIRTUEMART_PDF', 'pdf_button', 'pdf_icon', false);
					//echo $this->linkIcon($link . '&print=1', 'COM_VIRTUEMART_PRINT', 'printButton', 'show_printicon');
					echo $this->linkIcon($link . '&print=1', 'COM_VIRTUEMART_PRINT', 'printButton', 'show_printicon',false,true,false,'class="printModal"');
					$MailLink = 'index.php?option=com_virtuemart&view=productdetails&task=recommend&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component';
					echo $this->linkIcon($MailLink, 'COM_VIRTUEMART_EMAIL', 'emailButton', 'show_emailfriend', false,true,false,'class="recommened-to-friend"');
					?>
					<div class="clearfix"></div>
					</div>
				<?php } // PDF - Print - Email Icon END
				?>
				
				</div>
				<?php
					# Расположение слоя
					# /templates/sj_revo/html/layouts/product_detal/file_media.php
					echo JLayoutHelper::render('product_detal.product_squ', ['product'=>$this->product]); ?>
     
				<div class="vm-product-details-container">
				<?php
                    
     
                    
//					echo shopFunctionsF::renderVmSubLayout('rating',array('showRating'=>$this->showRating,'product'=>$this->product));
					// @todo
					// echo '<br/>'; ?>
                    
                    <div style="">
                        <span class="kol55">Доступность: </span> В наличии
                    </div>
					
                    <?php
	
	
	                    echo shopFunctionsF::renderVmSubLayout( 'prices' , [ 'product' => $this->product , 'currency' => $this->currency ] );
	                    // echo shopFunctionsF::renderVmSubLayout('stockhandle',array('product'=>$this->product));
	
                     
                     
	                    
	                    ?>
                    <div class="del-sep"></div>
                    
                    <?php
                    


                    ?>
				   
					<?php
				// Product Short Description
				if (!empty($this->product->product_s_desc)) {
				?>
					<div class="product-short-description">
					
					<?php
					/** @todo Test if content plugins modify the product description */
					echo nl2br($this->product->product_s_desc);
					?>
					</div>
				<?php
				} // Product Short Description END
				?>
					<div class="spacer-buy-area">
			
					<?php
					// TODO in Multi-Vendor not needed at the moment and just would lead to confusion
					/* $link = JRoute::_('index2.php?option=com_virtuemart&view=virtuemart&task=vendorinfo&virtuemart_vendor_id='.$this->product->virtuemart_vendor_id);
					  $text = vmText::_('COM_VIRTUEMART_VENDOR_FORM_INFO_LBL');
					  echo '<span class="bold">'. vmText::_('COM_VIRTUEMART_PRODUCT_DETAILS_VENDOR_LBL'). '</span>'; ?><a class="modal" href="<?php echo $link ?>"><?php echo $text ?></a><br />
					 */
					?>
					<?php
                     if (is_array($this->productDisplayShipments)) {
						foreach ($this->productDisplayShipments as $productDisplayShipment) {
						    echo $productDisplayShipment . '';
						}
					}
					if (is_array($this->productDisplayPayments)) {
						foreach ($this->productDisplayPayments as $productDisplayPayment) {
						echo $productDisplayPayment . '';
						}
					}
			
					//In case you are not happy using everywhere the same price display fromat, just create your own layout
					//in override /html/fields and use as first parameter the name of your file
			
					?>
						<?php
					echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$this->product));
			
			
					 
	                    // Ask a question about this product
	                    if( VmConfig::get( 'ask_question' , 0 ) == 1 )
	                    {
		                    $askquestion_url = JRoute::_( 'index.php?option=com_virtuemart&view=productdetails&task=askquestion&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component' , false );
		                    ?>
                        <div class="form-group question">
                            <a class="ask-a-question button" onclick="askQuestionEvent(event , this)"
                               href="<?php echo $askquestion_url ?>"
                               rel="nofollow">
								<?php echo vmText::_( 'COM_VIRTUEMART_PRODUCT_ENQUIRY_LBL' ) ?>
                                <span class="jcemediabox-zoom-link"></span>
                            </a>
                        </div>
						<?php
						}
						
						
							
							
					# Расположение слоя
					# /templates/sj_revo/html/layouts/product_detal/file_media.php
					echo JLayoutHelper::render('product_detal.file_media', ['product'=>$this->product]);
					
					
					echo JLayoutHelper::render('product_detal.shipping_and_payment', ['product'=>$this->product]);
	    
					?>
			
					<?php
					// Manufacturer of the Product
					if (VmConfig::get('show_manufacturers', 1) && !empty($this->product->virtuemart_manufacturer_id)) { ?>
						<div class="form-group">
							<?php echo $this->loadTemplate('manufacturer');?>
						</div>
					<?php
					} ?>
			
					</div>
                    
     
                    
                    
					<!-- Item Social Button -->
					<div class="itemSocialBlock">
						<strong><?php echo JText::_('Соц.Сети'); ?></strong>
						 <div class="post_social">
							<a href="javascript:void(0)" class="icon-fb" onclick="javascript:genericSocialShare('http://www.facebook.com/sharer.php?u=<?php echo JURI::current();?>&amp;url=<?php echo JURI::current();?>')" title="Facebook Share"><i class="fa fa-facebook" aria-hidden="true"></i></a>
							<a href="javascript:void(0)" onclick="javascript:genericSocialShare('https://plus.google.com/share?url=<?php echo JURI::current();?>')" class="icon-gplus" title="Google Plus Share"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
							<a href="javascript:void(0)" class="icon-tw" onclick="javascript:genericSocialShare('http://twitter.com/share?text=<?php echo $this->item->title?>&amp;url=<?php echo JURI::current();?>')" title="Twitter Share"><i class="fa fa-twitter" aria-hidden="true"></i></a>
							<a href="javascript:void(0)" class="icon-linked_in" onclick="javascript:genericSocialShare('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo JURI::current();?>')" title="LinkedIn Share"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
							<a href="javascript:void(0)" class="icon-linked_in" onclick="javascript:genericSocialShare('http://pinterest.com/pin/create/button/?url=<?php echo JURI::current();?>')" title="Pinterest Share"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
						</div>
						<script type="text/javascript">
						function genericSocialShare(url){
							window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
							return true;
						}
						</script>
					</div>
					
					
				</div>
				<div class="clear"></div>
			</div>
		</div>

		<div id="yt_tab_products" class="tab-product-detail col-md-12">
			<div class="tab-product">
				
                <?php
	                JLoader::registerNamespace( 'GNZ11' , JPATH_LIBRARIES . '/GNZ11' , $reset = false , $prepend = false , $type = 'psr4' );
	                $this->product->youtube = [] ;
	                preg_match( '/\[(.+)\]/i' , $this->product->product_desc, $matches );
	                $res = GNZ11\Core\Helpers\Helper::get_delimited($matches[0]) ;
	                if( count( $res) )
	                {
		               
		                $this->product->youtube['url'] = $res[0] ;
		                $this->product->youtube['width'] = $res[1] ;
		                $this->product->youtube['height'] = $res[2] ;
		                $this->product->youtube['responsive'] = $res[3] ;
		
	                }#END IF
	                
	
	
	              
                 
                ?>
                
                
                <ul class="nav nav-tabs" id="add-reviews" >
					<li class="active"><a  href="#description" data-toggle="tab"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_DESC_TITLE') ?></a></li>
					<li ><a href="#characteristics" data-toggle="tab"><?php echo vmText::_('Характеристики') ?></a></li>
					<?php
						if( count($this->product->youtube) )
						{
						    ?>
                            <li ><a href="#youtube" data-toggle="tab"><?php echo vmText::_('Видеопревью') ?></a></li>
                            <?php
						}#END IF
                    
                    ?>
                    
					<li ><a href="#colors" data-toggle="tab"><?php echo vmText::_('Цвета') ?></a></li>
					<li ><a href="#delivery" data-toggle="tab"><?php echo vmText::_('Доставка') ?></a></li>
<!--					<li ><a href="#reviews" data-toggle="tab">--><?php //echo vmText::_('COM_VIRTUEMART_REVIEWS') ?><!--</a></li>-->
<!--					<li ><a href="#others" data-toggle="tab">--><?php //echo vmText::_('COM_VIRTUEMART_OTHERS') ?><!--</a></li>-->
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="description">
						<?php
						// Product Description
						if (!empty($this->product->product_desc)) {
							?>
							<div class="product-description">
						<?php /** @todo Test if content plugins modify the product description */ ?>
						<?php
							
							
                            $pattern[] = '/\[(.+)\]/i';
                            $pattern[] = '/\<p\>\<strong\>Видеопревью.+\<\/p\>/i';
							$replacement = '';
							$this->product->product_desc =  preg_replace($pattern, $replacement, $this->product->product_desc );
                            echo $this->product->product_desc;
                            ?>
							</div>
						<?php
						} // Product Description END
						?>
	
					</div>
                    <?php // Характеристики ?>
                    <div class="tab-pane" id="characteristics">
						<?php echo $this->loadTemplate('characteristics'); ?>
                    </div>
                    <?php // youtube
	                    if( count( $this->product->youtube ) )
	                    {
		                    echo $this->loadTemplate( 'youtube' );
	                    }
                     ?>
                    <?php // Цвета ?>
                    <div class="tab-pane" id="colors">
						<?php echo $this->loadTemplate('colors'); ?>
                    </div>
                    <?php // Доставка ?>
                    <div class="tab-pane" id="delivery">
						<?php echo $this->loadTemplate('delivery'); ?>
                    </div>

<!--					<div class="tab-pane" id="reviews">-->
<!--						 --><?php //echo $this->loadTemplate('reviews'); ?>
<!--					</div>-->
	
					<div class="tab-pane" id="others">
						<?php
						echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'ontop'));
						echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'normal'));
						echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'onbot'));
	
						// Product Packaging
						$product_packaging = '';
						if ($this->product->product_box) {
						?>
							<div class="product-box">
							<?php
								echo vmText::_('COM_VIRTUEMART_PRODUCT_UNITS_IN_BOX') .$this->product->product_box;
							?>
							</div>
						<?php } // Product Packaging END ?>
	
					</div>
	
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>

		<?php


		// event onContentBeforeDisplay
		echo $this->product->event->beforeDisplayContent; ?>
		<div class="col-md-12">
		
			<?php
		
			echo shopFunctionsF::renderVmSubLayout('related_products',array('product'=>$this->product,'position'=>'related_products','class'=> 'product-related-products','customTitle' => true ));
		
			echo shopFunctionsF::renderVmSubLayout('related_categories',array('product'=>$this->product,'position'=>'related_categories','class'=> 'product-related-categories'));
		
			?>
		</div>
	
		<div class="clear"></div>
		<?php // onContentAfterDisplay event
		echo $this->product->event->afterDisplayContent;
		echo vmJsApi::writeJS();
		?>
	</div>
    
    <?php
	    # extract( $displayData );
	    $displayData = [ 'product_model'=>$product_model,'Child' => $Pch   ];
	    # Расположение слоя
	    # /templates/sj_revo/html/layouts/product_detal/child_prod.php
	    echo JLayoutHelper::render('product_detal.child_prod', $displayData);
    
    
    ?>
    
    
    
    
</div>




<script>
    // GALT
    /*
     * Notice for Template Developers!
     * Templates must set a Virtuemart.container variable as it takes part in
     * dynamic content update.
     * This variable points to a topmost element that holds other content.
     */
    // If this <script> block goes right after the element itself there is no
    // need in ready() handler, which is much better.
    //jQuery(document).ready(function() {
    Virtuemart.container = jQuery('.productdetails-view');
    Virtuemart.containerSelector = '.productdetails-view';
    //Virtuemart.container = jQuery('.main');
    //Virtuemart.containerSelector = '.main';
    //});
</script>

