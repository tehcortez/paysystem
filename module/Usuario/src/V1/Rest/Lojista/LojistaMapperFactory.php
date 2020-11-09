<?php
namespace Usuario\V1\Rest\Lojista;

use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class LojistaMapperFactory
{

    public function __invoke($services)
    {
        $dbAdapter = $services->get('DB/dbsqlite');
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new LojistaEntity);
        $tableGateway = new TableGateway(
            'usuario',
            $dbAdapter,
            null,
            $resultSetPrototype
        );
        return new LojistaMapper($tableGateway);
    }
}
