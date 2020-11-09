<?php
namespace Usuario\V1\Rest\Lojista;

use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;

class LojistaResource extends AbstractResourceListener
{
    protected $mapper;

    public function __construct(LojistaMapper $mapper)
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
        $lojista = new LojistaEntity();
        $lojista->setNome($data->nome_completo);
        $lojista->setEmail($data->email);
        $lojista->setCnpj($data->cnpj);
        $lojista->setSenha($data->senha);
        
        $retorno = $this->mapper->save($lojista);
        if(isset($retorno['error'])){
            return new ApiProblem(400, $retorno['error']);
        }
        
        return $retorno;
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
        $lojista = new LojistaEntity();
        $lojista->setId($id);
        $lojista->setNome($data->nome_completo);
        $lojista->setEmail($data->email);
        $lojista->setCnpj($data->cnpj);
        $lojista->setSenha($data->senha);

        $retorno = $this->mapper->save($lojista);
        if(!isset($retorno)){
            return new ApiProblem(404, "Entidade com id {$id} não foi encontrada");
        }
        return $retorno;
//        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
