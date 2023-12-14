<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $usersModel =  new \App\Models\UsersModel();
        $getAllUser = $usersModel->getAllUsers();
        // var_dump($getAllUser);
        return view('index', ['usuarios' => $getAllUser]);
    }

    public function insertUser()
    {
        $usersModel =  new \App\Models\UsersModel();
        $senha = hash('md5', $_POST['senha']);
        $resultado = $usersModel->insertUser($_POST, $senha);
        $getAllUser = $usersModel->getAllUsers();
        $session = session();
        if($resultado) {
            $session->setFlashdata(['status' => "sucesso"]);
            return view('index', ['usuarios' => $getAllUser]);
        }
        $session->setFlashdata(['status' => "error"]);
        return view('index', ['usuarios' => $getAllUser]);

    }

    public function deleteUser($id)
    {
        $usersModel =  new \App\Models\UsersModel();
        $resultado = $usersModel->deleteDatesUser($id);
        $getAllUser = $usersModel->getAllUsers();
        $session = session();
        if($resultado) {
            $session->setFlashdata(['status' => "delete"]);
            return view('index', ['usuarios' => $getAllUser]);
        }
        $session->setFlashdata(['status' => "notdelete"]);
        return view('index', ['usuarios' => $getAllUser]);
    }

    public function screenUpdateUser($id)
    {
        $usersModel =  new \App\Models\UsersModel();
        $getDateUser = $usersModel->getOneUser($id);
        // var_dump($getDateUser);
        return view('editar', ["usuario" => $getDateUser]);
    }

    public function updateUser()
    {
        $usersModel =  new \App\Models\UsersModel();
        $senha = hash('md5', $_POST['senha']);
        $res = $usersModel->updateAllDatesUser($_POST, $senha);
        // var_dump($res);
        $session = session();
        if($res) {
            $getAllUser = $usersModel->getAllUsers();
            return view('index', ["usuarios" => $getAllUser]);
        }
        $getDateUser = $usersModel->getOneUser($_POST['id']);
        $session->setFlashdata(['status' => "error"]);
        return view('editar', ["usuario" => $getDateUser]);
    }
}
