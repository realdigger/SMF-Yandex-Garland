<?php

/*******************************************
 * YandexGarland
 * Version 1.3
 * © mamavrn.ru
 * License - http://creativecommons.org/licenses/by-sa/3.0/ CC BY-SA 3.0
 ********************************************
 * Subs-YandexGarland.php
 *******************************************/

if (!defined('SMF')) {
    die('Hacking attempt...');
}

function load_garland_hooks()
{
    add_integration_function('integrate_load_theme', 'garland_load_theme', false);
    add_integration_function('integrate_general_mod_settings', 'garland_settings', false);
    add_integration_function('integrate_menu_buttons', 'garland_ñopyright', false);
}

function garland_load_theme()
{
    global $boardurl, $context, $modSettings;

    if (empty($modSettings['yandexgarland_modenable']) || (empty($modSettings['yandexgarland_mobileenable']) && (!empty($context['browser']['is_iphone']) || !empty($context['browser']['is_android'])))) {
        return;
    }

    loadTemplate('YandexGarland');

    $context['html_headers'] .= '
		<link type="text/css" rel="stylesheet" href="' . $boardurl . '/Themes/default/css/garland.css" />
		<script type="text/javascript" defer="defer" src="' . $boardurl . '/Themes/default/scripts/balls/newyear.js"></script>';

    if (isset($context['template_layers'])) {
        $layerHolder = $context['template_layers'];
    }
    $context['template_layers'] = array();
    if (isset($layerHolder)) {
        foreach ($layerHolder as $layer) {
            $context['template_layers'][] = $layer;
            if ($layer == 'html') {
                $context['template_layers'][] = 'yandex_garland';
            }
        }
    }

    $context['js_boardurl'] = '
		<script type="text/javascript">
		//<![CDATA[
		js_audio_url = "' . $boardurl . '/Themes/default/scripts/balls/audio/";
		js_soundenable = ' . $modSettings['yandexgarland_soundenable'] . ';
		//]]>
		</script>';

}

function garland_settings(&$config_vars)
{
    loadLanguage('YandexGarland/YandexGarland');
    if (isset($config_vars[0])) {
        $config_vars[] = array('title', 'yandexgarland_name');
    }
    $config_vars[] = array('check', 'yandexgarland_modenable');
    $config_vars[] = array('check', 'yandexgarland_mobileenable');
    $config_vars[] = array('check', 'yandexgarland_soundenable');
}

function garland_ñopyright()
{
    global $context;
    if ($context['current_action'] == 'credits') {
        $context['copyrights']['mods'][] = '<a href="https://github.com/realdigger/SMF-Yandex-Garland" title="Yandex Garland" target="_blank">Yandex Garland</a>';
    }
}
