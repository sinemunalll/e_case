<?php

namespace App\Repositories\CurrencyProvider;

use App\Models\CurrencyProvider;

class CurrencyProviderRepository implements CurrencyProviderRepositoryInterface
{

    public function getAll()
    {
        return CurrencyProvider::all();
    }

    public function create($data)
    {
        return CurrencyProvider::updateOrCreate(
            [
                'name' => $data['name'],
                'url' => $data['url'],
            ],
            $data
        );

    }
    public function getProvider($name)
    {
        $provider = CurrencyProvider::where('name', $name)->first();
        return $provider ?? null;
    }
}
