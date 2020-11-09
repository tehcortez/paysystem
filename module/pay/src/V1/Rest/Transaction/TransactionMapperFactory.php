<?php
namespace pay\V1\Rest\Transaction;

use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

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
        return new TransactionMapper($tableGateway);
    }
}
