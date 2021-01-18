<?php

/**
 * Handle non-ajax requests
 */
class ms2WishlistEventOnLoadWebDocument extends abstractModuleEvent
{
    /** @var string */
    private $actionKey;

    /** @var string */
    private $actionValue;

    /** @var array */
    private $requestData = [];

    /**
     * ms2WishlistEventOnLoadWebDocument constructor.
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
        if (empty($this->actionValue)) {
            return;
        }
        $this->service->log([$this->actionValue, $this->requestData]);
        $response = $this->service->handler->handleRequest($this->actionValue, $this->requestData);
        $this->modx->setPlaceholder('request_status', $response['success']);
        $this->modx->setPlaceholder('request_message', $response['message']);
    }
}
