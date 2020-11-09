<?php
return [
    'service_manager' => [
        'factories' => [
            \pay\V1\Rest\Transaction\TransactionResource::class => \pay\V1\Rest\Transaction\TransactionResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'pay.rest.transaction' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/transaction[/:transaction_id]',
                    'defaults' => [
                        'controller' => 'pay\\V1\\Rest\\Transaction\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'pay.rest.transaction',
        ],
    ],
    'api-tools-rest' => [
        'pay\\V1\\Rest\\Transaction\\Controller' => [
            'listener' => \pay\V1\Rest\Transaction\TransactionResource::class,
            'route_name' => 'pay.rest.transaction',
            'route_identifier_name' => 'transaction_id',
            'collection_name' => 'transaction',
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
            'entity_class' => \pay\V1\Rest\Transaction\TransactionEntity::class,
            'collection_class' => \pay\V1\Rest\Transaction\TransactionCollection::class,
            'service_name' => 'transaction',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'pay\\V1\\Rest\\Transaction\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'pay\\V1\\Rest\\Transaction\\Controller' => [
                0 => 'application/vnd.pay.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'pay\\V1\\Rest\\Transaction\\Controller' => [
                0 => 'application/vnd.pay.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \pay\V1\Rest\Transaction\TransactionEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'pay.rest.transaction',
                'route_identifier_name' => 'transaction_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
            ],
            \pay\V1\Rest\Transaction\TransactionCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'pay.rest.transaction',
                'route_identifier_name' => 'transaction_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'pay\\V1\\Rest\\Transaction\\Controller' => [
            'input_filter' => 'pay\\V1\\Rest\\Transaction\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'pay\\V1\\Rest\\Transaction\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\Digits::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'value',
                'description' => 'Valor da transação',
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
                'name' => 'payer',
                'description' => 'Id do usuario pagador da transação',
            ],
            2 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\Digits::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'payee',
                'description' => 'Id do usuario recebedor da transação',
            ],
        ],
    ],
];
