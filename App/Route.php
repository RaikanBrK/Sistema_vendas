<?php
namespace App;

use MF\Init\Bootstrap;
class Route extends Bootstrap {
	protected function initRoutes() {
		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['get_produtos'] = array(
			'route' => '/get_produtos',
			'controller' => 'indexController',
			'action' => 'get_produtos'
		);

		$routes['get_produto'] = array(
			'route' => '/get_produto',
			'controller' => 'indexController',
			'action' => 'get_produto'
		);

		$this->setRoutes($routes);
	}
}
?>