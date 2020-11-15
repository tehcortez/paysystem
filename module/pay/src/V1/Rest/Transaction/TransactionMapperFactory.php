<?php
namespace pay\V1\Rest\Transaction;

use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Usuario\V1\Rest\Lojista\LojistaMapper;
use Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoMapper;

class TransactionMapperFactory
{

    public function __invoke($services)
    {
        $dbAdapter = $services->get('DB/dbsqlite');
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new TransactionEntity);
        $tableGateway = new TableGateway(
            'transaction',
            $dbAdapter,
            null,
            $resultSetPrototype
        );
        $usuarioPadraoMapper = $services->get(UsuarioPadraoMapper::class);
        $lojistaMapper = $services->get(LojistaMapper::class);
        return new TransactionMapper($tableGateway,$usuarioPadraoMapper,$lojistaMapper);
    }
}
