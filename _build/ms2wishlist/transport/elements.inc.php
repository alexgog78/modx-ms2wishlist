<?php


$category = $modx->newObject('modCategory');
$category->set('id', 1);
$category->set('category', PKG_NAME);


/** Chunks */
$chunks = include PKG_BUILD_DATA_PATH . 'chunks.php';
foreach ($chunks as $data) {
    $chunk = $modx->newObject('modChunk');
    if ($data['static_file']) {
        $data['snippet'] = file_get_contents($data['static_file']);
    }
    $chunk->fromArray(array_merge([
        'id' => 0,
        'category' => 0,
    ], $data), '', true, true);
    $category->addMany($chunk);
}

/** Snippets */
$snippets = include PKG_BUILD_DATA_PATH . 'snippets.php';
foreach ($snippets as $data) {
    $snippet = $modx->newObject('modSnippet');
    if ($data['static_file']) {
        $fileContent = trim(file_get_contents($data['static_file']));
        preg_match('#\<\?php(.*)#is', $fileContent, $code);
        $data['snippet'] =  rtrim(rtrim(trim($code[1]), '?>'));
    }
    $snippet->fromArray(array_merge([
        'id' => 0,
        'category' => 0,
    ], $data), '', true, true);
    $category->addMany($snippet);
}

/** Plugins */
$plugins = include PKG_BUILD_DATA_PATH . 'plugins.php';
foreach ($plugins as $data) {
    $plugin = $modx->newObject('modPlugin');
    if ($data['static_file']) {
        $fileContent = trim(file_get_contents($data['static_file']));
        preg_match('#\<\?php(.*)#is', $fileContent, $code);
        $data['plugincode'] =  rtrim(rtrim(trim($code[1]), '?>'));
    }
    $plugin->fromArray(array_merge([
        'id' => 0,
        'category' => 0,
    ], $data), '', true, true);

    $events = [];
    if (!empty($data['events'])) {
        foreach ($data['events'] as $pluginEvent) {
            $event = $modx->newObject('modPluginEvent');
            $event->fromArray([
                'event' => $pluginEvent,
                'priority' => 0,
                'propertyset' => 0,
            ], '', true, true);
            $events[] = $event;
        }
        $plugin->addMany($events);
    }

    $category->addMany($plugin);
}

/** Category */
$vehicle = $builder->createVehicle($category, [
    xPDOTransport::UNIQUE_KEY => 'category',
    xPDOTransport::PRESERVE_KEYS => false,
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::RELATED_OBJECTS => true,
    xPDOTransport::RELATED_OBJECT_ATTRIBUTES => [
        'Snippets' => [
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => 'name',
        ],
        'Chunks' => [
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => 'name',
        ],
        'Plugins' => [
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => 'name',
        ],
        'PluginEvents' => [
            xPDOTransport::PRESERVE_KEYS => true,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => [
                'pluginid',
                'event',
            ],
        ],
    ],
]);
$builder->putVehicle($vehicle);

