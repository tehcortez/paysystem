<?php
namespace Usuario\V1\Rest\Lojista;

use Exception;
use Laminas\Db\TableGateway\TableGateway;

class LojistaMapper
{

    protected $tg;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tg = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tg->select(['tipo' => 1]);
        return $resultSet;
    }

    public function fetch($id)
    {
        $id = (int) $id;
        $resultSet = $this->tg->select(['tipo' => 1, 'id' => $id]);
        $row = $resultSet->current();

        if (!$row) {
            return null;
        }
        return $row;
    }

    public function fetchByCnpj($cnpj)
    {
        $resultSet = $this->tg->select(['cpf' => $cnpj]);
        $row = $resultSet->current();

        if (!$row) {
            return null;
        }
        return $row;
    }

    public function fetchByEmail($email)
    {
        $resultSet = $this->tg->select(['email' => $email]);
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
            'cpf' => $usuario->getCnpj(),
            'email' => $usuario->getEmail(),
            'senha' => $usuario->getSenha()
        ];

        $id = (int) $usuario->getId();

        if ($id == 0) {
            $usuarioExistente = $this->fetchByCnpj($usuario->getCnpj());
            if (null !== $usuarioExistente) {
                return ['error'=>'CNPJ ja existe na base de dados'];
            }
            $usuarioExistente = $this->fetchByEmail($usuario->getEmail());
            if (null !== $usuarioExistente) {
                return ['error'=>'E-mail ja existe na base de dados'];
            }
//                    var_dump($data);die;
            $res = $this->tg->insert($data);
            $usuario->setId($this->tg->lastInsertValue);
            var_dump($usuario);die;
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
