<?php

if (empty($_REQUEST['ms2wishlist_action'])) {
    die('Access denied');
}

/** @noinspection PhpIncludeInspection */
require dirname(dirname(dirname(__DIR__))) . '/index.php';
