<?php
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
 * @package   classes/yourls_plugin_laemmi_theme.php
 * @author    Michael Lämmlein <ml@spacerabbit.de>
 * @copyright ©2015 laemmi
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version   1.0
 * @since     12.06.15
*/

require_once 'yourls_plugin_laemmi_theme_interface.php';

/**
 * Class yourls_plugin_laemmi_theme
 */
class yourls_plugin_laemmi_theme implements yourls_plugin_laemmi_theme_interface
{
    /**
     * Define path to plugin
     */
    protected $plugin_path = '';

    public function __construct()
    {
        $this->plugin_path = YOURLS_PLUGINDIR . '/laemmi-theme';
    }

    /**
     * Action: pre_html_logo
     */
    public function pre_html_logo()
    {
        ob_start();
    }

    /**
     * Action: html_logo
     */
    public function html_logo()
    {
        ob_end_clean();
        echo '<div id="wdv-logo">
        <a href="/" title="' . LAEMMI_THEME_PAGE_NAME . '">' . LAEMMI_THEME_PAGE_NAME . '</a>
        <span>' . LAEMMI_THEME_PAGE_SUBNAME . '</span>
        </div>';
    }

    /**
     * Action: html_head
     */
    public function html_head()
    {
        echo '<style>' . file_get_contents($this->plugin_path . '/style.css') . '</style>';
    }

    /**
     * Filter: html_footer_text
     *
     * @param $value
     * @return mixed
     */
    public function html_footer_text($value)
    {
        return include($this->plugin_path . '/html_footer_text.php');
    }

    /**
     * Filter: html_title
     *
     * @param $title
     * @param $context
     * @return string
     */
    public function html_title($title, $context)
    {
        $title = trim(substr($title, 0, strpos($title, '&laquo;')));
        return $title . ' | ' . LAEMMI_THEME_PAGE_NAME;
    }
}