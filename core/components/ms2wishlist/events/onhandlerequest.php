<?php

/**
 * Handle ajax requests
 */
class ms2WishlistEventOnHandleRequest extends abstractModuleEvent
{
    /** @var string */
    private $actionKey;

    /** @var string */
    private $actionValue;

    /** @var array */
    private $requestData = [];

    /**
     * ms2WishlistEventOnHandleRequest constructor.
     *
     * @param abstractModule $service
     * @param array $scriptProperties
     */
    public function __construct(abstractModule $service, $scriptProperties = [])
    {
        parent::__construct($service, $scriptProperties);
        $this->actionKey = $this->service->handler::REQUEST_ACTION_KEY;
        $this->actionValue = $_REQUEST[$this->actionKey];
        unset($_REQUEST[$this->actionKey]);
        $this->requestData = $_REQUEST;
    }

    public function run()
    {
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
        if (empty($this->actionValue) || !$isAjax) {
            return;
        }
        $this->service->log([$this->actionValue, $this->requestData]);
        $response = $this->service->handler->handleRequest($this->actionValue, $this->requestData);
        @session_write_close();
        exit($this->modx->toJSON($response));
    }
}