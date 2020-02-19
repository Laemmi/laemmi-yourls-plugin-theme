# laemmi-yourls-plugin-theme
Plugin for YOURLS 1.7

## Description
Nice theme for yourls as plugin
You must install "laemmi-yourls-default-tools" first.

## Installation
Go to project dir of yourls and enter

    composer require laemmi/laemmi-yourls-plugin-theme

Go to the YOURLS Plugins administration page and activate the plugin.

### Available config values

#### Add your own page name
    
    define('LAEMMI_THEME_PAGE_NAME', 'My name');

#### Add your own sub page name

    define('LAEMMI_THEME_PAGE_SUBNAME', 'My Subname');

#### if you want to use a navbar in footer add

    define('LAEMMI_THEME_FOOTER_NAV', json_encode([
        'LINK' => 'NAME'
    ]));
