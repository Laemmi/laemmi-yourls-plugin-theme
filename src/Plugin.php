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
 * @category  laemmi-yourls-plugin-theme
 * @author    Michael Lämmlein <laemmi@spacerabbit.de>
 * @copyright ©2015 laemmi
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version   1.0
 * @since     12.06.15
*/

namespace Laemmi\Yourls\Plugin\Theme;

use Laemmi\Yourls\Plugin\AbstractDefault;

class Plugin extends AbstractDefault
{
    /**
     * Namespace
     */
    const APP_NAMESPACE = 'laemmi-yourls-plugin-theme';

    /**
     * Init
     */
    protected function init()
    {
        $this->initTemplate();
    }

    ####################################################################################################################

    /**
     * Action: plugins_loaded
     */
    public function action_plugins_loaded()
    {
        $this->loadTextdomain();
    }

    /**
     * Action: pre_html_logo
     */
    public function action_pre_html_logo()
    {
        ob_start(); // Start: remove logo
    }

    /**
     * Action: html_logo
     */
    public function action_html_logo()
    {
        ob_end_clean(); // End: remove logo

        $data = [
            'admin_links' => [],
            'admin_sublinks' => [],
        ];

        if (defined('YOURLS_USER')) {
            $data = $this->_getNavigationLinks();
        }

        echo $this->getTemplate()->render('header', [
            'admin_links' => $data['admin_links'],
            'admin_sublinks' => $data['admin_sublinks'],
            'page_name' => LAEMMI_THEME_PAGE_NAME,
            'page_subname' => LAEMMI_THEME_PAGE_SUBNAME,
        ]);

        if (defined('YOURLS_USER') || $this->_isCalledLoginScreen()) {
            ob_start(); // Start: Remove menu / Login screen
        }
    }

    /**
     * Action: html_footer
     */
    public function action_html_footer()
    {
        if ($logindata = $this->_isCalledLoginScreen()) {
            ob_end_clean(); // End: Login screen

            $debug = '';
            if (defined('YOURLS_DEBUG') && YOURLS_DEBUG == true) {
                $debug = join("\n", $this->db()->debug_log);
            }

            echo $this->getTemplate()->render('login', [
                'action' => isset($_GET['action']) && $_GET['action'] == 'logout' ? '?' : '',
                'error' => isset($logindata['args'][0]) && $_POST ? $logindata['args'][0] : '',
                'links' => defined('LAEMMI_THEME_FOOTER_NAV') ? (array) json_decode(LAEMMI_THEME_FOOTER_NAV) : [],
                'debug' => $debug
            ]);
        }
    }

    /**
     * Action: admin_notice
     */
    public function action_admin_notice()
    {
        if (defined('YOURLS_USER')) {
            ob_end_clean(); // End: Remove menu
        }
    }

    /**
     * Action: html_head
     */
    public function action_html_head()
    {
        echo $this->getBootstrap();
        echo $this->getCssStyle();
        echo $this->getJsScript();
    }

    ####################################################################################################################

    /**
     * Filter: html_footer_text
     *
     * @return mixed
     */
    public function filter_html_footer_text()
    {
        list ($footer) = func_get_args();

        return $this->getTemplate()->render('footer_text', [
            'links' => defined('LAEMMI_THEME_FOOTER_NAV') ? (array) json_decode(LAEMMI_THEME_FOOTER_NAV) : []
        ]);
    }

    /**
     * Filter: html_title
     *
     * @return string
     */
    public function filter_html_title()
    {
        list ($title, $context) = func_get_args();

        $title = trim(substr($title, 0, strpos($title, '&laquo;')));
        return $title . ' | ' . LAEMMI_THEME_PAGE_NAME;
    }

    ####################################################################################################################

    /**
     * Plugin page laemmi_help
     */
    public function pluginPageLaemmiHelp()
    {
        echo $this->getTemplate()->render('plugin_page_laemmi_help', []);
    }

    ####################################################################################################################

    /**
     * Get navigation links for menu
     *
     * @return array
     */
    private function _getNavigationLinks()
    {
        $admin_links['admin'] = array(
            'url'    => yourls_admin_url('index.php'),
            'title'  => yourls__('Go to the admin interface'),
            'anchor' => yourls__('Admin interface')
        );

        if (defined('YOURLS_USER')) {
            $admin_links['tools'] = array(
                'url'    => yourls_admin_url('tools.php'),
                'anchor' => yourls__('Tools')
            );
            $admin_links['plugins'] = array(
                'url'    => yourls_admin_url('plugins.php'),
                'anchor' => yourls__('Manage Plugins')
            );
            $admin_sublinks['plugins'] = yourls_list_plugin_admin_pages();
        }

        $admin_links = yourls_apply_filter('admin_links', $admin_links);
        $admin_sublinks = yourls_apply_filter('admin_sublinks', $admin_sublinks);

//        $admin_links['help'] = array(
//            'url'    => yourls_site_url(false) .'/admin/plugins.php?page=laemmi_admin_help',
//            'anchor' => yourls__('Help')
//        );

        if (defined('YOURLS_USER') && yourls_is_private()) {
            $admin_links['logout'] = array(
                'url' => '#',
                'anchor' => YOURLS_USER
            );
            $admin_sublinks['logout'] = array(
                'logout' => array(
                    'url' => '?action=logout',
                    'anchor' => yourls__('Logout')
                )
            );
        }

        return array(
            'admin_links' => $admin_links,
            'admin_sublinks' => $admin_sublinks,
        );
    }

    /**
     * Check if call function is login_screen
     *
     * @return bool
     */
    private function _isCalledLoginScreen()
    {
        foreach (debug_backtrace() as $val) {
            if (!isset($val['function'])) {
                continue;
            }
            if ('yourls_login_screen' === $val['function']) {
                return $val;
            }
        }
        return false;
    }
}
