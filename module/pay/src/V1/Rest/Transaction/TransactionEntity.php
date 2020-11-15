<?php
namespace pay\V1\Rest\Transaction;

use pay\Service\AutorizadorExternoService;

class TransactionEntity
{

    private $id;
    private $value;
    private $payerId;
    private $payeeId;
    private $payerObj;
    private $payeeObj;
    private $autorizadorExterno;

    function __construct()
    {
        $this->autorizadorExterno = new AutorizadorExternoService();
    }

    function getId()
    {
        return $this->id;
    }

    function getValue()
    {
        return $this->value;
    }
    
    function getPayerId()
    {
        return $this->payerId;
    }

    function getPayeeId()
    {
        return $this->payeeId;
    }

    function getPayerObj()
    {
        return $this->payerObj;
    }

    function getPayeeObj()
    {
        return $this->payeeObj;
    }
    
    function setId($id)
    {
        $this->id = $id;
    }

    function setValue($value)
    {
        $this->value = $value;
    }

    function setPayerId($payerId)
    {
        $this->payerId = $payerId;
    }

    function setPayeeId($payeeId)
    {
        $this->payeeId = $payeeId;
    }

    function setPayerObj($payerObj)
    {
        if ($payerObj instanceof UsuarioPadraoEntity) {
            $this->$payerObj = $payerObj;
        } else {
            throw new Exception('Payer tem que ser do tipo usuario padrao');
        }
    }

    function setPayeeObj($payeeObj)
    {
        if (($payeeObj instanceof LojistaEntity) ||
            ($payeeObj instanceof UsuarioPadraoEntity)) {
            $this->$payeeObj = $payeeObj;
        } else {
            throw new Exception('Payee tem que ser do tipo usuario padrao ou lojista');
        }
    }
    
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'value' => $this->getValue(),
            'payer' => $this->getPayerId(),
            'payee' => $this->getPayeeId()
        );
    }

    public function exchangeArray(array $array)
    {
        $this->setId($array['id']);
        $this->setValue($array['value']);
        $this->setPayerId($array['payer']);
        $this->setPayeeId($array['payee']);
    }

    public function transfer()
    {
        echo 'etanois';die;
        if ($this->getPayerObj()->getCarteira() < $this->value) {
            throw new Exception('saldo insuficiente');
        }
        if ($this->autorizadorExterno->autorizado()) {
            throw new Exception('não autorizado por serviço autorizador externo');
        }
    }
}
