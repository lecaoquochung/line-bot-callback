<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'LineBotCallback',
    ['path' => '/line-bot-callback'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
