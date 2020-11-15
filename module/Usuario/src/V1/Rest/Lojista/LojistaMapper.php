<?php
namespace Usuario\V1\Rest\Lojista;

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
            'senha' => $usuario->getSenha(),
            'tipo' => $usuario->getTipo(),
            'carteira' => $usuario->getCarteira()
        ];
        $data['carteira'] = $usuario->getCarteira();

        $id = (int) $usuario->getId();

        if ($id == 0) {
            $usuarioExistente = $this->fetchByCnpj($usuario->getCnpj());
            if ($usuarioExistente !== null) {
                return ['code' => '409',
                    'error' => 'Usuario com mesmo CPF ja cadastrado'];
            }
            $usuarioExistente = $this->fetchByEmail($usuario->getEmail());
            if ($usuarioExistente !== null) {
                return ['code' => '409',
                    'error' => 'Usuario com mesmo e-mail ja cadastrado'];
            }
//                    var_dump($data);die;
            $res = $this->tg->insert($data);
            $usuario->setId($this->tg->lastInsertValue);
            var_dump($usuario);
            die;
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

    public function saveInsert(LojistaEntity $usuario)
    {
        $data = $usuario->getArrayCopy();
        $data['senha'] = $usuario->getSenha();
        if (!isset($data['carteira'])) {
            $data['carteira'] = 0;
        } else {
            $data['carteira'] = $data['carteira'] * 100;
        }
        $data['cpf'] = $data['cnpj'];
        unset($data['cnpj']);

        $usuarioExistente = $this->fetchByCnpj($usuario->getCnpj());
        if ($usuarioExistente instanceof LojistaEntity) {
            return ['code' => '409',
                'error' => 'Usuario com mesmo CPF ja cadastrado'];
        }
        $usuarioExistente = $this->fetchByEmail($usuario->getEmail());
        if ($usuarioExistente instanceof LojistaEntity) {
            return ['code' => '409',
                'error' => 'Usuario com mesmo e-mail ja cadastrado'];
        }
        $this->tg->insert($data);
        $usuario->setId($this->tg->lastInsertValue);
        return $usuario;
    }

    public function saveUpdate(LojistaEntity $usuario)
    {
        $data = $usuario->getArrayCopy();
        $id = (int) $usuario->getId();
        $originUsuario = $this->fetch($id);
        if ($originUsuario instanceof LojistaEntity) {
            $usuarioExistente = $this->fetchByCnpj($usuario->getCnpj());
            if ($usuarioExistente instanceof LojistaEntity) {
                if ($usuarioExistente->getId() != $usuario->getId()) {
                    return ['code' => '409',
                        'error' => 'Outro usuario com mesmo CPF ja cadastrado'];
                }
            }
            $usuarioExistente = $this->fetchByEmail($usuario->getEmail());
            if ($usuarioExistente instanceof LojistaEntity) {
                if ($usuarioExistente->getId() != $usuario->getId()) {
                    return ['code' => '409',
                        'error' => 'Outro usuario com mesmo e-mail ja cadastrado'];
                }
            }
            if (is_null($usuario->getCarteira())) {
                $usuario->setCarteira($originUsuario->getCarteira() * 100);
            } else {
                $data['carteira'] = $data['carteira'] * 100;
            }
            $data['cpf'] = $data['cnpj'];
            unset($data['cnpj']);

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
