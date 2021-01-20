<?php

class ms2WishlistResourcesHandler
{
    /** @var ms2Wishlist */
    private $service;

    /** @var modX */
    private $modx;

    /** @var string */
    private $context;

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
        $this->modx->lexicon->load($service::PKG_NAMESPACE . ':status');
        $checkContext = $this->modx->getOption($service::PKG_NAMESPACE . '_check_context', [], true, false);
        $this->context = $checkContext ? $this->modx->context->get('key') : 'web';
        $this->resources = &$service->session[$this->context];
        if (empty($this->resources) || !is_array($this->resources)) {
            $this->resources = [];
        }
    }

    /**
     * @param int $id
     * @return bool
     */
    public function check(int $id)
    {
        return isset($this->resources[$id]);
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return count($this->resources);
    }

    /**
     * @return array
     */
    public function get()
    {
        return $this->resources;
    }

    /**
     * @param int $id
     */
    public function add(int $id)
    {
        $this->resources[$id] = $id;
    }

    /**
     * @param int $id
     */
    public function remove(int $id)
    {
        unset($this->resources[$id]);
    }

    public function clear()
    {
        $this->resources = [];
    }
}
