<?php 

namespace App\models;

use MF\Model\Model;

class Reserva extends Model{

    private $id;
    private $id_viagem	;
    private $id_passageiro;
    private $qte_passagem;
    private $origem;
    private $destino;
    private $horaOrigem;
    private $HoraDestino;
    private $valorPassagem;
    private $nrPoltrona;

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    public function salvarReserva(){
        $query = "INSERT INTO reservas (
            id_viagem, id_passageiro, qte_passagem, id_Companhia, origem, destino, horaOrigem, HoraDestino, dataOrigem, valorPassagem
        ) VALUES (
            :id_viagem, :id_passageiro, :qte_passagem, :id_Companhia, :origem, :destino, :horaOrigem, :HoraDestino, :dataOrigem, :valorPassagem
        );";
       

        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_viagem', $this->__get('id_viagem'));
        $stmt->bindValue(':id_passageiro', $this->__get('id_passageiro'));
        $stmt->bindValue(':qte_passagem', $this->__get('qte_passagem'));
        $stmt->bindValue(':id_Companhia', $this->__get('id_Companhia'));
        $stmt->bindValue(':origem', $this->__get('origem'));
        $stmt->bindValue(':destino', $this->__get('destino'));
        $stmt->bindValue(':horaOrigem', $this->__get('horaOrigem'));
        $stmt->bindValue(':HoraDestino', $this->__get('HoraDestino'));
        $stmt->bindValue(':dataOrigem', $this->__get('dataOrigem'));
        $stmt->bindValue(':valorPassagem', $this->__get('valorPassagem'));
        
        
        $stmt->execute();
        return $this;
    }
    
    
    
    public function getAll(){

        $query = "select 
            *
        from 
            reservas 
        where 
            id_passageiro = :id_passageiro";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_passageiro', $this->__get('id_passageiro'));

        $stmt->execute();


        return $stmt->fetchAll(\PDO::FETCH_ASSOC);



    }



    //Desfazer reserva


    // public function apagarViagem(){

    //     $query = "DELETE from viagens where id_Companhia = :id_Companhia and id = :id";

    //     $stmt = $this->db->prepare($query);
    //     $stmt->bindValue(':id_Companhia', $this->__get('id_Companhia'));
    //     $stmt->bindValue(':id', $this->__get('id'));

    //     $stmt->execute();

    //     return true;

    // }
   
}
?>