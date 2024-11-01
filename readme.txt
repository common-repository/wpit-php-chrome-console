=== WPIT PHP Chrome Console ===
Contributors: SteveAgl
Tags: WordPress, plugin, PHP, Chrome, Console
Author URI: http://www.wordpress-it.it
Plugin URI: http://code.google.com/p/wpit-php-chrome-console/
Requires at least: 3.0
Tested up to: 3.3
Stable tag: 0.1beta

A simple plugin to send data to Google Chrome Console.

== Description ==

A simple plugin to send data to Google Chrome Console. Based on the ChromePhp class [ChromePhp class](https://github.com/ccampbell/chromephp) by [Craig Campbell](http://www.craigiam.com/). You have to install [ChromePHP extension](https://chrome.google.com/webstore/detail/noaneddfkdjfnfdakjjmocngnfkfehhd) on Chrome to have this plugin to work.

The plugin works only using Chrome and for admin only, so no debug sensive data are visible to the world. Through this plugin you can make PHP debug on production live site without breaking pages with echo/print of raw data or use HTML comments to hide them in the code with the risk other people can see them and spiders index them.

This first, beta development version have a series of method to:

* Print simple text messages,
* Echo variable, array or object,
* Echo info/warning/error mesages with/without variable, array or object,
* Start, stop and print execution time of an unlimited numbers or timers
* Allow to group a series of messages into named group that can be full visible or collapsed

The following function are available:

= Print simple messages =

`wpit_cons_log('This is a simple message')`

= Echo value of variable, array or object =

`wpit_cons_var ('A message', $var-array-obj_to_echo)`

= Echo info messagge with optional variable, array or object =

`wpit_cons_info ('A message', $var-array-obj_to_echo)`

= Echo warning messagge with optional variable, array or object =

`wpit_cons_warn ('A message', $var-array-obj_to_echo)`

= Echo error messagge with optional variable, array or object =

`wpit_cons_error ('A message', $var-array-obj_to_echo)`

= Start a timer =

`wpit_cons_start_timer('timer_name')`

= Stop a timer =

`wpit_cons_stop_timer('timer_name')`

= Print timer's value =

`wpit_cons_get_timer('timer_name')`

= Open a group of messages =

`wpit_cons_group('group_name')`

= Open a group of messages collapsed =

`wpit_cons_group_collapsed('group_name')`

= Close a group of messages =

`wpit_cons_group end('group_name')`


== Installation ==

1. Upload 'plugin-name.php' to the '/wp-content/plugins/' directory,
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

None yet

== Changelog ==

= 0.1 =

First test and development release