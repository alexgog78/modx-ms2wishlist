<?php

/**
 * @var modX $modx
 */
require_once dirname(__DIR__) . '/modx.php';
require_once __DIR__ . '/build.config.php';

/** $builder modPackageBuilder */
$builder = $modx->loadClass('transport.modPackageBuilder', '', false, true);
$builder = new modPackageBuilder($modx);

/** $builder ms2Wishlist */
$service = $modx->getService(PKG_NAME_LOWER, PKG_NAME, PKG_MODEL_PATH);

/** Creating package */
require_once __DIR__ . '/transport/package.inc.php';

/** Files */
require_once __DIR__ . '/transport/files.inc.php';

/** modSystemSetting*/
require_once __DIR__ . '/transport/settings.inc.php';

/** Create .zip file */
$builder->pack();
exit();
