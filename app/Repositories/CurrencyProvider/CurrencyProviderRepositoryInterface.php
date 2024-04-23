<?php

namespace App\Repositories\CurrencyProvider;

interface CurrencyProviderRepositoryInterface
{
    public function getAll();

    public function create($data);
}
