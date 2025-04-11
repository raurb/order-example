<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/orders' => [
            [['_route' => 'orders_list', '_controller' => 'OrderExample\\Controller\\OrderController::list'], null, ['GET' => 0], null, true, false, null],
            [['_route' => 'orders_create', '_controller' => 'OrderExample\\Controller\\OrderController::createOrder'], null, ['POST' => 0], null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/orders/(?'
                    .'|([^/]++)(?'
                        .'|(*:68)'
                    .')'
                    .'|test(*:80)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        68 => [
            [['_route' => 'orders_update', '_controller' => 'OrderExample\\Controller\\OrderController::updateOrder'], ['uuid'], ['PATCH' => 0], null, false, true, null],
            [['_route' => 'orders_show', '_controller' => 'OrderExample\\Controller\\OrderController::getByUuid'], ['uuid'], ['GET' => 0], null, false, true, null],
        ],
        80 => [
            [['_route' => 'orders_test', '_controller' => 'OrderExample\\Controller\\OrderController::test'], [], ['GET' => 0], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
