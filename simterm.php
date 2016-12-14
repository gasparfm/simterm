<?php
/**
 * Plugin Name: SimTerm
 * Plugin URI:  http://gaspar.totaki.com/en/php-project/simterm/
 * Description: Simulates terminal input/output for tutorials
 * Version: 0.3.0
 * Author: Gaspar Fernández
 * Author URI: http://totaki.com/poesiabinaria/
 * License: GPL3
 * Text Domain: simterm
 * Domain Path: /languages/
 */

require_once('mutils.php');
require_once('views.php');

class SimTermLoader
{
	protected static $st;

	function Init()
	{
		/* Include main class */
		$path = plugin_dir_path(__FILE__);
		require_once($path.'simterm-core.php');
		self::$st = new SimTerm;

		/* Localization stuff */
		/* Make po files autoupdate */
		__('Simulates terminal input/output for tutorials', 'simterm');
		add_action( 'init', array('SimTermLoader', 'basic_init'));
		add_action( 'admin_init', array('SimTermLoader', 'load_textdomain' ));

		add_action('admin_menu', array(self::$st->settings(), 'register_settings_menu'));
		add_action('admin_init', array('SimTermLoader', 'settingsInit'));
		add_shortcode('simterm', array(self::$st, 'simterm_shortcode'));
	}

	public function basic_init()
	{
		/* Nothing right here yet */
	}

	public function settingsInit()
	{
		$sett = self::$st->settings();
		$sett->register();
	}

	public function load_textdomain()
	{
		load_plugin_textdomain( 'simterm', FALSE, dirname( plugin_basename( __FILE__ ) ).'/languages/' );
	}

};

SimTermLoader::Init();
