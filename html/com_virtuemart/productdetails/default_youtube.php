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
 * @version $Id: default_reviews.php 9227 2016-05-27 10:55:25Z Milbo $
 */

// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die ('Restricted access');
	$pattern[] = 'https://youtu.be/';
	$replacement[] = 'https://www.youtube.com/embed/';
	$this->product->youtube['url'] = str_replace($pattern , $replacement , $this->product->youtube['url'] );
 
	?>

<div class="tab-pane" id="youtube">

	<iframe width="<?=$this->product->youtube['width']?>" height="<?=$this->product->youtube['height']?>"
	        src="<?=$this->product->youtube['url']?>"
	        frameborder="0"
	        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
	        allowfullscreen>
		
	</iframe>

</div>

	

