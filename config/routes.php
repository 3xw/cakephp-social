<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::prefix('admin', function (RouteBuilder $routes) {
	$routes->plugin('Trois/Social', ['path' => '/social'], function (RouteBuilder $routes) {
		$routes->connect('/', ['controller' => 'SocialPosts', 'action' => 'index'], ['routeClass' => DashedRoute::class]);
		$routes->extensions(['json']);
		$routes->fallbacks(DashedRoute::class);
	});
});
