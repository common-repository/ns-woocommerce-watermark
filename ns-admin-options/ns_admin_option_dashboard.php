<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require_once( plugin_dir_path( __FILE__ ) .'inc.php');

$link_sidebar = $ns_url_plugin_premium.'?ref-ns=2&campaign=WAT-sidebar&utm_source='.$ns_menu_label.'%20Sidebar&utm_medium=Sidebar%20dentro%20settings&utm_campaign='.$ns_menu_label.'%20Sidebar%20premium';
$link_bannerino = $ns_url_plugin_premium.'?ref-ns=2&campaign=WAT-bannerino&utm_source='.$ns_menu_label.'%20Bannerino&utm_medium=Bannerino%20dentro%20settings&utm_campaign='.$ns_menu_label.'%20Bannerino%20premium'; 
$link_bannerone = $ns_url_plugin_premium.'?ref-ns=2&campaign=WAT-bannerone&utm_source='.$ns_menu_label.'%20Bannerone&utm_medium=Bannerone%20dashboard&utm_campaign='.$ns_menu_label.'%20Bannerone%20premium'; 
$link_promo_theme = $ns_url_theme_promo.'?ref-ns=2&campaign=WAT-MisterCorporate&utm_source='.$ns_theme_promo_slug.'%20'.$ns_menu_label.'%20Sidebar&utm_medium=Sidebar%20'.$ns_theme_promo_slug.'%20dentro%20settings&utm_campaign='.$ns_theme_promo_slug.'%20'.$ns_menu_label.'%20Sidebar%20premium';
?>

	    <div class="verynsbigbox">
	    	<?php 
	    		/* *** BOX THEME PROMO *** */
				require_once( plugin_dir_path( __FILE__ ) .'ns_settings_box_theme_promo.php');

	    		/* *** BOX PREMIUM VERSION *** */
				require_once( plugin_dir_path( __FILE__ ) .'ns_settings_box_pro_version.php');

			?>			
		</div>

<div class="verynsbigboxcontainer">
	<div class="postbox nsproversionfbpx4wp">
        <h3 class="titprofbpx4wp"><?php echo esc_attr($ns_full_name); ?></h3>
	        <div class="colprofbpx4wp">
	        <h2 class="titlefbpx4wp">How to use</h2><br><br>
			<iframe width="100%" height="250px" src="https://www.youtube.com/embed/ezHKXvcbP1A" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	        </div>
	        <div class="colprofbpx4wp2">
	        	<div class="ns-container-title-arrow">
		        	<h2 class="titlefbpx4wp ns-hidepremiumfeature">Premium features</h2>
		        	<div class="ns-arrows-float-right">
		        		<div class="arrows"></div>
		        	</div>
	        	</div>
	        	<br><br>

	        	<h2 class="titlefbpx4wp2">Go Premium, get more features and support:</h2><br><br>
				If you upgrade your plugin you will get one year of free updates and support
				through our website available 24h/24h. Upgrade and you'll have the advantage
				of additional features of the premium version.<br><br>
				<a id="fbp4wplinkpremiumboxpremium" class="button-primary" href="<?php echo esc_url($link_bannerone); ?>" target="_blank">Go Premium Now</a>
	        </div>
    </div>	
			<a name="rac-table-anchor"></a>
			<div class="icon32" id="icon-options-general"><br /></div>
			<h2 class="ns-rac-main-title"><?php echo esc_attr($ns_full_name); ?> </h2>
			<form method="post" action="options.php" enctype="multipart/form-data">
	    		<?php /* *** BOX THEME PROMO *** */ ?>
				<?php require_once( plugin_dir_path( __FILE__ ).'ns_settings_custom.php');?>	
				<?php
				if(class_exists( 'WooCommerce' )){
				?>			
					<p><input type="submit" class="button-primary ns-rac-submit-button" id="submit" name="submit" value="<?php _e('Save Changes') ?>" /></p>			
				<?php
				}
				?>
			</form>
</div>





