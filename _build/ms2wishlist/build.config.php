<?php

define('PKG_NAME', 'ms2Wishlist');
define('PKG_NAME_LOWER', strtolower(PKG_NAME));
define('PKG_PATH', MODX_CORE_PATH . 'components/' . PKG_NAME_LOWER . '/');
define('DB_TYPE', 'mysql');
define('PKG_MODEL_PATH', PKG_PATH . 'model/');
define('PKG_SCHEMA_PATH', PKG_PATH . 'model/schema/' . PKG_NAME_LOWER . '.' . DB_TYPE . '.schema.xml');
define('PKG_ELEMENTS_PATH', PKG_PATH . 'elements/');
define('PKG_BUILD_TRANSPORT_PATH', __DIR__ . '/transport/');
define('PKG_BUILD_DATA_PATH', PKG_BUILD_TRANSPORT_PATH . 'data/');
