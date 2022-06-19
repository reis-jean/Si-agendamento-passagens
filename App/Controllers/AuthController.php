<?php 

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action{

    public function autenticar(){
        

        $usuario = container::getModel('Usuario');

        $usuario->__set('email', $_POST['email']);
        $usuario->__set('senha', md5($_POST['senha']));

        $usuario->autenticarUsuario();
        if($usuario->__get('id') != '' && $usuario->__get('nome')){

            session_start();

            $_SESSION['id'] = $usuario->__get('id');
            $_SESSION['nome'] = $usuario-> __get('nome');

            header('Location: /perfil');

        }else{
            
            header('Location: /entrar?erroAutUsuario=erro');
        }
        
    }

    //autenticar Companhia
    public function autenticarCompanhia(){

        $companhia = container::getModel('Companhia');

        $companhia->__set('email', $_POST['email']);
        $companhia->__set('senha', md5($_POST['senha']));

        $companhia->autenticarCompanhia();

        if($companhia->__get('id') != '' && $companhia->__get('razao')){

            session_start();

            $_SESSION['id'] = $companhia->__get('id');
            $_SESSION['razao'] = $companhia-> __get('razao');
            header('Location: /perfilCompanhia');

        }else{
            header('Location: /entrarCompanhia?erroAutCompanhia=erro');
           
        }
        
    }

    public function sair(){
        session_start();
        session_destroy();
        header('Location: /');
    }
}