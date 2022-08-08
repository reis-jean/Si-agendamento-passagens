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
   
    public function perfilCompanhia(){

        session_start();

        if($_SESSION['id'] && $_SESSION['razao']){
            $this->render('perfilCompanhia');
        }else{
            header('Location: /?login=erro');
        }

        
       // $companhia = ModelContainer::getModel("Companhia");
       
        //$this->render('perfilCompanhia');
    }

    public function pesquisarViagem(){

        $this->render('pesquisarViagem');
    }

    public function formPesquisa(){

        $this->render('formPesquisa');
    }

}



?>