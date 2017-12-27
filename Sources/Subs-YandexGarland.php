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

function garland_load_theme()
{
    global $boardurl, $context, $modSettings;

    if (empty($modSettings['yandexgarland_modenable'])) {
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
                $context['template_layers'][] = 'garland';
            }
        }
    }

    $context['js_boardurl'] = '
		<script  type="text/javascript">
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
    $config_vars[] = array('check', 'yandexgarland_soundenable');
}
