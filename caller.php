<?php
/**
 * Created by PhpStorm.
 * User: nelson_castillo
 * Date: 8/24/15
 * Time: 11:34 AM
 */
/*
Plugin Name: Twilio Manager
Plugin URI: http://www.paulbunyan.net
Description:  Loader for Twilio manager app
Author: Nelson Castillo
Version: 0.02
Author URI: http://www.castillonelson.com
*/

require_once __DIR__ . '/../../../../vendor/autoload.php';
global $db_functions;

function gzLoaderAddCss()
{
    echo '<link rel="stylesheet" media="all" href="' . plugin_dir_url(__FILE__) . 'css/twl-manager.css" type="text/css" />';
}

add_action('admin_head', 'gzLoaderAddCss');

function gzLoader()
{
    $title = __(get_plugin_data(__FILE__)['Name']);
    $url = 'http://'.$_SERVER['HTTP_HOST']."/wp-content/plugins/twilio-manager/";
    require_once 'app/blade.php';
    require_once 'app/twilio.php';

    $views = __DIR__ . '/app/views';
    $cache = __DIR__ . '/app/cache';

    $blade = new \Nelson\BLADE\Blade($views, $cache);
    echo $blade->view()->make('hello')->render();

//    echo
//        '<div class="wrap twl-wrap">
//            <h1>' . esc_html($title) . '</h1>
//            <div class="twl-iframe-wrap">
//                <iframe src="'. $url . 'app/index.php" id="theIframe" class="twl-iframe"></iframe>
//            </div>
//        </div>
//        ';

    return null;
}

function twlPluginMenu()
{
    $icon = '';
    if (file_exists(__DIR__ . '/logo/twilio_logo.svg')) {
        $icon = 'data:image/svg+xml;base64,' . base64_encode(
                file_get_contents(
                    __DIR__ . '/logo/twilio_logo.svg'
                )
            );

    }

    add_menu_page(
        'Twilio Manager',
        'Twilio Manager',
        'manage_options',
        'twl-loader',
        'gzLoader',
        $icon
    );

}

add_action('admin_menu', 'twlPluginMenu');


global $twilio_pbc_twilio_pbc_db_version;
$twilio_pbc_twilio_pbc_db_version = '1.0';

function jal_install() {
    global $wpdb;
    global $twilio_pbc_twilio_pbc_db_version;
    $table_name = $wpdb->prefix . 'twilio_pbc';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
		id mediumint(15) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		name tinytext NOT NULL,
		text text NOT NULL,
		number varchar(55) DEFAULT '' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    add_option( 'twilio_pbc_db_version', $twilio_pbc_twilio_pbc_db_version );

    $cmd = "sh init.sh";
    exec($cmd . " > /dev/null &");


}
function jal_uninstall() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'twilio_pbc';

    $sql = "DROP TABLE $table_name;";

    $wpdb->query($sql);
    delete_option("my_plugin_db_version");

//    $cmd = "composer remove twilio/sdk --update-with-dependencies";
//    exec($cmd . " > /dev/null &");

}
function myplugin_update_db_check() {
    global $twilio_pbc_db_version;
    if ( get_site_option( 'twilio_pbc_db_version' ) != $twilio_pbc_db_version ) {
        jal_install();
    }
}
add_action( 'plugins_loaded', 'myplugin_update_db_check' );

register_activation_hook( __FILE__, 'jal_install' );
register_deactivation_hook( __FILE__, 'jal_uninstall' );