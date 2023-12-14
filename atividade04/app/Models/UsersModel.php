<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{

    protected $table = "users";

    public function insertUser($dados, $senha)
    {
        // Função que insere usuário
        try {
            //code...
            $db = \Config\Database::connect();
            if(count($dados) > 0) {
                $name = $dados['nome'];
                $email = $dados['email'];
                $query = "INSERT INTO users(nome, email, senha) values ('$name', '$email', '$senha');";
                if($db->query($query)) {
                    return true; // caso retorne true, os dados do usuário foi inserido
                }
            }
            return false; // caso retorne não retorne true, os dados do usuário não foi inserido
        } catch (\Throwable $th) {
            //throw $th;
            return false; // caso retorne não retorne true, os dados do usuário não foi inserido
        }
    }

    public function updateAllDatesUser($dados, $senha)
    {
        $db = \Config\Database::connect();
        $name = $dados['nome'];
        $email = $dados['email'];
        $id = $dados['id'];
        $query = "UPDATE users set nome = '$name', email = '$email', senha = '$senha' WHERE id = '$id';";
        return $db->query($query);
    }

    public function updatePasswordUser($senha)
    {
        $db = \Config\Database::connect();
        $query = "UPDATE users set senha = '$senha';";
        return $db->query($query);
    }

    public function deleteDatesUser($id)
    {
        $db = \Config\Database::connect();
        $query = "DELETE FROM users WHERE id = '$id';";
        return $db->query($query);
    }

    public function getOneUser($id)
    {
        $db = \Config\Database::connect();
        $query = "SELECT * FROM users WHERE id = '$id';";
        // return $db->query($query)->getResultArray();
        return $db->query($query)->getResultArray();
    }

    public function getAllUsers()
    {
        $db = \Config\Database::connect();
        return $this->findAll();
    }
}