<?php

if (empty($_REQUEST['ms2_wishlist'])) {
    die('Access denied');
}

/** @noinspection PhpIncludeInspection */
require dirname(dirname(dirname(__DIR__))) . '/index.php';
