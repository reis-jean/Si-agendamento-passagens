<?php
namespace App\Controllers;


use MF\Controller\Action;
use MF\Model\Container as ModelContainer;

class AppController extends Action{

    public function perfilCompanhia(){
        
        session_start();
        
        if($_SESSION['id'] && $_SESSION['razao']){

            //recuperando viagens
            $viagem = ModelContainer::getModel("Viagem");
            $viagem->__set('id_Companhia', $_SESSION['id']);

            $viagens = $viagem->getAll();
            $this->view->viagens = $viagens;

            $usuario = ModelContainer::getModel("Companhia");
            $usuario->__set('id', $_SESSION['id']);


            $this->render('perfilCompanhia');
        
        }else{
            header('Location: /?login=erro');
        }

        


        $this->render('perfilCompanhia');
    }

    

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
   
    

    public function pesquisarViagem(){

        $this->render('pesquisarViagem');
    }

    public function formPesquisa(){

        $this->render('formPesquisa');
    }

    public function cadastrarViagem(){

        session_start();

        $viagem = ModelContainer::getModel('Viagem');

        $viagem->__set('id_Companhia', $_SESSION['id']);
        $viagem->__set('origem', $_POST['origem']);
        $viagem->__set('destino', $_POST['destino']);
        $viagem->__set('horaOrigem', $_POST['horaOrigem']);
        $viagem->__set('horaDestino', $_POST['horaDestino']);
        $viagem->__set('dataOrigem', $_POST['dataOrigem']);
        $viagem->__set('valorPassagem', $_POST['valorPassagem']);
        $viagem->__set('nrPoltrona', $_POST['nrPoltrona']);

        $viagem->salvar();

        header('Location: /perfilCompanhia');
    }

    public function getViagem(){
        

              


    }

}



?>