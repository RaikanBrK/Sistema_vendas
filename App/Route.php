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

		$routes['registrar_venda'] = array(
			'route' => '/registrar_venda',
			'controller' => 'indexController',
			'action' => 'registrar_venda'
		);

		$routes['dados_venda'] = array(
			'route' => '/dados_venda',
			'controller' => 'indexController',
			'action' => 'dados_venda'
		);

		$routes['validando_dados_venda'] = array(
			'route' => '/validando_dados_venda',
			'controller' => 'indexController',
			'action' => 'validando_dados_venda'
		);

		$routes['registrar_produto'] = array(
			'route' => '/registrar_produto',
			'controller' => 'indexController',
			'action' => 'registrarProdutosParaVenda'
		);

		$routes['vendas'] = array(
			'route' => '/vendas',
			'controller' => 'indexController',
			'action' => 'vendas'
		);

		$routes['clearVendas'] = array(
			'route' => '/clearVendas',
			'controller' => 'indexController',
			'action' => 'clearVendas'
		);

		// 
		$this->setRoutes($routes);
	}
}
?>