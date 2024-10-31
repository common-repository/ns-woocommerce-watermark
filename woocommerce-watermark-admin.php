<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function wfw_woocommerce_watermark_options_group() {
	register_setting('woocommerce_watermark_options', 'woocommerce_watermark_enabled_plugin');
    register_setting('woocommerce_watermark_options', 'woocommerce_watermark_img');
}
 
add_action ('admin_init', 'wfw_woocommerce_watermark_options_group');

function ns_update_options_form() {
	$plugin_active = get_option('woocommerce_watermark_enabled_plugin');
	$immagine = get_option('woocommerce_watermark_img');
	$link_promo_theme = 'https://www.nsthemes.com/join-the-club/';
    ?>
       
	    <div class="verynsbigbox">
			<div class="nsbigboxtheme">
				<div class="titlensbigbox">
					<h4><?php _e('JOIN NS CLUB', 'ns-woocommerce-watermark'); ?></h4>
				</div>
				<div class="contentnsbigbox">
					<a href="<?php echo $link_promo_theme; ?>"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/ns_banner_membership-500.png" class="imgnsbigbox"></a>
					<p> <?php _e('– Instant access to all plugins and all themes', 'ns-woocommerce-watermark'); ?><br/>
						<?php _e('– All future plugins and themes are included', 'ns-woocommerce-watermark'); ?><br/>
						<?php _e('– Unlimited license for all NS products', 'ns-woocommerce-watermark'); ?><br/>
						<?php _e('– Unlimited download for each products', 'ns-woocommerce-watermark'); ?><br/>
						<?php _e('– Super fast support', 'ns-woocommerce-watermark'); ?><br/>
						<?php _e('– Regular update', 'ns-woocommerce-watermark'); ?><br/>
					<a href="<?php echo $link_promo_theme; ?>" class="linkBigBoxNS" target="_blank">
						<div class="buttonNsbigbox">
							<?php _e('DISCOVER MORE', 'ns-woocommerce-watermark'); ?>
						</div>
					</a>
				</div>
			</div>
			<div class="nsbigbox">
				<div class="titlensbigbox">
					<h4><?php _e('WATERMARK PREMIUM VERSION', 'ns-woocommerce-watermark') ?></h4>
				</div>
				<div class="contentnsbigbox">
					<p><?php _e('ALL FREE VERSION FEATURES and:', 'ns-woocommerce-watermark') ?><br/><br/>
						- <?php _e('Choose the watermark position', 'ns-woocommerce-watermark') ?><br/>
						- <?php _e('Add a margin to your watermark', 'ns-woocommerce-watermark') ?><br/>
						- <?php _e('Repeat a watermark', 'ns-woocommerce-watermark') ?><br/>
						- <?php _e('Add background layer to watermark', 'ns-woocommerce-watermark') ?><br/>
						- <?php _e('Choose background watermark color', 'ns-woocommerce-watermark') ?><br/>
						- <?php _e('Choose background watermark opacity', 'ns-woocommerce-watermark') ?><br/>
						- <?php _e('Add a colored layer in all photo', 'ns-woocommerce-watermark') ?><br/>
						- <?php _e('Choose background layer color', 'ns-woocommerce-watermark') ?><br/>
						- <?php _e('Choose background layer opacity', 'ns-woocommerce-watermark') ?><br/>
						- <?php _e('You can add a different watermark image for only thumbnail images (NEW FEATURES!)', 'ns-woocommerce-watermark') ?></p>
					<a href="http://www.nsthemes.com/product/woocommerce-watermark/?ref-ns=3&campaign=sidebar" class="linkBigBoxNS">
						<div class="buttonNsbigbox">
							<?php _e('UPGRADE!', 'ns-woocommerce-watermark') ?>
						</div>
					</a>
				</div>
			</div>

		</div>
	   
	   
		<div class="verynsbigboxcontainer">
			<div class="icon32" id="icon-options-general"><br /></div>
			<h2><?php _e('NS WooCommerce Watermark settings', 'ns-woocommerce-watermark') ?></h2>
			<p>&nbsp;</p>
			<form method="post" action="options.php" enctype="multipart/form-data">
				
			</form>
		</div>
  
    <?php
}
require_once( plugin_dir_path( __FILE__ ).'ns-admin-options/ns-admin-options-setup.php');

?>