<?php
return [
    'service_manager' => [
        'factories' => [
            \Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoResource::class => \Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'usuario.rest.usuario-padrao' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/usuario-padrao[/:usuario_padrao_id]',
                    'defaults' => [
                        'controller' => 'Usuario\\V1\\Rest\\UsuarioPadrao\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'usuario.rest.usuario-padrao',
        ],
    ],
    'api-tools-rest' => [
        'Usuario\\V1\\Rest\\UsuarioPadrao\\Controller' => [
            'listener' => \Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoResource::class,
            'route_name' => 'usuario.rest.usuario-padrao',
            'route_identifier_name' => 'usuario_padrao_id',
            'collection_name' => 'usuario_padrao',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoEntity::class,
            'collection_class' => \Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoCollection::class,
            'service_name' => 'UsuarioPadrao',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'Usuario\\V1\\Rest\\UsuarioPadrao\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Usuario\\V1\\Rest\\UsuarioPadrao\\Controller' => [
                0 => 'application/vnd.usuario.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Usuario\\V1\\Rest\\UsuarioPadrao\\Controller' => [
                0 => 'application/vnd.usuario.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'usuario.rest.usuario-padrao',
                'route_identifier_name' => 'usuario_padrao_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
            ],
            \Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'usuario.rest.usuario-padrao',
                'route_identifier_name' => 'usuario_padrao_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'Usuario\\V1\\Rest\\UsuarioPadrao\\Controller' => [
            'input_filter' => 'Usuario\\V1\\Rest\\UsuarioPadrao\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Usuario\\V1\\Rest\\UsuarioPadrao\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\NotEmpty::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                        'options' => [],
                    ],
                ],
                'name' => 'nome_completo',
                'description' => 'Nome completo do usuário',
            ],
        ],
    ],
];
