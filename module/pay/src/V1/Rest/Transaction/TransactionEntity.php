<?php
namespace pay\V1\Rest\Transaction;

use Exception;
use Usuario\V1\Rest\Lojista\LojistaEntity;
use Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoEntity;

class TransactionEntity
{

    private $id;
    private $value;
    private $payer;
    private $payee;
    private $autorizadorExterno;
    
    function __construct(\pay\Service\AutorizadorExternoService $autorizadorExterno)
    {
        $this->autorizadorExterno = $autorizadorExterno;
    }

        function getId()
    {
        return $this->id;
    }

    function getValue()
    {
        return $this->value;
    }

    function getPayer()
    {
        return $this->payer;
    }

    function getPayee()
    {
        return $this->payee;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setValue($value)
    {
        $this->value = $value;
    }

    function setPayer($payer)
    {
        if ($payer instanceof UsuarioPadraoEntity) {
            $this->payer = $payer;
        } else {
            throw new Exception('Payer tem que ser do tipo usuario padrao');
        }
    }

    function setPayee($payee)
    {
        if (($payee instanceof LojistaEntity) ||
            ($payee instanceof UsuarioPadraoEntity)) {
            $this->payee = $payee;
        } else {
            throw new Exception('Payee tem que ser do tipo usuario padrao ou lojista');
        }
    }

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'value' => $this->getNome(),
            'payer' => $this->getPayer(),
            'payee' => $this->getPayee()
        );
    }

    public function exchangeArray(array $array)
    {
        $this->setId($array['id']);
        $this->setValue($array['value']);
        $this->setPayer($array['payer']);
        $this->setPayee($array['payee']);
    }

    public function transfer()
    {
        if($this->getPayer()->getCarteira() < $this->value){
            return ['error'=>'saldo insuficiente'];
        }
        if($this->autorizadorExterno->autorizado($this->getValue())){
            return ['error'=>'não autorizado por serviço autorizador externo'];
        }
        
    }
}
