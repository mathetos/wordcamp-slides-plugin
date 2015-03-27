<?php
/**
 * Plugin Name: WordCamp Presentation Functionality
 * Plugin URI: http://slides.mattcromwell.com/site-functionality
 * Description: Customizes the CPTs for slides, and cleans up the backend to focus ONLY on creating a basic site with Presentations.
 * Version: 1.0
 * Author: Matt Cromwell
 * Author URI: http://www.mattcromwell.com
 * License:      		GNU General Public License v2 or later
 * License URI:  	http://www.gnu.org/licenses/gpl-2.0.html
 *
 */

// Plugin Directory 
define( 'WCSD_DIR', dirname( __FILE__ ) );
define('MCSLIDES_URL', plugin_dir_url( __FILE__ ));

//General Functions
require_once( WCSD_DIR . '/lib/functions/general.php' );
 
//Post Types
require_once( WCSD_DIR . '/lib/functions/post-types.php' );

//Post Types
require_once( WCSD_DIR . '/lib/functions/superslides.php' );
require_once( WCSD_DIR . '/lib/functions/cmb2-post-search-field.php' );

if ( file_exists( WCSD_DIR . '/lib/metabox/init.php' ) ) {
	require_once WCSD_DIR . '/lib/metabox/init.php';
	require_once( WCSD_DIR . '/lib/functions/metaboxes.php' );
} elseif ( file_exists( WCSD_DIR . '/lib/metabox/init.php' ) ) {
	require_once WCSD_DIR . '/lib/metabox/init.php';
	require_once( WCSD_DIR . '/lib/functions/metaboxes.php' );
}