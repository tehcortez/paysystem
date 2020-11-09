<?php
namespace Usuario\V1\Rest\UsuarioPadrao;

use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class UsuarioPadraoMapperFactory
{

    public function __invoke($services)
    {
        $dbAdapter = $services->get('DB/dbsqlite');
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new UsuarioPadraoEntity);
        $tableGateway = new TableGateway(
            'usuario',
            $dbAdapter,
            null,
            $resultSetPrototype
        );
        return new UsuarioPadraoMapper($tableGateway);
    }
}
