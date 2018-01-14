<?php

namespace App\Models;

use App\Core\Model,
    App\Helpers\Helper,
    PDO;


class Users extends Model {

    private $Table = "usuarios_face";
    private $Result = null;

    public function getResult() {
        return $this->Result;
    }

    public function selectById($id) {
        $sql = $this->db->prepare("SELECT * FROM " . $this->Table ." WHERE id = :id LIMIT 1");
        $sql->bindValue(":id",$id,PDO::PARAM_INT);
        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $this->Result = $sql->fetch();
                return true;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function selectByEmail($email) {
        $sql = $this->db->prepare("SELECT * FROM " . $this->Table ." WHERE email = :email LIMIT 1");
        $sql->bindValue(":email",$email,PDO::PARAM_STR);
        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $this->Result = $sql->fetch();
                return true;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function LoginCreate($dados_form) {
        $sql = $this->db->prepare("INSERT INTO " . $this->Table . " 
        (id,nome,email,senha) 
        VALUES 
        (:id,:nome,:email,:senha)
        ");
        if(isset($dados_form['id'])){
            $id = $dados_form['id'];
        }else{
            $id = null;
        }
        $sql->bindValue(":id",$id,PDO::PARAM_STR);
        $sql->bindValue(":nome",$dados_form['nome'],PDO::PARAM_STR);
        $sql->bindValue(":email",$dados_form['email'],PDO::PARAM_STR);
        $sql->bindValue(":senha",password_hash($dados_form['senha'],PASSWORD_BCRYPT),PDO::PARAM_STR);
        try {
            $sql->execute();
            if ($sql->rowCount() == 1) {
                $this->Result = $this->db->lastInsertId();
                return true;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function UpdateLoginFacebook($dados_form){
        $sql = $this->db->prepare("UPDATE " . $this->Table . " SET 
        id = :id,nome = :nome,picture = :picture 
        WHERE email = :email");
        $sql->bindValue(":id",$dados_form['id'],PDO::PARAM_STR);
        $sql->bindValue(":nome",$dados_form['nome'],PDO::PARAM_STR);
        $sql->bindValue(":picture",$dados_form['picture'],PDO::PARAM_STR);
        $sql->bindValue(":email",$dados_form['email'],PDO::PARAM_STR);
        try {
            $sql->execute();
                return true;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function login($dados_form)
    {
        if($this->selectByEmail($dados_form['email'])){
            $passwordBD = $this->getResult()['senha'];
            if(password_verify($dados_form['senha'],$passwordBD)){
                $_SESSION['nome'] = $this->getResult()['nome'];
                $_SESSION['email'] = $this->getResult()['email'];
                $_SESSION['picture'] = $this->getResult()['picture'];
                return true;
            }
        }
    }

    public function isLoged(){
        if((isset($_SESSION['face_access_token']) &&
        !empty($_SESSION['face_access_token'])) ||
            (isset($_SESSION['email']) &&
        !empty($_SESSION['email']))){
            return true;
        }
    }


}
