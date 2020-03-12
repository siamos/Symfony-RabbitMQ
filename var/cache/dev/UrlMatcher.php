<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/product' => [
            [['_route' => 'create_product', '_controller' => 'App\\Controller\\RabbitDataController::listen'], null, null, null, false, false, null],
            [['_route' => 'app_test_controller', '_controller' => 'App\\Controller\\RabbitDataController::listen'], null, null, null, true, false, null],
        ],
        '/' => [[['_route' => 'index', '_controller' => 'App\\Controller\\CollectDataController::getData'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        35 => [
            [['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
