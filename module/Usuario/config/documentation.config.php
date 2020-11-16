<?php
return [
    'Usuario\\V1\\Rest\\UsuarioPadrao\\Controller' => [
        'description' => 'Serviço responsável pela administração de usuários padrão',
        'collection' => [
            'description' => 'Coleção de dados do usuário padrão',
            'GET' => [
                'description' => 'Traz a listagem de usuários padrão',
                'response' => '{
   "_links": {
       "self": {
           "href": "/usuario-padrao"
       },
       "first": {
           "href": "/usuario-padrao?page={page}"
       },
       "prev": {
           "href": "/usuario-padrao?page={page}"
       },
       "next": {
           "href": "/usuario-padrao?page={page}"
       },
       "last": {
           "href": "/usuario-padrao?page={page}"
       }
   }
   "_embedded": {
       "usuario_padrao": [
           {
               "_links": {
                   "self": {
                       "href": "/usuario-padrao[/:usuario_padrao_id]"
                   }
               }
              "nome_completo": "Nome completo do usuário",
              "cpf": "CPF do usuario padrao",
              "email": "E-mail do usuário padrão",
              "senha": "Senha do usuário padrão",
              "carteira": "Saldo da carteira do usuario"
           }
       ]
   }
}',
            ],
            'POST' => [
                'description' => 'Insere a listagem de usuários padrão',
                'request' => '{
   "nome_completo": "Nome completo do usuário",
   "cpf": "CPF do usuario padrao",
   "email": "E-mail do usuário padrão",
   "senha": "Senha do usuário padrão",
   "carteira": "Saldo da carteira do usuario"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/usuario-padrao[/:usuario_padrao_id]"
       }
   }
   "nome_completo": "Nome completo do usuário",
   "cpf": "CPF do usuario padrao",
   "email": "E-mail do usuário padrão",
   "senha": "Senha do usuário padrão",
   "carteira": "Saldo da carteira do usuario"
}',
            ],
        ],
        'entity' => [
            'GET' => [
                'response' => '{
   "_links": {
       "self": {
           "href": "/usuario-padrao[/:usuario_padrao_id]"
       }
   }
   "nome_completo": "Nome completo do usuário",
   "cpf": "CPF do usuario padrao",
   "email": "E-mail do usuário padrão",
   "senha": "Senha do usuário padrão",
   "carteira": "Saldo da carteira do usuario"
}',
            ],
            'PATCH' => [
                'request' => '{
   "nome_completo": "Nome completo do usuário",
   "cpf": "CPF do usuario padrao",
   "email": "E-mail do usuário padrão",
   "senha": "Senha do usuário padrão"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/usuario-padrao[/:usuario_padrao_id]"
       }
   }
   "nome_completo": "Nome completo do usuário",
   "cpf": "CPF do usuario padrao",
   "email": "E-mail do usuário padrão",
   "senha": "Senha do usuário padrão"
}',
            ],
            'PUT' => [
                'request' => '{
   "nome_completo": "Nome completo do usuário",
   "cpf": "CPF do usuario padrao",
   "email": "E-mail do usuário padrão",
   "senha": "Senha do usuário padrão",
   "carteira": "Saldo da carteira do usuario"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/usuario-padrao[/:usuario_padrao_id]"
       }
   }
   "nome_completo": "Nome completo do usuário",
   "cpf": "CPF do usuario padrao",
   "email": "E-mail do usuário padrão",
   "senha": "Senha do usuário padrão",
   "carteira": "Saldo da carteira do usuario"
}',
            ],
            'DELETE' => [
                'response' => '',
                'request' => '{
   "nome_completo": "Nome completo do usuário",
   "cpf": "CPF do usuario padrao",
   "email": "E-mail do usuário padrão",
   "senha": "Senha do usuário padrão",
   "carteira": "Saldo da carteira do usuario"
}',
            ],
        ],
    ],
    'Usuario\\V1\\Rest\\Lojista\\Controller' => [
        'collection' => [
            'GET' => [
                'description' => 'Traz a listagem de lojistas',
                'response' => '{
   "_links": {
       "self": {
           "href": "/lojista"
       },
       "first": {
           "href": "/lojista?page={page}"
       },
       "prev": {
           "href": "/lojista?page={page}"
       },
       "next": {
           "href": "/lojista?page={page}"
       },
       "last": {
           "href": "/lojista?page={page}"
       }
   }
   "_embedded": {
       "lojista": [
           {
               "_links": {
                   "self": {
                       "href": "/lojista[/:lojista_id]"
                   }
               }
              "nome_completo": "Nome completo do lojista",
              "cnpj": "CNJP do lojista",
              "email": "E-mail do lojista",
              "senha": "Senha de acesso para o lojista"
           }
       ]
   }
}',
            ],
            'description' => 'Coleção de dados de lojistas',
            'POST' => [
                'description' => 'Insere a listagem de lojistas na base de dados',
                'request' => '{
   "nome_completo": "Nome completo do lojista",
   "cnpj": "CNJP do lojista",
   "email": "E-mail do lojista",
   "senha": "Senha de acesso para o lojista"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/lojista[/:lojista_id]"
       }
   }
   "nome_completo": "Nome completo do lojista",
   "cnpj": "CNJP do lojista",
   "email": "E-mail do lojista",
   "senha": "Senha de acesso para o lojista"
}',
            ],
        ],
        'entity' => [
            'GET' => [
                'response' => '{
   "_links": {
       "self": {
           "href": "/lojista[/:lojista_id]"
       }
   }
   "nome_completo": "Nome completo do lojista",
   "cnpj": "CNJP do lojista",
   "email": "E-mail do lojista",
   "senha": "Senha de acesso para o lojista"
}',
            ],
            'PATCH' => [
                'request' => '{
   "nome_completo": "Nome completo do lojista",
   "cnpj": "CNJP do lojista",
   "email": "E-mail do lojista",
   "senha": "Senha de acesso para o lojista"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/lojista[/:lojista_id]"
       }
   }
   "nome_completo": "Nome completo do lojista",
   "cnpj": "CNJP do lojista",
   "email": "E-mail do lojista",
   "senha": "Senha de acesso para o lojista"
}',
            ],
            'PUT' => [
                'request' => '{
   "nome_completo": "Nome completo do lojista",
   "cnpj": "CNJP do lojista",
   "email": "E-mail do lojista",
   "senha": "Senha de acesso para o lojista"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/lojista[/:lojista_id]"
       }
   }
   "nome_completo": "Nome completo do lojista",
   "cnpj": "CNJP do lojista",
   "email": "E-mail do lojista",
   "senha": "Senha de acesso para o lojista"
}',
            ],
            'DELETE' => [
                'request' => '{
   "nome_completo": "Nome completo do lojista",
   "cnpj": "CNJP do lojista",
   "email": "E-mail do lojista",
   "senha": "Senha de acesso para o lojista"
}',
                'response' => '',
            ],
        ],
    ],
];
