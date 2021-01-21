<?php

return [
    [
        'name' => 'ms2Wishlist',
        'static_file' => PKG_ELEMENTS_PATH . 'plugins/ms2wishlist.php',
        'events' => [
            'OnHandleRequest',
            'OnLoadWebDocument',
        ],
    ],
];
