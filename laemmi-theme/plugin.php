<?php
/*
Plugin Name: laemmi´s theme
Plugin URI: https://github.com/Laemmi/yourls-plugin-laemmi-theme
Description: Nice theme
Version: 1.0
Author: Michael Lämmlein
Author URI: https://github.com/Laemmi
Copyright 2015 laemmi
*/
/*
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 *
 * @category  laemmi-theme-yourls
 * @package   plugin.php
 * @author    Michael Lämmlein <ml@spacerabbit.de>
 * @copyright ©2015 laemmi
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version   1.0
 * @since     12.06.15
*/

// No direct call
if( !defined( 'YOURLS_ABSPATH' ) ) die();

/**
 * Define path to plugin
 */
define('LAEMMI_THEME_ABSPATH_PLUGIN', YOURLS_PLUGINDIR . '/laemmi-theme');

/**
 * Action: pre_html_logo
 */
yourls_add_action('pre_html_logo', function() {
	ob_start();
});

/**
 * Action: html_logo
 */
yourls_add_action('html_logo', function() {
	ob_end_clean();
	echo '<div id="wdv-logo">
	<a href="/" title="' . LAEMMI_THEME_PAGE_NAME . '">' . LAEMMI_THEME_PAGE_NAME . '</a>
	<span>' . LAEMMI_THEME_PAGE_SUBNAME . '</span>
	</div>';
});

/**
 * Action: html_head
 */
yourls_add_action('html_head', function() {
	echo '<style>' . file_get_contents(LAEMMI_THEME_ABSPATH_PLUGIN . '/style.css') . '</style>';
});

/**
 * Filter: html_footer_text
 */
yourls_add_filter('html_footer_text', function($value) {
	return include(LAEMMI_THEME_ABSPATH_PLUGIN . '/html_footer_text.php');
});

/**
 * Filter: html_title
 */
yourls_add_filter('html_title', function($title, $context) {
	$titel = trim(substr($title, 0, strpos($title, '&laquo;')));
	return $titel . ' | ' . LAEMMI_THEME_PAGE_NAME;
});

