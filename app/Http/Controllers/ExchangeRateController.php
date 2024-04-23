<?php

namespace App\Http\Controllers;

use App\Repositories\ExchangeRate\ExchangeRateRepositoryInterface;

class ExchangeRateController extends Controller
{
    protected ExchangeRateRepositoryInterface $exchangeRateRepository;

    public function __construct(ExchangeRateRepositoryInterface $exchangeRateRepository)
    {
        $this->exchangeRateRepository = $exchangeRateRepository;
    }

    public function showCheapestExchangeRate()
    {
        // En düşük kur verisini al
        $cheapestExchangeRate = $this->exchangeRateRepository->getCheapestExchangeRate();

        if ($cheapestExchangeRate) {
            return response()->json([
                'currency' => $cheapestExchangeRate->currency->name,
                'provider' => $cheapestExchangeRate->provider->url,
                'rate' => $cheapestExchangeRate->rate,
            ]);
        } else {
            return response()->json(['message' => 'No exchange rates found.'], 404);
        }
    }
}
