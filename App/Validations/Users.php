<?php

namespace App\Validations;
use App\Helpers\Helper;

class Users
{
    private $error = [];
    private $data;

    public function __construct(array $dados_form)
    {
        $this->data = $dados_form;
        $this->data = array_map('strip_tags', $this->data);
        $this->data = array_map('trim', $this->data);
    }

    private function validId()
    {
        if(isset($this->data['id']) && empty($this->data['id'])){
            $this->error[] = "Campo <strong>Id</strong> deve ser <strong>preenchido!</strong>";
        }
    }
    private function validNome()
    {
        if(isset($this->data['nome']) && empty($this->data['nome'])){
            $this->error[] = "Campo <strong>Nome</strong> deve ser <strong>preenchido!</strong>";
        }
    }
    private function validEmail()
    {
        if(isset($this->data['email']) && empty($this->data['email'])){
            $this->error[] = "Campo <strong>E-Mail</strong> deve ser <strong>preenchido!</strong>";
        }
        if(!Helper::isMail($this->data['email'])){
            $this->error[] = "Campo <strong>E-Mail</strong> NÂO é <strong>válido!</strong>";
        }
    }

    private function validSenha()
    {
        if(isset($this->data['senha']) && empty($this->data['senha'])){
            $this->error[] = "Campo <strong>Senha</strong> deve ser <strong>preenchido!</strong>";
        }
        if(strlen($this->data['senha']) < 6){
            $this->error[] = "Campo <strong>Senha</strong> deve ter no <strong>mínimo</strong> <strong>06</strong> caracteres!";
        }
    }
    public function Erros()
    {
        $this->validId();
        $this->validNome();
        $this->validEmail();
        $this->validSenha();
        if(count($this->error) != 0){
            return true;
        }
    }
    public function getErros()
    {
        $html = '';
        foreach ($this->error as $erro){
            $html .= "<p>{$erro}</p>";
        }
        return $html;
    }
    public function getValidatedData()
    {
        return $this->data;
    }
}