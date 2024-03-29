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
		
		// routes cadastro usuario
		$routes['inscreverse'] = array(
			'route' => '/inscreverse',
			'controller' => 'indexController',
			'action' => 'inscreverse'
		);
		

		$routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);

		//routes cadastro companhia
		$routes['inscreverseCompanhia'] = array(
			'route' => '/inscreverseCompanhia',
			'controller' => 'indexController',
			'action' => 'inscreverseCompanhia'
		);
		


		$routes['registrarCompanhia'] = array(
			'route' => '/registrarCompanhia',
			'controller' => 'indexController',
			'action' => 'registrarCompanhia'
		);

		
		//login do usuario
		$routes['entrar'] = array(
			'route' => '/entrar',
			'controller' => 'indexController',
			'action' => 'entrar'
		);
		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);

		$routes['entrarCompanhia'] = array(
			'route' => '/entrarCompanhia',
			'controller' => 'indexController',
			'action' => 'entrarCompanhia'
		);
		$routes['autenticarCompanhia'] = array(
			'route' => '/autenticarCompanhia',
			'controller' => 'AuthController',
			'action' => 'autenticarCompanhia'
		);

		//fazer logout
		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);

		// perfil usuario
		$routes['perfil'] = array(
			'route' => '/perfil',
			'controller' => 'AppController',
			'action' => 'perfil'
		);
		
		//perfil Companhia perfilCompanhia
		$routes['perfilCompanhia'] = array(
			'route' => '/perfilCompanhia',
			'controller' => 'AppController',
			'action' => 'perfilCompanhia'
		);

		//pesquisar Viagens
		$routes['pesquisarViagem'] = array(
			'route' => '/pesquisarViagem',
			'controller' => 'AppController',
			'action' => 'pesquisarViagem'
		);

		
		
		$routes['cadastrarViagem'] = array(
			'route' => '/cadastrarViagem',
			'controller' => 'AppController',
			'action' => 'cadastrarViagem'
		);

		$routes['EditarViagemPag'] = array(
			'route' => '/EditarViagemPag',
			'controller' => 'AppController',
			'action' => 'EditarViagemPag'
		);

		$routes['EditarViagem'] = array(
			'route' => '/EditarViagem',
			'controller' => 'AppController',
			'action' => 'EditarViagem'
		);

		$routes['apagarViagem'] = array(
			'route' => '/apagarViagem',
			'controller' => 'AppController',
			'action' => 'apagarViagem'
		);

		//reservar viagem
		$routes['reservarViagem'] = array(
			'route' => '/reservarViagem',
			'controller' => 'AppController',
			'action' => 'reservarViagem'
		);

		// Cadastrar Reserva 
		$routes['cadastrarReserva'] = array(
			'route' => '/cadastrarReserva',
			'controller' => 'AppController',
			'action' => 'cadastrarReserva'
		);


		$routes['minhasViagens'] = array(
			'route' => '/minhasViagens',
			'controller' => 'AppController',
			'action' => 'minhasViagens'
		);


		

		
		$this->setRoutes($routes);
	}

}

?>