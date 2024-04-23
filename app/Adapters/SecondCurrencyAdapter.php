<?php

namespace App\Adapters;
use App\Services\SecondCurrencyService;


class SecondCurrencyAdapter implements CurrencyAdapterInterface
{
    protected $secondCurrencyService;

    public function __construct(SecondCurrencyService $secondCurrencyService)
    {
        $this->secondCurrencyService = $secondCurrencyService;
    }

    public function fetchExchangeRates()
    {
        $data = $this->secondCurrencyService->fetch();

        $exchangeRates = [];
        foreach ($data as $currencyData) {
            $exchangeRates['provider_id'] = $this->secondCurrencyService->getProvider()->id;
            $exchangeRates[$currencyData['symbol']] = $currencyData['amount'];
        }

        return $exchangeRates;
    }
}
