<?php
namespace Usuario;

use Laminas\ApiTools\Provider\ApiToolsProviderInterface;
use Usuario\V1\Rest\Lojista\LojistaMapper;
use Usuario\V1\Rest\Lojista\LojistaMapperFactory;
use Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoMapper;
use Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoMapperFactory;

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
                UsuarioPadraoMapper::class => UsuarioPadraoMapperFactory::class,
                LojistaMapper::class => LojistaMapperFactory::class
            )
        );
    }
}
