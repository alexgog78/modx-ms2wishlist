<?php

/**
 * @var modX $modx
 * @var array $scriptProperties
 * @var int $id
 * @var string $tpl
 */

/** @var ms2Wishlist $ms2Wishlist */
$ms2Wishlist = $modx->getService('ms2wishlist', 'ms2Wishlist', MODX_CORE_PATH . 'components/ms2wishlist/model/');
if (!($ms2Wishlist instanceof ms2Wishlist)) {
    exit('Could not load ms2Wishlist');
}
$ms2Wishlist->loadWebDefaultCssJs();

/** @var pdoFetch $pdoFetch */
if (!$modx->loadClass('pdofetch', MODX_CORE_PATH . 'components/pdotools/model/pdotools/', false, true)) {
    return false;
}
$pdoFetch = new pdoFetch($modx, $scriptProperties);

$resourceId = $id ?? $modx->resource->id;
$active = $ms2Wishlist->resourcesHandler->check($resourceId);
return $pdoFetch->getChunk($tpl, [
    'id' => $resourceId,
    'active' => $active,
]);
