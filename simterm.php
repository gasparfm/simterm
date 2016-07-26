<?php
/**
 * Plugin Name: SimTerm
 * Plugin URI:  http://gaspar.totaki.com/en/php-project/simterm/
 * Description: Simulates terminal input/output for tutorials
 * Version: 0.1.0
 * Author: Gaspar Fernández
 * Author URI: http://totaki.com/poesiabinaria/
 * License: GPL3
 */

require_once('mutils.php');
require_once('views.php');

class SimTermLoader
{
    protected static $st;

    function Init()
    {
	/* Incluimos nuestra clase */
	$path = plugin_dir_path(__FILE__);
	require_once($path.'simterm-core.php');
	self::$st = new SimTerm;
	/* Acciones de WordPress add_filter, add_option, register_option... */

	add_action('admin_menu', array(self::$st->settings(), 'register_settings_menu'));
	add_action('admin_init', array('SimTermLoader', 'settingsInit'));
	add_shortcode('simterm', array(self::$st, 'simterm_shortcode'));
	//	add_shortcode( 'simterm', 'baztag_func' );    
    }

    public function settingsInit()
    {
	$sett = self::$st->settings();
	$sett->register();
    }
};

SimTermLoader::Init();
// [baztag]content[/baztag]
function baztag_func( $atts, $content = '' ) {
    return "content = $content";
}
