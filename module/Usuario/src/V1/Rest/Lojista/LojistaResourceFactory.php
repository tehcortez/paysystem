<?php
namespace Usuario\V1\Rest\Lojista;

class LojistaResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get(LojistaMapper::class);
        return new LojistaResource($mapper);
    }
}
