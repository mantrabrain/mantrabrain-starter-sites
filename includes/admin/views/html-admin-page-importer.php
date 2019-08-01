<?php
/**
 * Admin View: Page - Importer
 *
 * @package Mantrabrain_Starter_Sites
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="wrap demo-importer">
	<h1 class="wp-heading-inline"><?php esc_html_e( 'Starter Sites', 'mantrabrain-starter-sites' ); ?></h1>
	<?php if ( apply_filters( 'mantrabrain_starter_sites_upcoming_demos', false ) ) : ?>
		<a href="<?php echo esc_url( 'https://mantrabrain.com/upcoming-demos' ); ?>" class="page-title-action" target="_blank"><?php esc_html_e( 'Upcoming Demos', 'mantrabrain-starter-sites' ); ?></a>
	<?php endif; ?>
	<hr class="wp-header-end">
	<div class="error hide-if-js">
		<p><?php _e( 'The starter sites screen requires JavaScript.', 'mantrabrain-starter-sites' ); ?></p>
	</div>
	<h2 class="screen-reader-text hide-if-no-js"><?php _e( 'Filter demos list', 'mantrabrain-starter-sites' ); ?></h2>
	<div class="wp-filter hide-if-no-js">
		<div class="filter-section">
			<div class="filter-count">
				<span class="count theme-count demo-count"></span>
			</div>
			<?php if ( isset( $this->demo_packages['categories']) ) : ?>
				<ul class="filter-links categories">
					<?php foreach ( $this->demo_packages['categories']as $slug => $label ) : ?>
						<li><a href="#" data-sort="<?php echo esc_attr( $slug ); ?>" class="category-tab"><?php echo esc_html( $label ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<div class="filter-section right">
			<?php if ( isset( $this->demo_packages['pagebuilders']) ) : ?>
				<ul class="filter-links pagebuilders">
					<?php foreach ( $this->demo_packages['pagebuilders'] as $slug => $label ) : ?>
						<?php if ( 'default' !== $slug ) : ?>
							<li><a href="#" data-type="<?php echo esc_attr( $slug ); ?>" class="pagebuilder-tab"><?php echo esc_html( $label ); ?></a></li>
						<?php else: ?>
							<li><a href="#" data-type="<?php echo esc_attr( $slug ); ?>" class="pagebuilder-tab tips" data-tip="<?php esc_attr_e( 'Without Page Builder', 'mantrabrain-starter-sites' ); ?>"><?php echo esc_html( $label ); ?></a></li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<form class="search-form"></form>
		</div>
	</div>
	<h2 class="screen-reader-text hide-if-no-js"><?php _e( 'Themes list', 'mantrabrain-starter-sites' ); ?></h2>
	<div class="theme-browser content-filterable"></div>
	<div class="theme-install-overlay wp-full-overlay expanded"></div>

	<p class="no-themes"><?php _e( 'No demos found. Try a different search.', 'mantrabrain-starter-sites' ); ?></p>
	<span class="spinner"></span>
</div>

<script id="tmpl-demo" type="text/template">
	<# if ( data.screenshot_url ) { #>
		<div class="theme-screenshot">
			<img src="{{ data.screenshot_url }}" alt="" />
		</div>
	<# } else { #>
		<div class="theme-screenshot blank"></div>
	<# } #>

	<# if ( data.isPro ) { #>
		<span class="premium-demo-banner"><?php _e( 'Premium', 'mantrabrain-starter-sites' ); ?></span>
	<# } #>

	<span class="more-details"><?php _ex( 'Details &amp; Preview', 'demo', 'mantrabrain-starter-sites' ); ?></span>
	<div class="theme-author">
		<?php
		/* translators: %s: Demo author name */
		printf( __( 'By %s', 'mantrabrain-starter-sites' ), '{{{ data.author }}}' );
		?>
	</div>

	<div class="theme-id-container">
		<# if ( data.active ) { #>
			<h2 class="theme-name" id="{{ data.id }}-name">
				<?php
				/* translators: %s: Demo name */
				printf( __( '<span>Imported:</span> %s', 'mantrabrain-starter-sites' ), '{{{ data.name }}}' );
				?>
			</h2>
		<# } else { #>
			<h2 class="theme-name" id="{{ data.id }}-name">{{{ data.name }}}</h2>
		<# } #>

		<div class="theme-actions">
			<# if ( data.active ) { #>
				<a class="button button-primary live-preview" target="_blank" href="<?php echo home_url( '/' ); ?>"><?php _e( 'Live Preview', 'mantrabrain-starter-sites' ); ?></a>
			<# } else { #>
				<# if ( data.isPro ) { #>
					<a class="button button-primary purchase-now" href="{{ data.homepage }}" target="_blank"><?php _e( 'Buy Now', 'mantrabrain-starter-sites' ); ?></a>
				<# } else if ( data.requiredTheme || data.requiredPlugins ) { #>
					<button class="button button-primary preview install-demo-preview"><?php _e( 'Import', 'mantrabrain-starter-sites' ); ?></button>
				<# } else { #>
					<?php
					/* translators: %s: Demo name */
					$aria_label = sprintf( _x( 'Import %s', 'demo', 'mantrabrain-starter-sites' ), '{{ data.name }}' );
					?>
					<a class="button button-primary hide-if-no-js demo-import" href="#" data-name="{{ data.name }}" data-slug="{{ data.id }}" aria-label="<?php echo $aria_label; ?>"><?php _e( 'Import', 'mantrabrain-starter-sites' ); ?></a>
				<# } #>
				<button class="button preview install-demo-preview"><?php _e( 'Preview', 'mantrabrain-starter-sites' ); ?></button>
			<# } #>
		</div>
	</div>

	<# if ( data.imported ) { #>
		<div class="notice notice-success notice-alt"><p><?php _ex( 'Imported', 'demo', 'mantrabrain-starter-sites' ); ?></p></div>
	<# } #>
