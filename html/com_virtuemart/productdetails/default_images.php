<?php
/**
 *
 * Show the product details page
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen

 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_images.php 8657 2015-01-19 19:16:02Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
// Product Main Image
if (!empty($this->product->images[0])) {
    $imagesrcmain = YTTemplateUtils::resize($this->product->images[0]->file_url, '600', '600', 'fill');
?>
    <div class="main-image">
        <img id="zoom_img" class="img-large"  src="<?php echo $imagesrcmain;?>" title="" alt="" />
    </div>

    <?php
}
?>

<?php
// Showing The Additional Images
if (!empty($this->product->images) and count ($this->product->images)>1) {   ?>
        <div id="addimgzoom" class="owl-carousel addimgzoom">
                <?php
                // List all Images
                if (count($this->product->images) > 0) {
                    foreach ($this->product->images as $key=>$image) {
                        $imageslarge = YTTemplateUtils::resize($image->file_url, '800', '800', 'fill');
                        $imagesradditional = YTTemplateUtils::resize($image->file_url, '158', '158', 'fill');
                        ?>
                        <div>
                            <a href="#" title="" data-image="<?php echo $imageslarge;?>"   >
                                <img id="zoom_img"  class="nav_thumb" src="<?php echo $imagesradditional;?>" alt="" />
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
        </div>
<?php
} // Showing The Additional Images END ?>

<?php
$document = JFactory::getDocument();
$app = JFactory::getApplication();
$templateDir = JURI::base() . 'templates/' . $app->getTemplate();
?>
<script type="text/javascript" src="<?php echo $templateDir.'/js/jquery.elevateZoom-3.0.8.min.js' ?>"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
       var zoomCollection = '.main-image img';
		$( zoomCollection ).elevateZoom({
            gallery:'addimgzoom',
            cursor: 'crosshair',
            galleryActiveClass: 'active',
            easing:true,
			zoomType	: "inner",
			lensSize    : 150,
           
        });
       
        $('.addimgzoom').owlCarousel({
            responsive:{
				0:{
					items:3
				},
				768:{
					items:4
				},
				992:{
					items:4
				}
			},
            loop:false,
            nav:true,
            dots:false,
            lazyLoad: true,
			margin: 9,
            navText: [ '<i class="fa fa-caret-left" aria-hidden="true"></i>', '<i class="fa fa-caret-right" aria-hidden="true"></i>' ],
        });
    });
</script>
