<?php
namespace pay\V1\Rest\Transaction;

use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use Usuario\V1\Rest\Lojista\LojistaEntity;
use Usuario\V1\Rest\Lojista\LojistaMapper;
use Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoEntity;
use Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoMapper;

class TransactionResource extends AbstractResourceListener
{
    private $mapper;
    private $usuarioPadraoMapper;
    private $lojistaMapper;

    public function __construct(
        TransactionMapper $mapper, 
        UsuarioPadraoMapper $usuarioPadraoMapper, 
        LojistaMapper $lojistaMapper)
    {
        $this->mapper = $mapper;
        $this->usuarioPadraoMapper = $usuarioPadraoMapper;
        $this->lojistaMapper = $lojistaMapper;
    }
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $payer = $this->usuarioPadraoMapper->fetch($data->payer);
        if (!($payer instanceof UsuarioPadraoEntity)) {
            return new ApiProblem(404, 'Id ' . $data->payer . ' não é de um usuário padrão ou não existe');
        }
        $payee = $this->usuarioPadraoMapper->fetch($data->payee);
        if (!($payee instanceof UsuarioPadraoEntity)) {
            $payee = $this->lojistaMapper->fetch($data->payee);
            if (!($payee instanceof LojistaEntity)) {
                return new ApiProblem(404, 'Id ' . $data->payee . ' não existe');
            }
        }
        $transaction = new TransactionEntity();
        $transaction->setValue($data->value);
        $transaction->setPayerId($data->payer);
        $transaction->setPayeeId($data->payee); 
        $retorno = $this->mapper->transfer($transaction);
        if ($retorno instanceof TransactionEntity) {
            return $retorno;
        }
        if (is_array($retorno)) {
            if (isset($retorno['error'])) {
                return new ApiProblem($retorno['code'], $retorno['error']);
            }
        }
        return new ApiProblem(422, 'Unprocessable Entity');
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
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
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
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
        return new ApiProblem(405, 'The GET method has not been defined for collections');
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
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
