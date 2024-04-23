<?php

namespace App\Repositories\ExchangeRate;

use App\Models\Currency;
use App\Models\ExchangeRate;

class ExchangeRateRepository implements ExchangeRateRepositoryInterface
{


    public function saveExchangeRatesToDatabase($currencyCode,$exchangeRates, $providerId)
    {

        $currencyModel = Currency::where('code', $currencyCode)->first();

        // ExchangeRate tablosuna veriyi ekle veya güncelle
        ExchangeRate::updateOrCreate(
            [
                'currency_id' => $currencyModel->id,
                'provider_id' => $providerId,
            ],
            [
                'rate' => $exchangeRates,
            ]
        );
    }

    public function getCheapestExchangeRate()
    {
        // En düşük kuru bul
        $minRate = ExchangeRate::min('rate');

        // En düşük kurun bulunduğu kaydı al
        $cheapestExchangeRate = ExchangeRate::where('rate', $minRate)->with('currency', 'provider')->first();

        return $cheapestExchangeRate;
    }
}
