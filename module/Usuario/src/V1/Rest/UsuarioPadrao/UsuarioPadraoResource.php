<?php
namespace Usuario\V1\Rest\UsuarioPadrao;

use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;

class UsuarioPadraoResource extends AbstractResourceListener
{

    protected $mapper;

    public function __construct(UsuarioPadraoMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $usuario = new UsuarioPadraoEntity();
        $usuario->setNome($data->nome_completo);
        $usuario->setEmail($data->email);
        $usuario->setCpf($data->cpf);
        $usuario->setSenha($data->senha);
        if (isset($data->carteira)) {
            $usuario->setCarteira($data->carteira);
        }

        $retorno = $this->mapper->saveInsert($usuario);
        if ($retorno instanceof UsuarioPadraoEntity) {
            return $retorno;
        }
        if (is_array($retorno)) {
            if (isset($retorno['error'])) {
                return new ApiProblem($retorno['code'], $retorno['error']);
            }
        }
        return new ApiProblem(422, 'Unprocessable Entity');
//        return new ApiProblem(405, 'The POST method has not been defined');
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        if ($this->mapper->delete($id)) {
            return true;
        }
        return new ApiProblem(404, 'Not possible to delete submitter with id ' . $id);
//        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return $this->mapper->fetch($id);
//        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        return $this->mapper->fetchAll();
//        return new ApiProblem(405, 'The GET method has not been defined for collections');
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        $usuario = new UsuarioPadraoEntity();
        $usuario->setId($id);
        $usuario->setNome($data->nome_completo);
        $usuario->setEmail($data->email);
        $usuario->setCpf($data->cpf);
        $usuario->setSenha($data->senha);
        if (isset($data->carteira)) {
            $usuario->setCarteira($data->carteira);
        }
        $retorno = $this->mapper->saveUpdate($usuario);
        if ($retorno instanceof UsuarioPadraoEntity) {
            return $retorno;
        }
        if (is_array($retorno)) {
            if (isset($retorno['error'])) {
                return new ApiProblem($retorno['code'], $retorno['error']);
            }
        }
        return new ApiProblem(422, 'Unprocessable Entity');
//        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
