<?php
/**
 * Simply adds a link in the toolbar to edit the Genesis custom post archive setting
 * Includes support for Github Updater plugin (https://github.com/afragen/github-updater)
 *
 * @package   CPTArchiveSettingsToolbarGenesis
 * @author    Mike Hemberger <mike@thestizmedia.com>
 * @license   GPL-2.0+
 * @link      http://thestizmedia.com.com
 * @copyright 2016 The Stiz Media, LLC
 *
 * @wordpress-plugin
 * Plugin Name:       CPT Archive Settings Toolbar
 * Plugin URI:        https://github.com/JiveDig/cptast-genesis/
 * Description:       This plugin works within the Genesis Framework, to add a toolbar link to edit the custom post archive settings
 * Version:           1.0.0
 * Author:            Mike Hemberger
 * Author URI:        http://thestizmedia.com
 * Text Domain:       cptast-genesis
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

if ( ! defined( 'CPTARCHIVESETTINGSTOOLBARGENESIS_BASENAME' ) ) {
	define( 'CPTARCHIVESETTINGSTOOLBARGENESIS_BASENAME', plugin_basename( __FILE__ ) );
}

function cpt_archive_settings_toolbar_genesis_require() {
	$files = array(
		'class-cpt-archive-toolbar',
	);
	foreach ( $files as $file ) {
		require plugin_dir_path( __FILE__ ) . 'includes/' . $file . '.php';
	}
}
cpt_archive_settings_toolbar_genesis_require();

$cpt_archive_settings_toolbar = new CPTArchive_Settings_Toolbar_Genesis();

$cpt_archive_settings_toolbar->run();
