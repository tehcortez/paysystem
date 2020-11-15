<?php
namespace pay\V1\Rest\Transaction;

use Usuario\V1\Rest\Lojista\LojistaMapper;
use Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoMapper;

class TransactionResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get(TransactionMapper::class);
        $usuarioPadraoMapper = $services->get(UsuarioPadraoMapper::class);
        $lojistaMapper = $services->get(LojistaMapper::class);
        return new TransactionResource($mapper,$usuarioPadraoMapper,$lojistaMapper);
    }
}
