<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format'], ['variable', '/', '\\d+', 'code'], ['text', '/_error']], [], []],
    'create_product' => [[], ['_controller' => 'App\\Controller\\DataBaseController::createEnergyProduct'], [], [['text', '/product']], [], []],
    'index' => [[], ['_controller' => 'App\\Controller\\CollectDataController::getData'], [], [['text', '/']], [], []],
];
