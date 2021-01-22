<?php

/** @var xPDOTransport $transport */

/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx = &$transport->xpdo;
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            if ($category = $modx->getObject('modCategory', ['category' => 'ms2Wishlist'])) {
                $chunks = $modx->getCollection('modChunk', [
                    'name:IN' => [
                        'ms2wishlist.add',
                        'ms2wishlist.count',
                        'ms2wishlist.outer',
                        'ms2wishlist.row',
                    ],
                ]);
                foreach ($chunks as $item) {
                    $item->set('category', $category->get('id'));
                    $item->save();
                }

                $snippets = $modx->getCollection('modSnippet', [
                    'name:IN' => [
                        'ms2wishlistAdd',
                        'ms2wishlistCount',
                        'ms2wishlistResources',
                    ],
                ]);
                foreach ($snippets as $item) {
                    $item->set('category', $category->get('id'));
                    $item->save();
                }

                $plugins = $modx->getCollection('modPlugin', [
                    'name:IN' => [
                        'ms2Wishlist',
                    ],
                ]);
                foreach ($plugins as $item) {
                    $item->set('category', $category->get('id'));
                    $item->save();
                }
            }
        break;
        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}
return true;
