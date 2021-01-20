<?php

$settings = include __DIR__ . '/data/settings.php';
foreach ($settings as $settingData) {
    $setting = $modx->newObject('modSystemSetting');
    $setting->fromArray(array_merge([
        'namespace' => PKG_NAME_LOWER,
    ], $settingData), '', true, true);
    $vehicle = $builder->createVehicle($setting, [
        xPDOTransport::PRESERVE_KEYS => true,
        xPDOTransport::UPDATE_OBJECT => false,
        xPDOTransport::UNIQUE_KEY => 'key',
    ]);
    $builder->putVehicle($vehicle);
}
