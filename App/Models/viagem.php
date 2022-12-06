<?php 

namespace App\models;

use MF\Model\Model;

class Viagem extends Model{

    private $id;
    private $id_Companhia;
    private $origem;
    private $destino;
    private $horaOrigem;
    private $horaDestino;
    private $dataOrigem;
    private $dataDestino;
    private $valorPassagem;
    private $nrPoltrona;
    private $dataCriacao;

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    public function salvar(){
        $query = "insert into viagens( id_Companhia, origem, destino, horaOrigem, horaDestino, dataOrigem, valorPassagem, nrPoltrona)values
        ( :id_Companhia, :origem, :destino, :horaOrigem, :horaDestino, :dataOrigem, :valorPassagem, :nrPoltrona)";

        $stmt = $this->db->prepare($query);
        $stmt -> bindValue(':id_Companhia', $this->__get('id_Companhia'));
        $stmt -> bindValue(':origem', $this->__get('origem'));
        $stmt -> bindValue(':destino', $this->__get('destino'));
        $stmt -> bindValue(':horaOrigem', $this->__get('horaOrigem'));
        $stmt -> bindValue(':horaDestino', $this->__get('horaDestino'));
        $stmt -> bindValue(':dataOrigem', $this->__get('dataOrigem'));
        $stmt -> bindValue(':valorPassagem', $this->__get('valorPassagem'));
        $stmt -> bindValue(':nrPoltrona', $this->__get('nrPoltrona'));
        $stmt->execute();
        return $this;
    }

    public function getAll(){

        $query = "select id, id_Companhia, origem, destino,  from viagens";
    }


}



?>