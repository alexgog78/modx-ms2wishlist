<?php

return [
    [
        'name' => 'ms2Wishlist',
        'static_file' => PKG_PATH . 'elements/plugins/ms2wishlist.php',
        'events' => [
            'OnHandleRequest',
            'OnLoadWebDocument',
        ],
    ],
];
