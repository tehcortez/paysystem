<?php
return [
    'service_manager' => [
        'factories' => [
            \Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoResource::class => \Usuario\V1\Rest\UsuarioPadrao\UsuarioPadraoResourceFactory::class,
            \Usuario\V1\Rest\Lojista\LojistaResource::class => \Usuario\V1\Rest\Lojista\LojistaResourceFactory::class,
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
            'usuario.rest.lojista' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/lojista[/:lojista_id]',
                    'defaults' => [
                        'controller' => 'Usuario\\V1\\Rest\\Lojista\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'usuario.rest.usuario-padrao',
            1 => 'usuario.rest.lojista',
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
        'Usuario\\V1\\Rest\\Lojista\\Controller' => [
            'listener' => \Usuario\V1\Rest\Lojista\LojistaResource::class,
            'route_name' => 'usuario.rest.lojista',
            'route_identifier_name' => 'lojista_id',
            'collection_name' => 'lojista',
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
            'entity_class' => \Usuario\V1\Rest\Lojista\LojistaEntity::class,
            'collection_class' => \Usuario\V1\Rest\Lojista\LojistaCollection::class,
            'service_name' => 'Lojista',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'Usuario\\V1\\Rest\\UsuarioPadrao\\Controller' => 'HalJson',
            'Usuario\\V1\\Rest\\Lojista\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Usuario\\V1\\Rest\\UsuarioPadrao\\Controller' => [
                0 => 'application/vnd.usuario.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Usuario\\V1\\Rest\\Lojista\\Controller' => [
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
            'Usuario\\V1\\Rest\\Lojista\\Controller' => [
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
            \Usuario\V1\Rest\Lojista\LojistaEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'usuario.rest.lojista',
                'route_identifier_name' => 'lojista_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
            ],
            \Usuario\V1\Rest\Lojista\LojistaCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'usuario.rest.lojista',
                'route_identifier_name' => 'lojista_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'Usuario\\V1\\Rest\\UsuarioPadrao\\Controller' => [
            'input_filter' => 'Usuario\\V1\\Rest\\UsuarioPadrao\\Validator',
        ],
        'Usuario\\V1\\Rest\\Lojista\\Controller' => [
            'input_filter' => 'Usuario\\V1\\Rest\\Lojista\\Validator',
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
                        'options' => [
                            'max' => '255',
                        ],
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
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\Digits::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'cpf',
                'description' => 'CPF do usuario padrao',
            ],
            2 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\EmailAddress::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'email',
                'description' => 'E-mail do usuário padrão',
            ],
            3 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'senha',
                'description' => 'Senha do usuário padrão',
            ],
            4 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\Digits::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'carteira',
                'description' => 'Saldo da carteira do usuario',
            ],
        ],
        'Usuario\\V1\\Rest\\Lojista\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\NotEmpty::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'max' => '255',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                        'options' => [],
                    ],
                ],
                'name' => 'nome_completo',
                'description' => 'Nome completo do lojista',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\Digits::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'cnpj',
                'description' => 'CNJP do lojista',
            ],
            2 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\EmailAddress::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'email',
                'description' => 'E-mail do lojista',
            ],
            3 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'senha',
                'description' => 'Senha de acesso para o lojista',
            ],
        ],
    ],
];
