<?php
namespace Usuario\V1\Rest\UsuarioPadrao;

class UsuarioPadraoResourceFactory
{
    public function __invoke($services)
    {
        return new UsuarioPadraoResource();
    }
}
