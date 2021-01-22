<?php

return [
    [
        'name' => 'snippet',
        'type' => 'textfield',
        'value' => 'msProducts',
    ],
    [
        'name' => 'tpl',
        'type' => 'textfield',
        'value' => 'ms2wishlist.row',
    ],
    [
        'name' => 'tplWrapper',
        'type' => 'textfield',
        'value' => 'ms2wishlist.outer',
    ],
    [
        'name' => 'tplEmpty',
        'type' => 'textfield',
        'value' => '@INLINE {\'ms2wishlist_is_empty\' | lexicon}',
    ],
];
