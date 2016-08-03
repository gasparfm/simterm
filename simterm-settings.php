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
			 'simterm-default-delay',
			 array($this, 'number_sanitize'));
	register_setting('simterm-settings',
			 'simterm-command-prepend');
	register_setting('simterm-settings',
			 'simterm-type-prepend');
	/* New in 0.2 */
	register_setting('simterm-settings',
			 'simterm-transform-chars',
			 array($this, 'bool_sanitize'));
	register_setting('simterm-settings',
			 'simterm-output-delay-time',
			 array($this, 'number_sanitize'));
	register_setting('simterm-settings',
			 'simterm-last-delay-time',
			 array($this, 'number_sanitize'));
	register_setting('simterm-settings',
			 'simterm-typing-speed',
			 array($this, 'number_sanitize'));
	register_setting('simterm-settings',
			 'simterm-window-title');

	/* --------------------------------------------- */
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
	/* New in 0.2 */
	add_option('simterm-transform-chars', true);
	add_option('simterm-output-delay-time', 10);
	add_option('simterm-last-delay-time', 10000);
	add_option('simterm-typing-speed', 100);
	add_option('simterm-window-title', __('Terminal', 'simterm'));

	/* -------------------------------------------- */

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
	/* New in 0.2 */
	add_settings_field('simterm-output-delay-time',
			   __('Default delay between lines', 'simterm'),
			   array($this, 'config_output_delay'),
			   'simterm-settings',
			   'simterm-global-settings');
	add_settings_field('simterm-last-delay-time',
			   __('Default delay for last line', 'simterm'),
			   array($this, 'config_last_delay'),
			   'simterm-settings',
			   'simterm-global-settings');
	add_settings_field('simterm-typing-speed',
			   __('Default typing speed for commands and user input', 'simterm'),
			   array($this, 'config_typing_speed'),
			   'simterm-settings',
			   'simterm-global-settings');
	/* New in 0.2 */

	/* 0.1 options */
	add_settings_field('simterm-command-prepend',
			   __('Command prepend character', 'simterm'),
			   array($this, 'config_command_prepend'),
			   'simterm-settings',
			   'simterm-global-settings');
	add_settings_field('simterm-typing-prepend',
			   __('Type prepend character', 'simterm'),
			   array($this, 'config_type_prepend'),
			   'simterm-settings',
			   'simterm-global-settings');
	/* New in 0.2 */
	add_settings_field('simterm-transform-chars',
			   __('Transform characters', 'simterm'),
			   array($this, 'config_transform_characters'),
			   'simterm-settings',
			   'simterm-global-settings');
	add_settings_field('simterm-window-title',
			   __('Terminal Window Title', 'simterm'),
			   array($this, 'config_window_title'),
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

    public function config_transform_characters()
    {
	echo SimTermView::render('settings/checkbox', array('fieldId'=>'simterm-transform-chars', 'fieldText' => __('Fix special characters that look weird in a terminal window', 'simterm')));
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

    public function config_output_delay()
    {

	echo SimTermView::render('settings/text', array('fieldId'=>'simterm-output-delay-time', 
							'fieldText' => __('Delay in milliseconds for multi-line outputs', 'simterm')
	));
    }

    public function config_last_delay()
    {

	echo SimTermView::render('settings/text', array('fieldId'=>'simterm-last-delay-time', 
							'fieldText' => __('Delay in milliseconds for the last line. It can be something like 10000 (10 seconds) to wait before replaying animation', 'simterm')
	));
    }

    public function config_typing_speed()
    {

	echo SimTermView::render('settings/text', array('fieldId'=>'simterm-typing-speed', 
							'fieldText' => __('Delay in milliseconds for any letter typed in commands and user input (defaults 100ms)', 'simterm')
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

    public function config_window_title()
    {
	echo SimTermView::render('settings/text', array('fieldId'=>'simterm-window-title', 
							'fieldText' => __('Default window title', 'simterm')
	));
    }

};
