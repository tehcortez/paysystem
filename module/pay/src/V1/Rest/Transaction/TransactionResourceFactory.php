<?php
namespace pay\V1\Rest\Transaction;

class TransactionResourceFactory
{
    public function __invoke($services)
    {
        return new TransactionResource();
    }
}
