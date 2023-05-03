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

        $query = "
            select 
                u.id, 
                u.id_Companhia,
                u.origem, 
                u.destino,
                u.horaOrigem,
                DATE_FORMAT(u.dataOrigem, '%d/%m/%Y') as dataOrigem, 
                t.razao
            from 
                viagens as u
                left join companhia as t on (u.id_Companhia = t.id) 
            where 
                id_Companhia = :id_Companhia";

        $stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_Companhia', $this->__get('id_Companhia'));
		$stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    //apagar viagem
    public function apagarViagem(){

        $query = "DELETE from viagens where id_Companhia = :id_Companhia and id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_Companhia', $this->__get('id_Companhia'));
        $stmt->bindValue(':id', $this->__get('id'));

        $stmt->execute();

        return true;

    }
    // pesquisa viagem
    public function pesquisarViagem(){

        $query = "select 
            id, 
            id_Companhia,
            origem, 
            destino,
            horaOrigem
        from 
            viagens 
        where 
            origem = :origem
        and 
            destino = :destino";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':origem', $this->__get('origem'));
        $stmt->bindValue(':destino', $this->__get('destino'));

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);


    }

    //Buscar id
    public function getId(){
        $query = "
            Select 
                *
            from 
                viagens
            where
                id_Companhia = :id_Companhia
            and
                id = :id
        ";
        $stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_Companhia', $this->__get('id_Companhia'));
        $stmt->bindValue(':id', $this->__get('id'));
        // echo $query;
        // die();
		$stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
    //editar Viagem
    public function editarViagem(){
        $query = "
            UPDATE
                `viagens` 
            set 
                origem = :origem, 
                destino = :destino, 
                horaOrigem = :horaOrigem, 
                horaDestino = :horaDestino, 
                dataOrigem = :dataOrigem, 
                horaDestino = :horaDestino, 
                valorPassagem = :valorPassagem, 
                nrPoltrona = :nrPoltrona 
            where
                id_Companhia = :id_Companhia
            and
                id = :id
        ";

        $stmt = $this->db->prepare($query);
        $stmt -> bindValue(':id_Companhia', $this->__get('id_Companhia'));
        $stmt->bindValue(':id', $this->__get('id'));
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


}



?>