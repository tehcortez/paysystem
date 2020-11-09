<?php
return [
    'pay\\V1\\Rest\\Transaction\\Controller' => [
        'collection' => [
            'GET' => [
                'response' => '{
   "_links": {
       "self": {
           "href": "/transaction"
       },
       "first": {
           "href": "/transaction?page={page}"
       },
       "prev": {
           "href": "/transaction?page={page}"
       },
       "next": {
           "href": "/transaction?page={page}"
       },
       "last": {
           "href": "/transaction?page={page}"
       }
   }
   "_embedded": {
       "transaction": [
           {
               "_links": {
                   "self": {
                       "href": "/transaction[/:transaction_id]"
                   }
               }
              "value": "Valor da transação",
              "payer": "Id do usuario pagador da transação",
              "payee": "Id do usuario recebedor da transação"
           }
       ]
   }
}',
            ],
            'POST' => [
                'request' => '{
   "value": "Valor da transação",
   "payer": "Id do usuario pagador da transação",
   "payee": "Id do usuario recebedor da transação"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/transaction[/:transaction_id]"
       }
   }
   "value": "Valor da transação",
   "payer": "Id do usuario pagador da transação",
   "payee": "Id do usuario recebedor da transação"
}',
            ],
        ],
        'entity' => [
            'GET' => [
                'response' => '{
   "_links": {
       "self": {
           "href": "/transaction[/:transaction_id]"
       }
   }
   "value": "Valor da transação",
   "payer": "Id do usuario pagador da transação",
   "payee": "Id do usuario recebedor da transação"
}',
            ],
            'DELETE' => [
                'request' => '{
   "value": "Valor da transação",
   "payer": "Id do usuario pagador da transação",
   "payee": "Id do usuario recebedor da transação"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/transaction[/:transaction_id]"
       }
   }
   "value": "Valor da transação",
   "payer": "Id do usuario pagador da transação",
   "payee": "Id do usuario recebedor da transação"
}',
            ],
        ],
    ],
];
