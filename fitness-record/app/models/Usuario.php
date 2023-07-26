<?php

namespace models;

class Usuario extends Model {

    protected $table = "usuarios";
    #nao esqueça da ID
    protected $fields = ["id","id_login","objetivo","endereco","celular","situacao","condicao"];
    public function all(){
        $sql = "SELECT usuarios.*, logins.nome as nome, logins.dataNascimento as dataNascimento FROM usuarios
        LEFT JOIN logins ON logins.id = usuarios.id_login; ";
        $stmt = $this->pdo->prepare($sql);
        
        if ($stmt == false){
            $this->showError($sql);
        }
        $stmt->execute();
        $list = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($list,$row);
        }
        return $list;
    }


}

