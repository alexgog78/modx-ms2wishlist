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
$modxEvent = $modx->event->name;
$ms2Wishlist->handleEvent($modxEvent, $scriptProperties);
return;







/** @var modX $modx */

/** @var ms2Wishlist $ms2Wishlist */
$ms2Wishlist = $modx->getService('ms2wishlist', 'ms2Wishlist', MODX_CORE_PATH . 'components/ms2wishlist/model/ms2wishlist/');

switch ($modx->event->name) {
    case 'OnHandleRequest':
        //Handle ajax requests
        /*$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
        $action = $_REQUEST[$ms2Wishlist::REQUEST_ACTION_KEY];
        if (!empty($action) && $isAjax) {
            $response = $ms2Wishlist->handleRequest($action, $_REQUEST);
            @session_write_close();
            exit($modx->toJSON($response));
        }*/
        break;
    case 'OnLoadWebDocument':
        //Handle non-ajax requests
        /*$action = $_REQUEST[$ms2Wishlist::REQUEST_ACTION_KEY];
        if (!empty($action)) {
            $response = $ms2Wishlist->handleRequest($action, $_REQUEST);
            $modx->setPlaceholder('request_status', $response['success']);
            $modx->setPlaceholder('request_message', $response['message']);
        }*/
        break;
}
return;
