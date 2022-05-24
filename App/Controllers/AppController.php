<?php
namespace App\Controllers;

use MF\Controller\Action;
use Mf\Controller\Container;
use MF\Model\Container as ModelContainer;

class AppController extends Action{

    public function perfil(){
        $this->validarAutenticacao();

        $usuario = ModelContainer::getModel("Usuario");
        
        $this->render('perfil');
    }

    public function validarAutenticacao(){
        session_start();

        if(!isset($_SESSION['id']) || $_SESSION['id']== '' || !isset($_SESSION['nome']) || $_SESSION['nome']== ''){
            header('Location: /?login=erro');
        }

    }
}



?>