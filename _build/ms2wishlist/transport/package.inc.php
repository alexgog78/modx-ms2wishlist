<?php

$builder->createPackage(PKG_NAME_LOWER, $service::PKG_VERSION, $service::PKG_RELEASE);
$builder->registerNamespace(PKG_NAME_LOWER, false, true, '{core_path}components/' . PKG_NAME_LOWER . '/', '{assets_path}components/' . PKG_NAME_LOWER . '/');
$builder->setPackageAttributes([
    'changelog' => file_get_contents(PKG_PATH . 'docs/changelog.txt'),
    'license' => file_get_contents(PKG_PATH . 'docs/license.txt'),
    'readme' => file_get_contents(PKG_PATH . 'docs/readme.txt'),
]);
