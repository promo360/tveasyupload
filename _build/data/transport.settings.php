<?php

$s = array(
    'translit' => false,
    'check_resid' => true,
    'preview_width' => '94',
);

$settings = array();

foreach ($s as $key => $value) {
    if (is_string($value) || is_int($value)) { $type = 'textfield'; }
    elseif (is_bool($value)) { $type = 'combo-boolean'; }
    else { $type = 'textfield'; }

    $parts = explode('.',$key);
    if (count($parts) == 1) { $area = 'Default'; }
    else { $area = $parts[0]; }
    
    $settings['fastuploadtv.'.$key] = $modx->newObject('modSystemSetting');
    $settings['fastuploadtv.'.$key]->set('key', 'fastuploadtv.'.$key);
    $settings['fastuploadtv.'.$key]->fromArray(array(
        'value' => $value,
        'xtype' => $type,
        'namespace' => 'fastuploadtv',
        'area' => $area
    ));
}

return $settings;