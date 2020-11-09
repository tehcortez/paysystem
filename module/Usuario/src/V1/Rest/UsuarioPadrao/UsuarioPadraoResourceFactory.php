<?php
namespace Usuario\V1\Rest\UsuarioPadrao;

class UsuarioPadraoResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get(UsuarioPadraoMapper::class);
        return new UsuarioPadraoResource($mapper);
    }
}
