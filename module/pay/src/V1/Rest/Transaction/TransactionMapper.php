<?php
namespace pay\V1\Rest\Transaction;

use Laminas\Db\TableGateway\TableGateway;
use Usuario\V1\Rest\Lojista\LojistaEntity;
use Usuario\V1\Rest\Lojista\LojistaMapper;
use Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoEntity;
use Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoMapper;

class TransactionMapper
{

    protected $tg;
    private $usuarioPadraoMapper;
    private $lojistaMapper;

    public function __construct(
        TableGateway $tableGateway,
        UsuarioPadraoMapper $usuarioPadraoMapper,
        LojistaMapper $lojistaMapper)
    {
        $this->tg = $tableGateway;
        $this->usuarioPadraoMapper = $usuarioPadraoMapper;
        $this->lojistaMapper = $lojistaMapper;
    }

    public function fetchAll()
    {
        $resultSet = $this->tg->select();
//        foreach($resultSet as $result){
//            var_dump($result);
//        }
//        die;
//        var_dump($resultSet);die;
        return $resultSet;
    }

    public function fetch($id)
    {
        $id = (int) $id;
        $resultSet = $this->tg->select(['id' => $id]);
        $row = $resultSet->current();

        if (!$row) {
            return null;
        }
        return $row;
    }

    public function transfer(TransactionEntity $transaction)
    {
        $data = $transaction->getArrayCopy();
        $payer = $this->usuarioPadraoMapper->fetch($data['payer']);
        if (!($payer instanceof UsuarioPadraoEntity)) {
            return ['code' => '404',
                'error' => 'Payer com id ' . $data['payer'] . ' não é de um usuário padrão ou não existe'];
//            return new ApiProblem(404, 'Payer com id ' . $data->payer . ' não é de um usuário padrão ou não existe');
        }
        $payee = $this->usuarioPadraoMapper->fetch($data['payee']);
        if (!($payee instanceof UsuarioPadraoEntity)) {
            $payee = $this->lojistaMapper->fetch($data['payee']);
            if (!($payee instanceof LojistaEntity)) {
                return ['code' => '404',
                'error' => 'Id ' . $data['payee'] . ' não existe'];
//                return new ApiProblem(404, 'Id ' . $data->payer . ' não existe');
            }
        }
        $transaction->setPayerObj($payer);
        $transaction->setPayeeObj($payee);
        $transaction->transfer();
        $payer->setCarteira(($payer->getCarteira()*100) - ($transaction->getValue()*100));
        $payer = $this->usuarioPadraoMapper->saveUpdate($payer);
        try{
            $payee->setCarteira(($payee->getCarteira()*100) + ($transaction->getValue()*100));
            if ($payee instanceof UsuarioPadraoEntity) {
                $payee = $this->usuarioPadraoMapper->saveUpdate($payee);
            }
            if ($payee instanceof LojistaEntity) {
                $payee = $this->lojistaMapper->saveUpdate($payee);
            }
        } catch(\Throwable $e) {
            $payer->setCarteira(($payer->getCarteira()*100) + ($transaction->getValue()*100));
            $payer = $this->usuarioPadraoMapper->saveUpdate($payer);
            return ['code' => '422',
                'error' => 'Erro ao depositar valor no destinatário.'];
        }
        $this->tg->insert($data);
        $transaction->setId($this->tg->lastInsertValue);
        $transaction->envioDeMensagem();
        return $transaction;
    }
}
