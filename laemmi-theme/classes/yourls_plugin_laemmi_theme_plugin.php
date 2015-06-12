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
 * @package   classes/yourls_plugin_laemmi_theme_plugin.php
 * @author    Michael Lämmlein <ml@spacerabbit.de>
 * @copyright ©2015 laemmi
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version   1.0
 * @since     12.06.15
*/

/**
 * Class yourls_plugin_laemmi_theme_plugin
 */
class yourls_plugin_laemmi_theme_plugin
{
    /**
     * Action & filter
     *
     * @param $instance
     */
    public function __construct(yourls_plugin_laemmi_theme_interface $instance)
    {
        yourls_add_action('pre_html_logo', [$instance, 'pre_html_logo']);
        yourls_add_action('html_logo', [$instance, 'html_logo']);
        yourls_add_action('html_head', [$instance, 'html_head']);
        yourls_add_filter('html_footer_text', [$instance, 'html_footer_text']);
        yourls_add_filter('html_title', [$instance, 'html_title']);
    }
}