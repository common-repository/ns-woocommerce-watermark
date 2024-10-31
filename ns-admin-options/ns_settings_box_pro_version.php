<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="nsbigbox<?php echo esc_attr($ns_style); ?>">
	<div class="titlensbigbox<?php echo esc_attr($ns_style); ?>">
		<h4><?php echo strtoupper($ns_full_name); ?> PREMIUM VERSION</h4>
	</div>
	<div class="contentnsbigbox">
		<p>	ALL FREE VERSION FEATURES and:<br/><br/> <?php echo wp_kses_post($ns_premium_feature_list); ?></p>
		<a href="<?php echo esc_url($link_sidebar); ?>" class="linkBigBoxNS" target="_blank">
			<div class="buttonNsbigbox<?php echo esc_attr($ns_style); ?>">
				UPGRADE!
			</div>
		</a>
	</div>
</div>