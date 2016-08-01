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
	add_option('simterm-type-prepend', '>');
	add_option('simterm-command-prepend', '$#');
	add_option('simterm-default-delay', '400');
	add_option('simterm-default-theme', 'light');

	add_settings_field('simterm-default-theme',
			   __('Theme to use', 'simterm'),
			   array($this, 'config_default_theme'),
			   'simterm-settings',
			   'simterm-global-settings');
	add_settings_field('simterm-default-delay',
			   __('Default delay between lines', 'simterm'),
			   array($this, 'config_default_delay'),
			   'simterm-settings',
			   'simterm-global-settings');
	add_settings_field('simterm-command-prepend',
			   __('Command prepend character', 'simterm'),
			   array($this, 'config_command_prepend'),
			   'simterm-settings',
			   'simterm-global-settings');
	add_settings_field('simterm-type-prepend',
			   __('Type prepend character', 'simterm'),
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
      echo SimTermView::render('settings/main');
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
							  'options' => array('regular' => __('Regular', 'simterm'),
									     'dark' => __('Dark', 'simterm'),
									     'light' => __('Light', 'simterm'),
									     'blue' => __('Blue', 'simterm')),
	));
    }

    public function config_default_delay()
    {

	echo SimTermView::render('settings/text', array('fieldId'=>'simterm-default-delay', 
							'fieldText' => __('Delay in milliseconds by default', 'simterm')
	));
    }

    public function config_command_prepend()
    {
	echo SimTermView::render('settings/text', array('fieldId'=>'simterm-command-prepend', 
							'fieldText' => __('Any of these characters may prepend a command input', 'simterm')
	));
    }

    public function config_type_prepend()
    {
	echo SimTermView::render('settings/text', array('fieldId'=>'simterm-type-prepend', 
							'fieldText' => __('Any of these characters may prepend a type input', 'simterm')
	));
    }

};
