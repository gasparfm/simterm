<?php
class SimTermSettings
{
    private static $instance;
    public static function getInstance()
    {
	if (self::$instance === null)
	    self::$instance = new SimTermSettings();

	return self::$instance;
    }

    protected function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public function register()
    {
	/* Settings registration  */
	/* register_setting('simterm-settings', // Option group
	   'simterm-global-theme',
	   array($this, 'bool_sanitize')); */
	register_setting('simterm-settings',
			 'simterm-default-theme');
	register_setting('simterm-settings',
			 'simterm-delay-time',
			 array($this, 'number_sanitize'));
	register_setting('simterm-settings',
			 'simterm-command-prepend');
	register_setting('simterm-settings',
			 'simterm-type-prepend');
	/* Config sections  */
	add_settings_section('simterm-global-settings', 
			     'SimTerm Configuration',
			     array($this, 'globalConfiguration'),
			     'simterm-settings');

	/* Config fields */
	/* Just a demo field */
	/* add_settings_field('simterm-global-theme', // setting name
	   'Theme to use',// setting description
	   array($this, 'config_global_theme'), // setting view callback
	   'simterm-settings', // option group
	   'simterm-global-settings'); // settings section */
	/* Just a demo field */
	add_option('simterm-type-prepend', '>');
	add_option('simterm-command-prepend', '$#');
	add_option('simterm-default-delay', '400');
	add_option('simterm-default-theme', 'light');

	add_settings_field('simterm-default-theme',
			   'Theme to use',
			   array($this, 'config_default_theme'),
			   'simterm-settings',
			   'simterm-global-settings');
	add_settings_field('simterm-default-delay',
			   'Delay between lines',
			   array($this, 'config_default_delay'),
			   'simterm-settings',
			   'simterm-global-settings');
	add_settings_field('simterm-command-prepend',
			   'Command prepend character',
			   array($this, 'config_command_prepend'),
			   'simterm-settings',
			   'simterm-global-settings');
	add_settings_field('simterm-type-prepend',
			   'Type prepend character',
			   array($this, 'config_type_prepend'),
			   'simterm-settings',
			   'simterm-global-settings');
    }

    public function no_sanitize($value)
    {
    }

    public function number_sanitize($value)
    {
	return (is_numeric($value))?$value:0;
    }

    public function bool_sanitize($value)
    {
	return isset( $value ) ? true : false;
    }

    public function globalConfiguration()
    {
	echo wpautop( "This are some options you can change." );
    }

    public function register_settings_menu()
    {
	//	add_menu_page('SimTerm Settings', 'SimTerm Settings', 'administrator', 'simterm-settings', array($this, 'globalSettingsPage'), plugins_url( 'simterm/img/icon.png' ));
	add_options_page('SimTerm Settings', 'SimTerm settings', 'administrator', 'simterm-settings',array($this, 'globalSettingsPage')); 
    }

    public function globalSettingsPage()
    {
	echo SimTermView::render('globalsettings');
    }

    public function config_global_theme()
    {
	echo SimTermView::render('settings/checkbox', array('fieldId'=>'simterm-global-theme', 'fieldText' => 'Extra information'));
    }

    public function config_default_theme()
    {
	/* In the future, this themes may be extensions of this plugin  */
	echo SimTermView::render('settings/select', array('fieldId'=>'simterm-default-theme', 
							  'options' => array('regular' => 'Regular',
									     'dark' => 'Dark',
									     'light' => 'Light',
									     'blue' => 'Blue'),
	));
    }

    public function config_default_delay()
    {

	echo SimTermView::render('settings/text', array('fieldId'=>'simterm-default-delay', 
							'fieldText' => 'Delay in milliseconds'
	));
    }

    public function config_command_prepend()
    {
	echo SimTermView::render('settings/text', array('fieldId'=>'simterm-command-prepend', 
							'fieldText' => 'Any of these characters may prepend a command input'
	));
    }

    public function config_type_prepend()
    {
	echo SimTermView::render('settings/text', array('fieldId'=>'simterm-type-prepend', 
							'fieldText' => 'Any of these characters may prepend a type input'
	));
    }

};
