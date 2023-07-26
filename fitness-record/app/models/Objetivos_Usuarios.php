<?php

namespace models;

class Objetivos_Usuarios extends Model {

    protected $table = "objetivos_usuarios";
    #nao esqueça da ID
    protected $fields = ["id_usuario","id_objetivo"];
    public function delete($id){
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id_usuario = :id");
        $stmt->execute(["id"=>$id]);

        if ($stmt == false){
            $this->showError($sql, $values);
        }

        return true;
    }
    
}

