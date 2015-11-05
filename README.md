# laemmi-yourls-plugin-theme
Plugin for YOURLS 1.7

##Description
Nice theme for yourls as plugin
You must install "laemmi-yourls-default-tools" fist.

## Installation
* In /user/plugins, create a new folder named laemmi-yourls-plugin-theme.
* Drop these files in that directory.
* Via git goto /users/plugins and type git clone https://github.com/Laemmi/llaemmi-yourls-plugin-theme.git
* Add config values to config file

### Available config values
#### Add your own page name
define('LAEMMI_THEME_PAGE_NAME', 'My name');
#### Add your own sub page name
define('LAEMMI_THEME_PAGE_SUBNAME', 'My Subname');
#### if you want to use a navbar in footer add
define('LAEMMI_THEME_FOOTER_NAV', json_encode([
    'LINK' => 'NAME'
]));
