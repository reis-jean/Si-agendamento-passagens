<?php
namespace App\Controllers;

use App\models\Viagem;
use MF\Controller\Action;
use MF\Model\Container as ModelContainer;
use MF\Model\Model;

class AppController extends Action{

    public function perfilCompanhia(){
        
        session_start();

        $this->view->mensagemEdicao  = isset($_GET['mensagemEdicao']) ? $_GET['mensagemEdicao'] : '';

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

        session_start();

        $viagem = ModelContainer::getModel('Viagem');

        $viagem->__set('origem', $_POST['origem']);
        $viagem->__set('destino', $_POST['destino']);

        $viagens = $viagem ->pesquisarViagem();

        $this->view->viagens = $viagens;
        
        $this->render('perfil');
        
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

    public function EditarViagemPag(){
        
        session_start();
        
        $viagem = ModelContainer::getModel("Viagem");
        $viagem->__set('id_Companhia', $_SESSION['id']);
        $viagem->__set('id', $_GET['id']);

        $dadosViagem = $viagem->getId();
        $this->view->dadosViagem = $dadosViagem;

        $this->render('editarViagem');
    }

    public function EditarViagem(){

        session_start();

        $viagem = ModelContainer::getModel("Viagem");

        $viagem-> __set('id_Companhia', $_SESSION['id']);
        $viagem-> __set('id', $_GET['id']);        
        $viagem->__set('origem', $_POST['origem']);
        $viagem->__set('destino', $_POST['destino']);
        $viagem->__set('horaOrigem', $_POST['horaOrigem']);
        $viagem->__set('horaDestino', $_POST['horaDestino']);
        $viagem->__set('dataOrigem', $_POST['dataOrigem']);
        $viagem->__set('valorPassagem', $_POST['valorPassagem']);
        $viagem->__set('nrPoltrona', $_POST['nrPoltrona']);

        $viagem->editarViagem();


        header('Location: /perfilCompanhia?mensagemEdicao=editado');

    }

    public function apagarViagem(){

        session_start();

        $viagem = ModelContainer::getModel("Viagem");

        $viagem-> __set('id_Companhia', $_SESSION['id']);
        $viagem-> __set('id', $_GET['id']);

        $viagem->apagarViagem();
         
        header('Location: /perfilCompanhia?mensagemEdicao=apagado');

    }

    public function reservarViagem(){

        $this->validarAutenticacao();
        
        $viagem = ModelContainer::getModel('Viagem');

        $viagem->__set('id', $_GET['id']);
        $viagem->__set('id_Companhia', $_GET['id_Companhia']);

        $this->view->viagem = $viagem->getId();

        $this->render('reservarViagem');
    }

    public function minhasViagens(){

        $this->validarAutenticacao();

        $reserva = ModelContainer::getModel('Reserva');

        $reserva ->__set('id_passageiro', $_SESSION['id']);
        $reserva ->getAll();

        $reservas = $reserva ->getAll();
        $this->view->reservas = $reservas;
                   
        
        $this->render('minhasViagens');
    }

    public function cadastrarReserva(){

        $this->validarAutenticacao();

        $viagem = ModelContainer::getModel('Viagem');
        $viagem->__set('id_Companhia', $_GET['id_Companhia']);
        $viagem->__set('id', $_GET['id']);

        
        $dadosViagem = $viagem->getId();
        $this->view->dadosViagem = $dadosViagem;


 

        $reserva = ModelContainer::getModel('Reserva');

        $reserva ->__set('id_viagem', $dadosViagem[0]['id']);
        $reserva->__set('id_passageiro', $_SESSION['id']);
        $reserva->__set('qte_passagem', $_POST['qte_passagem']);
        $reserva->__set('id_Companhia', $dadosViagem[0]['id_Companhia']);
        $reserva->__set('origem', $dadosViagem[0]['origem']);
        $reserva->__set('destino', $dadosViagem[0]['destino']);
        $reserva->__set('horaOrigem', $dadosViagem[0]['horaOrigem']);
        $reserva->__set('HoraDestino', $dadosViagem[0]['HoraDestino']);
        $reserva->__set('dataOrigem', $dadosViagem[0]['dataOrigem']);
        $reserva->__set('valorPassagem', $dadosViagem[0]['valorPassagem']);
        

        $dadosReserva = $reserva->salvarReserva();

        
        $this->render('perfil');


    }



}



?>