<?php
	extract( $displayData );
	$doc = JFactory::getDocument();
	$doc->addStyleSheet('/templates/sj_revo/html/layouts/category/category_description.css');
	
?>
<div class="layout">
	<div class="bottom-text bottom-text_state_collapsed">
		<div class="category_description easy">
			<?php echo $category->category_description; ?>
		</div>
	</div>
	<button class="bottom-text__toggler button_type_link" type="button" onclick="category_description(event , this)">
		<span class="link-dotted">Читать полностью</span>
	</button>
</div>
<script>
    function category_description(event , el) {
        var $=jQuery;
        var $el = $(el);
        $el.parent().find('.bottom-text_state_collapsed').removeClass('bottom-text_state_collapsed');
        $(el).remove();
    }
</script>
