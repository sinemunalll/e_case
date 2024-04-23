<?php

namespace App\Repositories\ExchangeRate;

interface ExchangeRateRepositoryInterface
{
    public function saveExchangeRatesToDatabase($currencyCode,$exchangeRates, $providerId);
    public function getCheapestExchangeRate();

}
