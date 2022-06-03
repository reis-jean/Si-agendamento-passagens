<?php 

namespace App\models;

use MF\Model\Model;

class Companhia extends Model{

    private $id;
    private $razao;
    private $email;
    private $senha;
    private $cnpj;

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo =$valor;
    }

    public function salvar(){
        $query = "insert into companhia(razao, cnpj, email, senha)values(:razao, :cnpj, :email, :senha)";
        $stmt = $this->db->prepare($query);
        $stmt -> bindValue(':razao', $this->__get('razao'));
        $stmt -> bindValue(':email', $this->__get('email'));
        $stmt -> bindValue(':senha', $this->__get('senha'));
        $stmt -> bindValue(':cnpj', $this->__get('cnpj'));
        $stmt->execute();

        return $this;
    }

    public function validarCadastro(){
        
        $valido = true;

        if(strlen($this->__get('senha' )) < 3){
            $valido = false;
        }

        if(strlen($this->__get('email')) < 3){
            $valido = false;
        }

        if(strlen($this->__get('cnpj')) < 3){
            $valido = false;
        }

        return $valido;

    }

    public function getCompanhiaPorEmail(){
        
        //faz a recuperação do por email 
        
        $query = "select razao, email from companhia where email = :email";
        $stmt = $this->db->prepare($query);
        $stmt ->bindValue(':email', $this->__get('email'));
        $stmt -> execute();        
        
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

      
    }


}

