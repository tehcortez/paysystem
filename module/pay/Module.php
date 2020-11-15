<?php
namespace pay;

use Laminas\ApiTools\Provider\ApiToolsProviderInterface;
use pay\V1\Rest\Transaction\TransactionEntity;
use pay\V1\Rest\Transaction\TransactionEntityFactory;
use pay\V1\Rest\Transaction\TransactionMapper;
use pay\V1\Rest\Transaction\TransactionMapperFactory;

class Module implements ApiToolsProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'Laminas\ApiTools\Autoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                TransactionMapper::class => TransactionMapperFactory::class
            )
        );
    }
}
