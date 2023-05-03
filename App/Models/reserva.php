<?php 

namespace App\models;

use MF\Model\Model;

class Reserva extends Model{

    private $id;
    private $id_viagem	;
    private $id_passageiro;
    private $qte_passagem;

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    public function salvar(){
        $query = "insert into reserva( id_viagem, id_passageiro, qte_passagem)values
        (:id_viagem, :id_passageiro, :qte_passagem)";

        $stmt = $this->db->prepare($query);
        $stmt -> bindValue(':id_viagem', $this->__get('id_viagem'));
        $stmt -> bindValue(':id_passageiro', $this->__get('id_passageiro'));
        $stmt -> bindValue(':qte_passagem', $this->__get('qte_passagem'));
        
        $stmt->execute();
        return $this;
    }
    

    // public function getAll(){

    //     $query = "
    //         select 
    //             u.id, 
    //             u.id_Companhia,
    //             u.origem, 
    //             u.destino,
    //             u.horaOrigem,
    //             DATE_FORMAT(u.dataOrigem, '%d/%m/%Y') as dataOrigem, 
    //             t.razao
    //         from 
    //             viagens as u
    //             left join companhia as t on (u.id_Companhia = t.id) 
    //         where 
    //             id_Companhia = :id_Companhia";

    //     $stmt = $this->db->prepare($query);
	// 	$stmt->bindValue(':id_Companhia', $this->__get('id_Companhia'));
	// 	$stmt->execute();

    //     return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    // }
    //Desfazer reserva
    public function apagarViagem(){

        $query = "DELETE from viagens where id_Companhia = :id_Companhia and id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_Companhia', $this->__get('id_Companhia'));
        $stmt->bindValue(':id', $this->__get('id'));

        $stmt->execute();

        return true;

    }
   
}



?>