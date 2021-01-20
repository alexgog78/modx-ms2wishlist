<?php

/** CORE files */
$vehicle = $builder->createVehicle([
    'source' => MODX_CORE_PATH . 'components/' . PKG_NAME_LOWER,
    'target' => "return MODX_CORE_PATH . 'components/';",
], [
    'vehicle_class' => 'xPDOFileVehicle',
]);
$builder->putVehicle($vehicle);


/** ASSETS files */
$vehicle = $builder->createVehicle([
    'source' => MODX_ASSETS_PATH . 'components/' . PKG_NAME_LOWER,
    'target' => "return MODX_ASSETS_PATH . 'components/';",
], [
    'vehicle_class' => 'xPDOFileVehicle',
]);
$builder->putVehicle($vehicle);
