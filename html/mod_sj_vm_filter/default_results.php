<?php
/**
 * @package Sj Filter for VirtueMart
 * @version 3.0.1
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2015 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */

defined('_JEXEC') or die;

?>

<div id="ft_results_<?php echo $this->_module->id; ?>" class="ft-results">
	<?php
	if (!empty($this->products)) {
		$yt_temp = JFactory::getApplication()->getTemplate();
		$path_template = JPATH_BASE . '/templates/'.$yt_temp.'/html/com_virtuemart/category/default.php';
		if (file_exists ($path_template)){
			require ($path_template);
		}
	} else {
		echo 'No Results';
	}
	?>
</div>