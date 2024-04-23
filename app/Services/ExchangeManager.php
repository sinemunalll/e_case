<?php

namespace App\Services;

use App\Adapters\CurrencyAdapterInterface;
use App\Repositories\ExchangeRate\ExchangeRateRepositoryInterface;

class ExchangeManager
{
    protected array $services = [];

    protected ExchangeRateRepositoryInterface $exchangeRateRepository;

    public function __construct(ExchangeRateRepositoryInterface $exchangeRateRepository)
    {
        $this->exchangeRateRepository = $exchangeRateRepository;
    }

    public function addAdapter(CurrencyAdapterInterface $service)
    {
        $this->services[] = $service;
    }

    public function fetchExchangeRates()
    {
        $exchangeRates = [];

        foreach ($this->services as $service) {
            $rates = $service->fetchExchangeRates();
            foreach ($rates as $currencyCode => $rate) {
                if($currencyCode== 'provider_id'){
                    continue;
                }
                $this->exchangeRateRepository->saveExchangeRatesToDatabase(
                     $currencyCode,$rate, $rates['provider_id']);
            }
        }
        return $exchangeRates;
    }
}
