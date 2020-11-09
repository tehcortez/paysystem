<?php
namespace Usuario\V1\Rest\UsuarioPadrao;

use Laminas\Db\TableGateway\TableGateway;

class UsuarioPadraoMapper
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
        $resultSet = $this->tg->select(['id' => $id, 'tipo' => 0]);
        $row = $resultSet->current();

        if (!$row) {
            return null;
        }
        return $row;
    }

    public function fetchByCpf($cpf)
    {
        $id = (int) $id;
        $resultSet = $this->tg->select(['cpf' => $cpf]);
        $row = $resultSet->current();

        if (!$row) {
            return null;
        }
        return $row;
    }

    public function fetchByEmail($email)
    {
        $id = (int) $id;
        $resultSet = $this->tg->select(['email' => $email]);
        $row = $resultSet->current();

        if (!$row) {
            return null;
        }
        return $row;
    }

    public function save(UsuarioPadraoEntity $usuario)
    {
        $data = [
            'nome_completo' => $usuario->getNome(),
            'cpf' => $usuario->getCpf(),
            'email' => $usuario->getEmail(),
            'senha' => $usuario->getSenha()
        ];

        $id = (int) $usuario->getId();

        if ($id == 0) {
            $usuarioExistente = $this->fetchByCpf($usuario->getCpf());
            if (null === $usuarioExistente) {
                return null;
            }
            $usuarioExistente = $this->fetchByEmail($usuario->getEmail());
            if (null === $usuarioExistente) {
                return null;
            }
            $res = $this->tg->insert($data);
            $usuario->setId($this->tg->lastInsertValue);
            return $usuario;
        } else {
            if ($this->fetch($id) instanceof UsuarioPadraoEntity) {
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
