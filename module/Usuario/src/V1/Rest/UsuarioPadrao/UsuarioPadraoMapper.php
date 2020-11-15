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
        $resultSet = $this->tg->select(['tipo' => 0]);
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
        $resultSet = $this->tg->select(['cpf' => $cpf]);
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

    public function saveInsert(UsuarioPadraoEntity $usuario)
    {
        $data = $usuario->getArrayCopy();
        $data['senha'] = $usuario->getSenha();
        if (!isset($data['carteira'])) {
            $data['carteira'] = 0;
        }else {
            $data['carteira'] = $data['carteira']*100;
        }
        
        $usuarioExistente = $this->fetchByCpf($usuario->getCpf());
        if ($usuarioExistente instanceof UsuarioPadraoEntity) {
            return ['code' => '409',
                'error' => 'Usuario com mesmo CPF ja cadastrado'];
        }
        $usuarioExistente = $this->fetchByEmail($usuario->getEmail());
        if ($usuarioExistente instanceof UsuarioPadraoEntity) {
            return ['code' => '409',
                'error' => 'Usuario com mesmo e-mail ja cadastrado'];
        }
        $this->tg->insert($data);
        $usuario->setId($this->tg->lastInsertValue);
        return $usuario;
    }

    public function saveUpdate(UsuarioPadraoEntity $usuario)
    {
        $data = $usuario->getArrayCopy();
        $id = (int) $usuario->getId();
        $originUsuario = $this->fetch($id);
        if ($originUsuario instanceof UsuarioPadraoEntity) {
            $usuarioExistente = $this->fetchByCpf($usuario->getCpf());
            if ($usuarioExistente instanceof UsuarioPadraoEntity) {
                if ($usuarioExistente->getId() != $usuario->getId()) {
                    return ['code' => '409',
                        'error' => 'Outro usuario com mesmo CPF ja cadastrado'];
                }
            }
            $usuarioExistente = $this->fetchByEmail($usuario->getEmail());
            if ($usuarioExistente instanceof UsuarioPadraoEntity) {
                if ($usuarioExistente->getId() != $usuario->getId()) {
                    return ['code' => '409',
                        'error' => 'Outro usuario com mesmo e-mail ja cadastrado'];
                }
            }
            if (is_null($usuario->getCarteira())) {
                $usuario->setCarteira($originUsuario->getCarteira() * 100);
            } else {
                $data['carteira'] = $data['carteira']*100;
            }

            $this->tg->update($data, ['id' => $id]);

            return $usuario;
        } else {
            return ['code' => '404',
                'error' => 'Id ' . $id . ' não é de um usuário padrão ou não existe'];
        }
    }

    public function delete($id)
    {
        return $this->tg->delete(['id' => (int) $id]);
    }
}
