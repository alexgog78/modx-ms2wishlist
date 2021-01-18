<?php

$this->loadClass('abstractModule', MODX_CORE_PATH . 'components/abstractmodule/model/', true, true);

class ms2Wishlist extends abstractModule
{
    const PKG_VERSION = '1.1.0';
    const PKG_RELEASE = 'beta';
    const PKG_NAMESPACE = 'ms2wishlist';


    /** @var ms2WishlistHandler */
    public $handler;

    /**
     * ms2Wishlist constructor.
     *
     * @param modX $modx
     * @param array $config
     */
    public function __construct(modX $modx, array $config = [])
    {
        parent::__construct($modx, $config);
        $handlerClass = $this->modx->loadClass('ms2WishlistHandler', __DIR__ . '/', true, true);
        $this->handler = new $handlerClass($this);
    }

    //const REQUEST_ACTION_KEY = 'ms2wishlist_action';

    /** @var modX */
    //public $modx;

    /** @var array */
    //public $config = [];

    /** @var string|null */
    //public $namespace = 'ms2wishlist';

    //public $recordsList = [];

    /**
     * ms2Wishlist constructor.
     * @param modX $modx
     * @param array $config
     */
    /*public function __construct(modX $modx, array $config = [])
    {
        $this->modx = $modx;
        $this->setConfig($config);
        $this->modx->lexicon->load($this->namespace . ':default');

        $this->recordsList = &$_SESSION[$this->namespace];
        if (empty($this->recordsList) || !is_array($this->recordsList)) {
            $this->recordsList = [];
        }
    }*/

    /*public function loadFrontendAssets()
    {
        $configJs = $this->modx->toJSON([
            'actionUrl' => $this->config['actionUrl'],
            'actionName' => $this::REQUEST_ACTION_KEY,
        ]);
        $this->modx->regClientStartupScript('<script type="text/javascript">' . get_class($this) . 'Config = ' . $configJs . ';</script>', true);

        $config = $this->getConfigPlaceholders();
        if ($css = trim($this->modx->getOption($this->namespace . '_frontend_css'))) {
            $this->modx->regClientCSS(str_replace($config['placeholder'], $config['value'], $css));
        }
        if ($js = trim($this->modx->getOption($this->namespace . '_frontend_js'))) {
            $this->modx->regClientScript(str_replace($config['placeholder'], $config['value'], $js));
        }
    }*/

    public function handleRequest(string $action, $data = [])
    {
        switch ($action) {
            case 'add':
                $output = $this->addOrRemove($data['record_id']);
                break;
            case 'remove':
                $output = $this->addOrRemove($data['record_id']);
                break;
            default:
                $output = $this->error($this->modx->lexicon($this->namespace . '.error.action', ['action' => $action]));
                break;
        }
        return $output ?? $this->error($this->modx->lexicon($this->namespace . '.error.response'));
    }

    public function getTotal()
    {
        return count($this->recordsList);
    }

    public function add($id = false)
    {
        if (!$id) {
            return $this->error($this->modx->lexicon($this->namespace . '.error.not_found'));
        }
        $this->recordsList[$id] = $id;
        return $this->success($this->modx->lexicon($this->namespace . '.success.add'), [
            'id' => $id,
            'action' => 'add',
            'total' => $this->getTotal(),
        ]);
    }

    public function remove($id = false)
    {
        if (!$id) {
            return $this->error($this->modx->lexicon($this->namespace . '.error.not_found'));
        }
        unset($this->recordsList[$id]);
        return $this->success($this->modx->lexicon($this->namespace . '.success.remove'), [
            'id' => $id,
            'action' => 'remove',
            'total' => $this->getTotal(),
        ]);
    }

    public function addOrRemove($id = false)
    {
        if ($this->check($id)) {
            return $this->remove($id);
        }
        return $this->add($id);
    }

    public function get()
    {
        return $this->recordsList;
    }

    public function check($id)
    {
        return isset($this->recordsList[$id]);
    }

    /**
     * @param array $config
     */
    /*protected function setConfig($config = [])
    {
        $corePath = $this->modx->getOption($this->namespace . '.core_path', $config, MODX_CORE_PATH . 'components/' . $this->namespace . '/');
        $assetsPath = $this->modx->getOption($this->namespace . '.assets_path', $config, MODX_ASSETS_PATH . 'components/' . $this->namespace . '/');
        $assetsUrl = $this->modx->getOption($this->namespace . '.assets_url', $config, MODX_ASSETS_URL . 'components/' . $this->namespace . '/');
        $moduleConfig = [
            'corePath' => $corePath,
            'assetsPath' => $assetsPath,
            'modelPath' => $corePath . 'model/',
            'handlersPath' => $corePath . 'handlers/',
            'processorsPath' => $corePath . 'processors/',

            'assetsUrl' => $assetsUrl,
            'jsUrl' => $assetsUrl . 'js/',
            'cssUrl' => $assetsUrl . 'css/',
            'connectorUrl' => $assetsUrl . 'connector.php',
            'actionUrl' => $assetsUrl . 'action.php',
        ];
        $this->config = array_merge($moduleConfig, $config);
    }*/

    /*private function getConfigPlaceholders()
    {
        $result = [
            'placeholder' => [],
            'value' => [],
        ];
        foreach ($this->config as $key => $value) {
            if (is_array($value)) {
                $result = array_merge_recursive($result, $this->makePlaceholders($value, $key . '.'));
            } else {
                $result['placeholder'][$key] = '[[+' . $key . ']]';
                $result['value'][$key] = $value;
            }
        }
        return $result;
    }*/

    public function success($message = '', $data = [])
    {
        $output = [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];
        return $output;
    }


    public function error($message = '', $data = [])
    {
        $output = [
            'success' => false,
            'message' => $message,
            'data' => $data,
        ];
        return $output;
    }
}
