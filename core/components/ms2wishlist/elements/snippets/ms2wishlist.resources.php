<?php

/**
 * @var modX $modx
 * @var array $scriptProperties
 * @var string $snippet
 * @var string $emptyTpl
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

$resources = $ms2Wishlist->resourcesHandler->get();
$total = $ms2Wishlist->resourcesHandler->getTotal();
if (!$total) {
    return $pdoFetch->getChunk($emptyTpl);
}

$scriptProperties = array_merge($scriptProperties, [
    'parents' => 0,
    'resources' => implode(',', $resources),
]);
$modx->setPlaceholder('ms2wishlist_count', $total);
return $pdoFetch->runSnippet($snippet, $scriptProperties);
