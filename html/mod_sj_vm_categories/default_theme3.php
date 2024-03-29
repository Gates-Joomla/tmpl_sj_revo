<?php
/**
 * @package SJ Categories for VirtueMart
 * @version 2.2.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2014 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
defined('_JEXEC') or die;

JHtml::stylesheet('modules/' . $module->module . '/assets/css/sj-categories.css');
ImageHelper::setDefault($params);
$uniqued = 'sj_categories_' . rand() . time();
$options = $params->toObject();

$big_image_config = array(
    'type' => $params->get('imgcfgcat_type'),
    'width' => $params->get('imgcfgcat_width'),
    'height' => $params->get('imgcfgcat_height'),
    'quality' => 90,
    'function' => ($params->get('imgcfgcat_function') == 'none') ? null : 'resize',
    'function_mode' => ($params->get('imgcfgcat_function') == 'none') ? null : substr($params->get('imgcfgcat_function'), 7),
    'transparency' => $params->get('imgcfgcat_transparency', 1) ? true : false,
    'background' => $params->get('imgcfgcat_background'));
?>

<div id="owl-carousel-cate-featured" class="theme3">
    <?php $j = 0;
    foreach ($list as $key => $items) {
        $j++;
        ?>
        <div class="item">
            <?php  $cat_img = VmCategoriesHelper::getVmCImage($items, $params, 'imgcfgcat');
            if (($cat_img) && (strlen($cat_img['src']) != '')) {
                ?>
                <div class="image-cat">
                    <?php $caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id=' . $items->virtuemart_category_id); ?>
                    <a href="<?php echo $caturl; ?>"
                       title="<?php echo $items->category_name; ?>" <?php echo VmCategoriesHelper::parseTarget($options->target); ?> >
                        <img src="<?php echo VmCategoriesHelper::imageSrc($cat_img, $big_image_config); ?>"
                             title="<?php echo $items->category_name; ?>" alt="<?php echo $items->category_name; ?>"/>
                    </a>
                </div>
            <?php } ?>
            <?php if ((int)$params->get('cat_title_display', 1)) { ?>
                <h3 class="cat-title">
                    <?php $caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id=' . $items->virtuemart_category_id); ?>
                    <a href="<?php echo $items->category_name; ?>"
                       title="<?php echo $items->category_name; ?> " <?php echo VmCategoriesHelper::parseTarget($options->target); ?> >
                        <?php echo VmCategoriesHelper::truncate($items->category_name, (int)$params->get('cat_title_maxcharacs', 25)); ?>
                    </a>
                </h3>
            <?php } ?>

            <?php if ((int)$params->get('cat_sub_title_display', 1)) { ?>
                <div class="child-cat">
                    <?php
                    if (!empty($items->child_cat)) {
                        foreach ($items->child_cat as $key1 => $item) {
                            ?>
                            <div class="arrow"></div>
                            <div class="child-cat-title">
                                <?php $caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id=' . $item->virtuemart_category_id); ?>
                                <a href="<?php echo $caturl; ?>" <?php echo VmCategoriesHelper::parseTarget($options->target); ?>>
                                    <?php echo VmCategoriesHelper::truncate($item->category_name, (int)$params->get('cat_sub_title_maxcharacs', 25)); ?><?php if ($params->get('cat_all_product') == 1) {
                                        echo '&nbsp;&nbsp;(' . $item->number_product . ')';
                                    } ?>
                                </a>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <p>
                            <?php echo JText::_('No sub-categories to show!'); ?>
                        </p>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        
    <?php } ?>
</div>
     
 
 