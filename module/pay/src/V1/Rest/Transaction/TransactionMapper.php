<?php
namespace pay\V1\Rest\Transaction;

use Exception;
use Laminas\Db\TableGateway\TableGateway;

class TransactionMapper
{

    protected $tg;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tg = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tg->select();
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

    public function save(LojistaEntity $usuario)
    {
        $data = [
            'nome_completo' => $usuario->getNome(),
            'cnpj' => $usuario->getCnpj(),
            'email' => $usuario->getEmail(),
            'senha' => $usuario->getSenha()
        ];

        $id = (int) $usuario->getId();

        if ($id == 0) {
            $res = $this->tg->insert($data);
            $usuario->setId($this->tg->lastInsertValue);
            return $usuario;
        } else {
            if ($this->fetch($id) instanceof LojistaEntity) {
                $this->tg->update($data, ['id' => $id]);
                return $usuario;
            } else {
                return null;
            }
        }
    }

    public function delete($id)
    {
        return $this->tg->delete(['id' => (int) $id]);
    }
}
