=== Plugin Name ===
Contributors: gasparfm
Donate link: 
Tags: terminal, linux, bash, command, line, demo, typing, osx, cli, text, type, input, output
Requires at least: 4.3
Tested up to: 4.5
Stable tag: 0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Make demos of your terminal commands and output in an attractive way.

== Description ==

Show the world how you use the command line with this plugin. Designed for tech blogs, tutorials and sections
where terminal commands matter.

This plugin, make a shortcode: [simterm][/simterm] and shows the text inside as in a terminal session, including
some typing animation and separating user input and program output.
By defaults commands have a $ symbol as the first character of the line and user input has the > (greater than)
symbol.

You can also specify the color of the line using ##red## , ##blue## , ##green## or ##yellow## or even a custom
delay for this line with ##delay=[ms]## with the amount of milliseconds to sleep.

To create the effect it uses "Show Your Terms" by Kande Bofim, a tiny and library agnostic Javascript.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Settings->SimTerm Settings screen to configure the plugin
4. In your post enter [simterm][/simterm] shortcode to start a terminal session

== Screenshots ==

1. Some useless commands typing on screen
2. Commands and user input with colors

== Frequently Asked Questions ==

= I will update it when questions come =

== Changelog ==

= 0.2 (2016-08-03) =
* More config options: window title, typing speed, several new delays and character fixing for HTML output and WordPress.
* Title is an attribute of shortcode too.
* Fixed commands with extra attributes ##xxx## weren't properly recognised.
* New ##speed## option for lines to specify typing speed.
* Version tagged 0.2

= 0.1.1 (2016-08-01) =
* Added translations

= 0.1  (2016-07-25) =
* Initial version
