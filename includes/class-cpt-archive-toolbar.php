<?php
/**
 * CPT Archive Toolbar for Genesis
 *
 * @package   CPTArchiveSettingsToolbarGenesis
 * @author    Mike Hemberger <mike@thestizmedia.com.com>
 * @link      https://github.com/JiveDig/cptast-genesis/
 * @copyright 2016 Mike Hemberger
 * @license   GPL-2.0+
 */

/**
 * Main plugin class.
 *
 * @package CPTArchiveSettingsToolbarGenesis
 */
class CPTArchive_Settings_Toolbar_Genesis {

	public function run() {
		if ( 'genesis' !== basename( get_template_directory() ) ) {
			add_action( 'admin_init', array( $this, 'deactivate' ) );
			return;
		}
		add_action( 'admin_bar_menu', array( $this, 'archive_settings_link'), 999 );
		add_action( 'wp_head', array( $this, 'custom_css' ) );
	}

	/**
	 * Deactivates the plugin if Genesis isn't running
	 *
	 * @since 1.0.0
	 */
	public function deactivate() {
		deactivate_plugins( CPTARCHIVESETTINGSTOOLBARGENESIS_BASENAME );
		add_action( 'admin_notices', array( $this, 'error_message' ) );
	}

	/**
	 * Error message if we're not using the Genesis Framework.
	 *
	 * @since 1.0.0
	 */
	public function error_message() {

		$error = sprintf( __( 'Sorry, CPT Archive Settings Toolbar for Genesis works only with the Genesis Framework. It has been deactivated.', 'cptast-genesis' ) );

		echo '<div class="error"><p>' . esc_attr( $error ) . '</p></div>';

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

	}

	/**
	 * Set up text domain for translations
	 *
	 * @since TODO
	 */
	public function load_textdomain() {
		// load_plugin_textdomain( 'cptast-genesis', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Add node to admin bar
	 *
	 * @since  1.0.0
	 *
	 * @uses   genesis_has_post_type_archive_support()
	 * @return void
	 */
	public function archive_settings_link( $wp_admin_bar ) {

		// Bail if in admin, not a CPT archive, or post_type doesn't have support for genesis-cpt-archive-settings
		if ( is_admin() || ! is_post_type_archive() || ! genesis_has_post_type_archive_support() ) {
			return $wp_admin_bar;
		}
		// Get the post type we're viewing
		$post_type = get_post_type();

		// Bail if we didn't get a valid post type
		if ( ! $post_type ) {
			return $wp_admin_bar;
		}
		// Add our toolbar link
		$args = array(
			'id'    => 'cpt-archive-settings',
			'title' => __('Edit Archive Settings', 'genesis-cptast'),
			'href'  => admin_url("edit.php?post_type={$post_type}&page=genesis-cpt-archive-{$post_type}"),
			'meta'  => array( 'class' => '' ),
		);
		$wp_admin_bar->add_node( $args );
	}

	/**
	 * Add custom CSS to <head>
	 * Adds the pencil icon to the new menu link
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function custom_css() {

		// Bail if user is not logged in or admin bar is not showing
		if ( ! is_user_logged_in() || ! is_admin_bar_showing() ) {
			return;
		}
		echo '<style type="text/css">
		    #wpadminbar #wp-admin-bar-cpt-archive-settings > .ab-item:before {
			    content: "\f464";
			    top: 2px;
		    }
		    </style>';
	}

}
