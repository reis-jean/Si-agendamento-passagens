<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		$this->render('index');
	}

	public function inscreverse(){
		$this->view->usuario = array(
			'nome' => '',
			'email' => '',
			'senha' => '',
		);

		$this->view->erroCadastro = 'false';

		$this->render('inscreverse');
	}

	public function registrar(){
		
		$usuario = Container::getModel('Usuario');

		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));
		
		if($usuario->validarCadastro() == false){

			$this->view->usuario = array(
				'nome' => $_POST['nome'],
				'email' => $_POST['email'],
				'senha' => $_POST['senha'],
			);

			$this->view->erroCadastro = 'incompleto';
			$this->render('inscreverse');

		}
		elseif(count($usuario->getUsuarioPorEmail()) != 0){
			$this->view->erroCadastro = 'existente';
			$this->render('inscreverse');
	
		}else {

			//registrar usuario no banco!
			$usuario->salvar();
			
			//Logar usuario
			$usuario->autenticar();
			
		}
	}

	public function registrarCompanhia(){
		
		$companhia = Container::getModel('Companhia');

		$companhia->__set('razao', $_POST['razao']);
		$companhia->__set('cnpj', $_POST['cnpj']);
		$companhia->__set('email', $_POST['email']);
		$companhia->__set('senha', md5($_POST['senha']));
		
		if($companhia->validarCadastro() == false){

			$this->view->usuario = array(
				'razao' => $_POST['razao'],
				'cnpj' => $_POST['cnpj'],
				'email' => $_POST['email'],
				'senha' => $_POST['senha'],
			);

			$this->view->erroCadastro = 'incompleto';
			$this->render('inscreverse');

		}
		elseif(count($companhia->getCompanhiaPorEmail()) != 0){
			$this->view->erroCadastro = 'existente';
			$this->render('inscreverse');
	
		}else {

			//registrar usuario no banco!
			$companhia->salvar();
			echo ('DEu certo');
			
			//Logar usuario
			//$companhia->autenticar();
			
		}
	}

	

	public function entrar(){
		$this->render('entrar');
	}

}


?>