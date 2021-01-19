<?php

class ms2WishlistHandler
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
     * @param string $action
     * @param array $data
     * @return array
     */
    public function handleRequest(string $action, $data = [])
    {
        switch ($action) {
            case 'add':
                $id = $data['record_id'];
                $this->add($id);
                $output = $this->success($this->modx->lexicon($this->service::PKG_NAMESPACE . '_scs_add'), [
                    'id' => $id,
                    'action' => 'add',
                    'total' => $this->getTotal(),
                ]);
                break;
            case 'remove':
                $id = $data['record_id'];
                $this->remove($id);
                $output = $this->success($this->modx->lexicon($this->service::PKG_NAMESPACE . '_scs_remove'), [
                    'id' => $id,
                    'action' => 'remove',
                    'total' => $this->getTotal(),
                ]);
                break;
            case 'clear':
                $this->clear();
                $output = $this->success($this->modx->lexicon($this->service::PKG_NAMESPACE . '_scs_clear'), [
                    'action' => 'clear',
                    'total' => $this->getTotal(),
                ]);
                break;
            default:
                $output = $this->error($this->modx->lexicon($this->service::PKG_NAMESPACE . '_err_action_nf', ['action' => $action]));
                break;
        }
        return $output ?? $this->error($this->modx->lexicon($this->service::PKG_NAMESPACE . '_err_response_format'));
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
    private function add(int $id)
    {
        $this->resources[$id] = $id;
    }

    /**
     * @param int $id
     */
    private function remove(int $id)
    {
        unset($this->resources[$id]);
    }

    private function clear()
    {
        $this->resources = [];
    }

    /**
     * @param string $message
     * @param array $data
     * @return array
     */
    private function success($message = '', $data = [])
    {
        $output = [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];
        return $output;
    }

    /**
     * @param string $message
     * @param array $data
     * @return array
     */
    private function error($message = '', $data = [])
    {
        $output = [
            'success' => false,
            'message' => $message,
            'data' => $data,
        ];
        return $output;
    }
}
