<?php
/**
 * @package Sj Contact Ajax
 * @version 1.0.1
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2013 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
defined('_JEXEC') or die;

$tag_id = 'contact_ajax' . time() . rand();

JHtml::stylesheet('modules/' . $module->module . '/assets/css/styles.css');
JHtml::stylesheet('modules/' . $module->module . '/assets/css/font-awesome.css');

JHtml::script('modules/' . $module->module . '/assets/js/bootstrap-tooltip.js');
JHTML::_('behavior.calendar');

ob_start();
?>

<?php if ($params->get('maps_display') == 1) { ?>

	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=<?php echo $params->get('key_text') ?>"></script>
	<script type="text/javascript">
		function showLatLgn() {
			var geocoder = new google.maps.Geocoder();
			var sLat = "<?php echo $params->get('sLat'); ?>";
			var sLong = "<?php echo $params->get('sLong'); ?>";

			var latlng = new google.maps.LatLng(sLat, sLong);

			geocoder.geocode({"latLng": latlng}, function (data, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					var add = data[1].formatted_address; //this is the full address
					var myOptions = {
						zoom: <?php echo $params->get('map_zoom'); ?>,
						center: latlng,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};
					var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
					var marker = new google.maps.Marker({
						map: map,
						position: latlng
					});
					marker.setTitle('Address');
					attachSecretMessage(marker, add);
				} else {
					try {
						alert("Address not found");
					} catch (e) {
					}
				}

			})
		}

		function attachSecretMessage(marker, message) {
			var infowindow = new google.maps.InfoWindow(
				{
					content: message
				});
			google.maps.event.addListener(marker, 'click', function () {
				infowindow.open(marker.get('map'), marker);
			});
		}

		function showLocation() {
			var address = '<?php echo $params->get('address_text','Hanoi, Viet nam'); ?>';
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode({"address": address}, function (results, status) {
				// If the Geocoding was successful
				if (status == google.maps.GeocoderStatus.OK) {
					var myOptions = {
						zoom: <?php echo $params->get('map_zoom'); ?>,
						center: results[0].geometry.location,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};
					var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

					// Add a marker at the address.
					var marker = new google.maps.Marker({
						map: map,
						position: results[0].geometry.location
					});
					marker.setTitle('Address');
					attachSecretMessage(marker, address);
				} else {
					try {
						alert(address + " not found");
					} catch (e) {
					}
				}
			});
		}

		<?php if($params->get('select_type') == 0){ ?>
		google.maps.event.addDomListener(window, 'load', showLocation);
		<?php } else { ?>
		google.maps.event.addDomListener(window, 'load', showLatLgn);
		<?php } ?>

	</script>

<?php } ?>

<?php
$uri = JURI::getInstance();
$uri->setVar('contact_ajax', rand(100000, 999999) . time());
$uri->setVar('ctajax_modid', $module->id);
$options = $params->toObject();
?>
	<!--[if lt IE 9]>
	<div class="contact-ajax msie lt-ie9" id="<?php echo $tag_id; ?>"><![endif]-->
	<!--[if IE 9]>
	<div class="contact-ajax msie" id="<?php echo $tag_id; ?>"><![endif]-->
	<!--[if gt IE 9]><!-->
	<div class="contact-ajax" id="<?php echo $tag_id; ?>"><!--<![endif]-->
		<?php if (!empty($options->pretext)) { ?>
			<h3 class="modtitle"><?php echo $options->pretext; ?></h3>
		<?php } ?>
		<div class="ctajax-wrap">
			<div class="ctajax-element map-des">
				<div class="el-inner">
					<div class="el-map">
						<?php if ($params->get('maps_display') == 1) { ?>
							<div id="map-canvas" style="height:<?php echo $params->get('map_height') ?>px;
							width:<?php echo $params->get('map_width') ?>px;max-width:100%;"></div>
						<?php } ?>
					</div>
					<?php
					$desc = trim($list->misc);
					if ($desc != '') ?>
					<div class="el-desc">
						<?php echo $desc; ?>
					</div>
					
				</div>
			</div>
			<div class="ctajax-element list-input">
				<div class="el-inner cf">
					<div class="el-form cf">
						<form class="el-ctajax-form" id="el_ctajax_form" method="post" action="#">
							<div class="el-control">
								<label for="cainput_name"><?php echo JText::_('NAME_LABEL'); ?></label>
								<input type="text" autocomplete="off" name="cainput_name" class="el-input" id="cainput_name"
								       placeholder="<?php echo JText::_('NAME_LABEL_EXAMPLE'); ?>">
								<span class="ca-tooltip" title="" data-toggle="tooltip"
									  data-original-title="<?php echo JText::_('NAME_ERROR'); ?>">
									<i class="icon-exclamation-sign el-error"></i>
								</span>
								<i class="icon-ok-sign el-ok"></i>
							</div>
							<div class="el-control ">
								<label for="cainput_email"><?php echo JText::_('EMAIL_LABEL'); ?></label>
								<input autocomplete="off" type="text" name="cainput_email" class="el-input" id="cainput_email"
								       placeholder="<?php echo JText::_('EMAIL_LABEL_EXAMPLE'); ?>">
								<span class="ca-tooltip" title="" data-toggle="tooltip"
									  data-original-title="<?php echo JText::_('EMAIL_ERROR'); ?>">
									<i class="icon-exclamation-sign el-error"></i>
								</span>
								<i class="icon-ok-sign el-ok"></i>
							</div>
							<div class="el-control">
								<label for="cainput_subject"><?php echo JText::_('SUBJECT_LABEL'); ?></label>
								<input type="text" autocomplete="off" name="cainput_subject" class="el-input" id="cainput_subject"
								       placeholder="<?php echo JText::_('SUBJECT_LABEL_EXAMPLE'); ?>">
								<span class="ca-tooltip" title="" data-toggle="tooltip"
									  data-original-title="<?php echo JText::_('SUBJECT_ERROR'); ?>">
									<i class="icon-exclamation-sign el-error"></i>
								</span>
								<i class="icon-ok-sign el-ok"></i>
							</div>
							<div class="el-control control-date">
								<label for="cainput_date"><?php echo JText::_('DATE_LABEL'); ?></label>
								<input type="text" autocomplete="off" name="cainput_date" class="el-input" id="cainput_date"
									   placeholder="<?php echo JText::_('DATE_LABEL_EXAMPLE'); ?>">
								<span class="ca-tooltip" title="" data-toggle="tooltip"
									  data-original-title="<?php echo JText::_('DATE_ERROR'); ?>">
									<i class="icon-exclamation-sign el-error"></i>
								</span>
								<i class="icon-ok-sign el-ok"></i>
							</div>
							<div class="el-control control-message">
								<label for="cainput_message"><?php echo JText::_('MESSAGE_LABEL'); ?></label>
								<textarea name="cainput_message" maxlength="1000" class="el-input" id="cainput_message"
								          placeholder="<?php echo JText::_('MESSAGE_LABEL_EXAMPLE'); ?>"></textarea>
								<span class="ca-tooltip" title="" data-toggle="tooltip"
									  data-original-title="<?php echo JText::_('MESSAGE_ERROR'); ?>">
									<i class="icon-exclamation-sign el-error"></i>
								</span>
								<i class="icon-ok-sign el-ok"></i>
							</div>
							
							<?php
							if ($captcha_dis == 1) {
								if ($captcha_disable == 1 && $user->id != 0) {
								} else {
									if ($captcha_type == 1) {
										?>
										<div class="el-control captcha-form">
											<?php JFactory::getApplication()->triggerEvent('showCaptcha', array($module->id)); ?>
										</div>
										<div class="el-control ">
											<label for="cainput_captcha"><?php echo JText::_('CAPTCHA_LABEL'); ?></label>
											<input type="text" name="cainput_captcha" maxlength="6" class="el-input" id="cainput_captcha"
											       placeholder="<?php echo JText::_('CAPTCHA_LABEL'); ?>">
											<i class="icon-spinner  icon-large icon-spin el-captcha-loadding"></i>
											<span class="ca-tooltip" title="" data-toggle="tooltip"
												  data-original-title="<?php echo JText::_('CAPTCHA_ERROR'); ?>">
												<i class="icon-exclamation-sign el-error"></i>
											</span>
											<i class="icon-ok-sign el-ok"></i>
										</div>
									<?php } else { ?>
										<div class="el-control">
											<?php
											JPluginHelper::importPlugin('captcha');
											$dispatcher = JDispatcher::getInstance();
											$dispatcher->trigger('onInit', 'dynamic_recaptcha_1');
											?>
											<div id="dynamic_recaptcha_1"></div>
										<span class="ca-tooltip" title="" data-toggle="tooltip"
										      data-original-title="<?php echo JText::_('CAPTCHA_ERROR'); ?>">
											<i class="icon-exclamation-sign el-error"></i>
										</span>
											<i class="icon-ok-sign el-ok"></i>
										</div>
									<?php }
								}
							}
							?>
							<?php if ($params->get('email_copy_dis') == 1) { ?>
								<div class="el-control ">
									<input type="checkbox" value="" id="contact_email_copy" name="contact_email_copy">
									<label title="" class="el-label-email-copy"
									       for="contact_email_copy"><?php echo JText::_('SEND_MAIL_COPY'); ?></label>
								</div>
							<?php } ?>
							<div class="list-date-submit">
								<div class="el-control control-submit">
									<input type="submit" value="<?php echo JText::_('SEND_MAIL_LABEL'); ?>" class="btn-pres" id="cainput_submit">
									<span class="el-ctajax-loadding"></span>
									<span class="el-ctajax-return return-error">
										<i class="icon-exclamation-sign icon-large">&nbsp;&nbsp;<?php echo JText::_('MAIL_IS_NOT_SENT'); ?></i>
									</span>
									<span class="el-ctajax-return return-success">
										<i class="icon-ok-circle icon-large">&nbsp;&nbsp;<?php echo JText::_('MAIL_IS_SENT'); ?></i>
									</span>
								</div>
							</div>
						</form>
					</div>
					<div class="social-networks">
						<?php
						if ($params->get('twitter_dis') == 1 && $params->get('twitter_text') != '') { ?>
							<a title="<?php echo JText::_('TWITTER_LABEL'); ?>" target="blank" href="<?php echo $params->get('twitter_text'); ?>"
							   class="network"><i class="icon-twitter"></i></a>
						<?php }
						if ($params->get('facebook_dis') == 1 && $params->get('facebook_text') != '') { ?>
							<a title="<?php echo JText::_('FACEBOOK_LABEL'); ?>" target="blank" href="<?php echo $params->get('facebook_text'); ?>"
							   class="network"><i class="icon-facebook"></i></a>
						<?php }
						if ($params->get('rss_dis') == 1 && $params->get('rss_text') != '') { ?>
							<a title="<?php echo JText::_('RSS_LABEL'); ?>" target="blank" href="<?php echo $params->get('rss_text') ?>"
							   class="network"><i class="icon-rss"></i></a>
						<?php }
						if ($params->get('linkedin_dis') == 1 && $params->get('linkedin_text') != '') { ?>
							<a title="<?php echo JText::_('LINKEDIN_LABEL'); ?>" target="blank" href="<?php echo $params->get('linkedin_text'); ?>"
							   class="network"><i class="icon-linkedin"></i></a>
						<?php }
						if ($params->get('google_plus_dis') == 1 && $params->get('google_plus_text') != '') { ?>
							<a title="<?php echo JText::_('GOOGLE_PLUS_LABEL'); ?>" target="blank"
							   href="<?php echo $params->get('google_plus_text'); ?>" class="network"><i class="icon-google-plus"></i></a>
						<?php } ?>
					</div>
					<!--<span class="el-aircaft"></span>-->
				</div>
			</div>
		</div>
	</div>


<?php if (!empty($options->posttext)) { ?>
	<div class="post-text"><?php echo $options->posttext; ?></div>
<?php } ?>
<script type="text/javascript">
	jQuery(document).ready(function($){
		var today = new Date();
		(function(){Calendar.setup(
			{
				inputField  : "cainput_date",         // ID of the input field
				ifFormat    : "%d/%m/%Y",    // the date format
				button      : "cainput_date",       // ID of the button
				date        : today
			}
		)})('#<?php echo $tag_id; ?>');
	});
</script>
