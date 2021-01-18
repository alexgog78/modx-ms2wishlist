<?php

/**
 * @var modX $modx
 * @var array $scriptProperties
 */

/** @var ms2Wishlist $ms2Wishlist */
$ms2Wishlist = $modx->getService('ms2wishlist', 'ms2Wishlist', MODX_CORE_PATH . 'components/ms2wishlist/model/');
if (!($ms2Wishlist instanceof ms2Wishlist)) {
    exit('Could not load ms2Wishlist');
}

$ms2Wishlist->loadWebDefaultCssJs();


$output = '';

return $output;
