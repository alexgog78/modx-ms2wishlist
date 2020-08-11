<?php

/** @var modX $modx */
/** @var modX $tpl */

/** @var ms2Wishlist $ms2Wishlist */
$ms2Wishlist = $modx->getService('ms2wishlist', 'ms2Wishlist', MODX_CORE_PATH . 'components/ms2wishlist/model/ms2wishlist/');
$ms2Wishlist->loadFrontendAssets();

/** @var pdoFetch $pdoFetch */
if (!$modx->loadClass('pdofetch', MODX_CORE_PATH . 'components/pdotools/model/pdotools/', false, true)) {
    return false;
}
$pdoFetch = new pdoFetch($modx, $scriptProperties);

return $pdoFetch->getChunk($tpl, [
    'total_count' => $ms2Wishlist->getTotal(),
]);
