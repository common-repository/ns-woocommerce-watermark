<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php // PUT YOUR settings_fields name and your input // ?>
<?php settings_fields('woocommerce_watermark_options'); ?>
<div class="genRowNssdc">
<?php
if(class_exists( 'WooCommerce' )){
?>
<table>
					<tbody>
						<tr valign="top">
						<th scope="row"><label for="woocommerce_watermark_enabled_plugin"><?php _e('Gd Library', 'ns-woocommerce-watermark'); ?>:</label></th>
							<td>
								<?php
									$ns_gd_lib = gd_info();
									if ($ns_gd_lib["GD Version"]) {
										_e('Ok', 'ns-woocommerce-watermark');
									} else {
										_e('Contact your admin server to install gd library on your server', 'ns-woocommerce-watermark');
									}
								?>
							</td>
						</tr>
						
						<tr valign="top">
						<th scope="row"><label for="woocommerce_watermark_enabled_plugin"><?php _e('Allow url fopen', 'ns-woocommerce-watermark'); ?>:</label></th>
							<td>
								<?php
									if (ini_get("allow_url_fopen") == true) {
										_e('Ok', 'ns-woocommerce-watermark');
									} else {
										_e('Contact your admin server to turn on allow_url_fopen', 'ns-woocommerce-watermark');
									}
								?>
							</td>
						</tr>

						<tr valign="top">
						<th scope="row"><label for="woocommerce_watermark_enabled_plugin"><?php _e('Enabled Plugin', 'ns-woocommerce-watermark'); ?>:</label></th>
							<td>
								<?php
									$woocommerce_watermark_enabled_plugin0 = (get_option('woocommerce_watermark_enabled_plugin') AND get_option('woocommerce_watermark_enabled_plugin') == 0) ? ' selected="selected"' : '';
									$woocommerce_watermark_enabled_plugin1 = (get_option('woocommerce_watermark_enabled_plugin') AND get_option('woocommerce_watermark_enabled_plugin') == 1) ? ' selected="selected"' : '';
									$woocommerce_watermark_enabled_plugin2 = (get_option('woocommerce_watermark_enabled_plugin') AND get_option('woocommerce_watermark_enabled_plugin') == 2) ? ' selected="selected"' : '';
								?>
								<select name="woocommerce_watermark_enabled_plugin" id="woocommerce_watermark_enabled_plugin">
									<option value="0" <?php echo $woocommerce_watermark_enabled_plugin0; ?>><?php _e('Enable', 'ns-woocommerce-watermark'); ?></option>
									<option value="1" <?php echo $woocommerce_watermark_enabled_plugin1; ?>><?php _e('Disable', 'ns-woocommerce-watermark'); ?></option>
									<option value="2" <?php echo $woocommerce_watermark_enabled_plugin2; ?>><?php _e('Enable only for not registred user', 'ns-woocommerce-watermark'); ?></option>
								</select>
							</td>
						</tr>
						<tr valign="top">
						<th scope="row"><label for="woocommerce_watermark_img"><?php _e('Select a Watermark', 'ns-woocommerce-watermark'); ?>:</label></th>
							<td>
								<img src="<?php echo get_option('woocommerce_watermark_img'); ?>" style="max-width: 300px;" ><br>
								<input id="woocommerce_watermark_img" name="woocommerce_watermark_img" type="text" size="36" value="<?php echo get_option('woocommerce_watermark_img'); ?>" />
								<input id="woocommerce_watermark_img_button" class="button-primary" name="woocommerce_watermark_img_button" type="button" value="<?php _e( 'Upload Image', 'nst' ); ?>" /> 
								<span class="description"></span>
							</td>
						</tr>
		
					</tbody>
				</table>
<?php
}
else{
?>
	<div class="ns-rac-option-container" style='width: calc(100% - 50px);'>
		<h3>Woocommerce is not installed!</h3>
		<p>NS Watermark plugin needs <b class="ns-rac-wc-warning">Woocommerce 3.0</b> or later versions to work!</p>

	</div>
<?php
}
?>
</div>