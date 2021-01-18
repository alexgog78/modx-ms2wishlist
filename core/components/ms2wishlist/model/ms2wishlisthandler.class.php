<?php

class ms2WishlistHandler
{
    const REQUEST_ACTION_KEY = 'ms2wishlist_action';

    /** @var ms2Wishlist */
    private $service;

    /** @var modX */
    private $modx;

    /** @var array */
    private $resources = [];

    /**
     * ms2WishlistHandler constructor.
     *
     * @param ms2Wishlist $service
     */
    public function __construct(ms2Wishlist $service)
    {
        $this->service = $service;
        $this->modx = $service->modx;
    }
}
