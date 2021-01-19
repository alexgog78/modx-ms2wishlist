<?php

trait ms2WishlistHelperRequest
{
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
                $this->handler->add($id);
                $output = $this->success($this->modx->lexicon($this::PKG_NAMESPACE . '_scs_add'), [
                    'id' => $id,
                    'action' => 'add',
                    'total' => $this->handler->getTotal(),
                ]);
                break;
            case 'remove':
                $id = $data['record_id'];
                $this->handler->remove($id);
                $output = $this->success($this->modx->lexicon($this::PKG_NAMESPACE . '_scs_remove'), [
                    'id' => $id,
                    'action' => 'remove',
                    'total' => $this->handler->getTotal(),
                ]);
                break;
            case 'clear':
                $this->handler->clear();
                $output = $this->success($this->modx->lexicon($this::PKG_NAMESPACE . '_scs_clear'), [
                    'action' => 'clear',
                    'total' => $this->handler->getTotal(),
                ]);
                break;
            default:
                $output = $this->error($this->modx->lexicon($this::PKG_NAMESPACE . '_err_action_nf', ['action' => $action]));
                break;
        }
        return $output ?? $this->error($this->modx->lexicon($this::PKG_NAMESPACE . '_err_response_format'));
    }

    /**
     * @param string $message
     * @param array $data
     * @return array
     */
    private function success($message = '', $data = [])
    {
        return [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];
    }

    /**
     * @param string $message
     * @param array $data
     * @return array
     */
    private function error($message = '', $data = [])
    {
        return [
            'success' => false,
            'message' => $message,
            'data' => $data,
        ];
    }
}
