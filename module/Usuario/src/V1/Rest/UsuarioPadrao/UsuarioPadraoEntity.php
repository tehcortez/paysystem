<?php
namespace Usuario\V1\Rest\UsuarioPadrao;

class UsuarioPadraoEntity
{

    function __construct()
    {
        $this->tipo = 0;
    }

    private $id;
    private $nome;
    private $cpf;
    private $email;
    private $senha;
    private $tipo;
    private $carteira;

    function getId()
    {
        return $this->id;
    }

    function getNome()
    {
        return $this->nome;
    }

    function getCpf()
    {
        return $this->cpf;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getSenha()
    {
        return $this->senha;
    }

    function getTipo()
    {
        return $this->tipo;
    }

    function getCarteira()
    {
        return $this->carteira;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNome($nome)
    {
        $this->nome = $nome;
    }

    function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setSenha($senha)
    {
        $this->senha = $senha;
    }

    function setCarteira($carteira)
    {
        $this->carteira = $carteira / 100;
    }

    public function getArrayCopy()
    {
        $data = [
            'id' => $this->getId(),
            'nome_completo' => $this->getNome(),
            'cpf' => $this->getCpf(),
//            'senha' => $this->getSenha(),
            'email' => $this->getEmail()];
        if (!is_null($this->getCarteira())) {
            $data['carteira'] = $this->getCarteira();
        }
        return $data;
    }

    public function exchangeArray(array $array)
    {
        $this->setId($array['id']);
        $this->setNome($array['nome_completo']);
        $this->setCpf($array['cpf']);
        $this->setEmail($array['email']);
        $this->setSenha($array['senha']);
        $this->setCarteira($array['carteira']);
    }
}