</script>

<script id="tmpl-demo-preview" type="text/template">
	<div class="wp-full-overlay-sidebar">
		<div class="wp-full-overlay-header">
			<button class="close-full-overlay"><span class="screen-reader-text"><?php _e( 'Close', 'mantrabrain-starter-sites' ); ?></span></button>
			<button class="previous-theme"><span class="screen-reader-text"><?php _ex( 'Previous', 'Button label for a demo', 'mantrabrain-starter-sites' ); ?></span></button>
			<button class="next-theme"><span class="screen-reader-text"><?php _ex( 'Next', 'Button label for a demo', 'mantrabrain-starter-sites' ); ?></span></button>
			<# if ( data.isPro ) { #>
				<a class="button button-primary purchase-now" href="{{ data.homepage }}" target="_blank"><?php _e( 'Buy Now', 'mantrabrain-starter-sites' ); ?></a>
			<# } else if ( data.requiredTheme ) { #>
				<button class="button button-primary hide-if-no-js disabled"><?php _e( 'Import Demo', 'mantrabrain-starter-sites' ); ?></button>
			<# } else if ( data.requiredPlugins ) { #>
				<button class="button button-secondary hide-if-no-js plugins-install"><?php _e( 'Install Plugins', 'mantrabrain-starter-sites' ); ?></button>
			<# } else { #>
				<# if ( data.active ) { #>
					<a class="button button-primary live-preview" target="_blank" href="<?php echo home_url( '/' ); ?>"><?php _e( 'Live Preview', 'mantrabrain-starter-sites' ); ?></a>
				<# } else { #>
					<a class="button button-primary hide-if-no-js demo-import" href="#" data-name="{{ data.name }}" data-slug="{{ data.id }}"><?php _e( 'Import Demo', 'mantrabrain-starter-sites' ); ?></a>
				<# } #>
			<# } #>
		</div>
		<div class="wp-full-overlay-sidebar-content">
			<div class="install-theme-info">
				<h3 class="theme-name">
					{{ data.name }}
					<# if ( data.isPro ) { #>
						<span class="premium-demo-tag"><?php _e( 'Pro', 'mantrabrain-starter-sites' ); ?></span>
					<# } #>
				</h3>

				<span class="theme-by">
					<?php
					/* translators: %s: Demo author name */
					printf( __( 'By %s', 'mantrabrain-starter-sites' ), '{{ data.author }}' );
					?>
				</span>

				<img class="theme-screenshot" src="{{ data.screenshot_url }}" alt="" />

				<div class="theme-details">
					<# if ( ! data.isPro ) { #>
						<# if ( data.requiredTheme ) { #>
							<div class="demo-message notice notice-error notice-alt"><p><?php printf( esc_html__( '%s theme is not active.', 'mantrabrain-starter-sites' ), '<strong>{{{ data.theme }}}</strong>' ); ?></p></div>
						<# } else if ( data.requiredPlugins ) { #>
							<div class="demo-message notice notice-info notice-alt"><p><?php esc_html_e( 'Required Plugins must be activated.', 'mantrabrain-starter-sites' ); ?></p></div>
						<# } #>
					<# } #>
					<div class="theme-version">
						<?php
						/* translators: %s: Demo version */
						printf( __( 'Version: %s', 'mantrabrain-starter-sites' ), '{{ data.version }}', 'mantrabrain-starter-sites' );
						?>
					</div>
					<div class="theme-description">{{{ data.description }}}</div>
				</div>

				<div class="plugins-details">
					<h4 class="plugins-info"><?php _e( 'Plugins Information', 'mantrabrain-starter-sites' ); ?></h4>

					<table class="plugins-list-table widefat striped">
						<thead>
							<tr>
								<th scope="col" class="manage-column required-plugins" colspan="2"><?php esc_html_e( 'Required Plugins', 'mantrabrain-starter-sites' ); ?></th>
							</tr>
						</thead>
						<tbody id="the-list">
							<# if ( ! _.isEmpty( data.plugins ) ) { #>
								<# _.each( data.plugins, function( plugin, slug ) { #>
									<tr class="plugin<# if ( ! plugin.is_active ) { #> inactive<# } #>" data-slug="{{ slug }}" data-plugin="{{ plugin.slug }}" data-name="{{ plugin.name }}">
										<td class="plugin-name">
											<a href="<?php printf( esc_url( 'https://wordpress.org/plugins/%s' ), '{{ slug }}' ); ?>" target="_blank">{{ plugin.name }}</a>
										</td>
										<td class="plugin-status">
											<# if ( plugin.is_active && plugin.is_install ) { #>
												<span class="active"></span>
											<# } else if ( plugin.is_install ) { #>
												<span class="activate-now<# if ( ! data.requiredPlugins ) { #> active<# } #>"></span>
											<# } else { #>
												<span class="install-now<# if ( ! data.requiredPlugins ) { #> active<# } #>"></span>
											<# } #>
										</td>
									</tr>
								<# }); #>
							<# } else { #>
								<tr class="no-items">
									<td class="colspanchange" colspan="4"><?php esc_html_e( 'No plugins are required for this demo.', 'mantrabrain-starter-sites' ); ?></td>
								</tr>
							<# } #>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="wp-full-overlay-footer">
			<div class="demo-import-actions">
				<# if ( data.isPro ) { #>
					<a class="button button-hero button-primary purchase-now" href="{{ data.homepage }}" target="_blank"><?php _e( 'Buy Now', 'mantrabrain-starter-sites' ); ?></a>
				<# } else if ( data.requiredTheme ) { #>
					<button class="button button-hero button-primary hide-if-no-js disabled"><?php _e( 'Import Demo', 'mantrabrain-starter-sites' ); ?></button>
				<# } else if ( data.requiredPlugins ) { #>
					<button class="button button-hero button-secondary hide-if-no-js plugins-install"><?php _e( 'Install Plugins', 'mantrabrain-starter-sites' ); ?></button>
				<# } else { #>
					<# if ( data.active ) { #>
						<a class="button button-primary live-preview button-hero hide-if-no-js" target="_blank" href="<?php echo home_url( '/' ); ?>"><?php _e( 'Live Preview', 'mantrabrain-starter-sites' ); ?></a>
					<# } else { #>
						<a class="button button-hero button-primary hide-if-no-js demo-import" href="#" data-name="{{ data.name }}" data-slug="{{ data.id }}"><?php _e( 'Import Demo', 'mantrabrain-starter-sites' ); ?></a>
					<# } #>
				<# } #>
			</div>
			<button type="button" class="collapse-sidebar button" aria-expanded="true" aria-label="<?php esc_attr_e( 'Collapse Sidebar', 'mantrabrain-starter-sites' ); ?>">
				<span class="collapse-sidebar-arrow"></span>
				<span class="collapse-sidebar-label"><?php _e( 'Collapse', 'mantrabrain-starter-sites' ); ?></span>
			</button>
			<div class="devices-wrapper">
				<div class="devices">
					<button type="button" class="preview-desktop active" aria-pressed="true" data-device="desktop">
						<span class="screen-reader-text"><?php esc_html_e( 'Enter desktop preview mode', 'mantrabrain-starter-sites' ); ?></span>
					</button>
					<button type="button" class="preview-tablet" aria-pressed="false" data-device="tablet">
						<span class="screen-reader-text"><?php esc_html_e( 'Enter tablet preview mode', 'mantrabrain-starter-sites' ); ?></span>
					</button>
					<button type="button" class="preview-mobile" aria-pressed="false" data-device="mobile">
						<span class="screen-reader-text"><?php esc_html_e( 'Enter mobile preview mode', 'mantrabrain-starter-sites' ); ?></span>
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="wp-full-overlay-main">
		<iframe src="{{ data.preview_url }}" title="<?php esc_attr_e( 'Preview', 'mantrabrain-starter-sites' ); ?>"></iframe>
	</div>
</script>

<?php
wp_print_request_filesystem_credentials_modal();
wp_print_admin_notice_templates();
mantrabrain_print_admin_notice_templates();
