<?php

/*******************************************
* YandexGarland
* Version 1.2
* © mamavrn.ru
* License - http://creativecommons.org/licenses/by-sa/3.0/ CC BY-SA 3.0
********************************************
* Subs-YandexGarland.php
*******************************************/

if (!defined('SMF')) 
    die('Hacking attempt...');
    
function garland_load_theme() 
{
	global $boardurl, $context, $modSettings;

	if (empty($modSettings['yandexgarland_modenable'])) return;

	loadTemplate('YandexGarland');  

	$context['html_headers'] .= '
		<link type="text/css" rel="stylesheet" href="' . $boardurl . '/Themes/default/css/garland.css" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript" src="' . $boardurl . '/Themes/default/scripts/swfobject.min.js"></script> 
		<script type="text/javascript" src="' . $boardurl . '/Themes/default/scripts/newyear.js"></script>';

	if (isset($context['template_layers']))
		$layerHolder = $context['template_layers'];
	$context['template_layers'] = array();
	if (isset($layerHolder ))
	foreach($layerHolder as $layer)
	{
		$context['template_layers'][] = $layer;
		if ($layer == 'html')
			$context['template_layers'][] = 'garland';
	}

	$context['js_boardurl'] = '
		<script  type="text/javascript">
		//<![CDATA[
		js_boardurl = "' . $boardurl . '";
		js_soundenable = ' . $modSettings['yandexgarland_soundenable'] . ';
		//]]>
		</script>';

}

function garland_settings(&$config_vars)
{
	global $txt, $modSettings; 
	loadLanguage('YandexGarland');
	if (isset($config_vars[0])) $config_vars[] = array('title', 'yandexgarland_name');  
	$config_vars[] = array('check', 'yandexgarland_modenable');
	$config_vars[] = array('check', 'yandexgarland_soundenable');
}

?>
