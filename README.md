# yourls-laemmi-theme
Nice theme for yourls

Installation
- copy pluginfolder to usr/plugins
- Activate plugin in user interface
- add following constants to usr/config.php
  - define('LAEMMI_THEME_PAGE_NAME', 'My name');
  - define('LAEMMI_THEME_PAGE_SUBNAME', 'My Subname');
  - if you want to use a navbar in footer add
  - define('LAEMMI_THEME_FOOTER_NAV', json_encode([
    'LINK' => 'NAME'
]));
