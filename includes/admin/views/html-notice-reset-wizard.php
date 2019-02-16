<?php
/**
 * Admin View: Notice - Reset Wizard
 *
 * @package Mantrabrain_Starter_Sites
 */

defined( 'ABSPATH' ) || exit;

?>
<div id="message" class="updated mantrabrain-starter-sites-message">
	<p><?php _e( '<strong>Reset Wizard</strong> &#8211; If you need to reset the WordPress back to default again :)', 'mantrabrain-starter-sites' ); ?></p>
	<p class="submit"><a href="<?php echo esc_url( add_query_arg( 'do_reset_wordpress', 'true', admin_url( 'themes.php?page=starter-sites' ) ) ); ?>" class="button button-primary mantrabrain-reset-wordpress"><?php _e( 'Run the Reset Wizard', 'mantrabrain-starter-sites' ); ?></a> <a class="button-secondary skip" href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'mantrabrain-starter-sites-hide-notice', 'reset_notice' ), 'mantrabrain_starter_sites_hide_notice_nonce', '_mantrabrain_starter_sites_notice_nonce' ) ); ?>"><?php _e( 'Hide this notice', 'mantrabrain-starter-sites' ); ?></a></p>
</div>
