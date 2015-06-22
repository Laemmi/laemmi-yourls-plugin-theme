# Yourls Plugins (www.yourls.org)
Nice theme for yourls as plugin

## Installation
- copy laemmi-yourls-plugin-theme folder to usr/plugins
- activate plugin in user interface
- add following constants to usr/config.php
  - define('LAEMMI_THEME_PAGE_NAME', 'My name');
  - define('LAEMMI_THEME_PAGE_SUBNAME', 'My Subname');
  - if you want to use a navbar in footer add
  - define('LAEMMI_THEME_FOOTER_NAV', json_encode([
    'LINK' => 'NAME'
]));
