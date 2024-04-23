<?php

namespace App\Http\Controllers;

use App\Repositories\CurrencyProvider\CurrencyProviderRepositoryInterface;
use Illuminate\Http\Request;

class CurrencyProviderController extends Controller
{
    protected CurrencyProviderRepositoryInterface $currencyProviderRepository;

    public function __construct(CurrencyProviderRepositoryInterface $currencyProviderRepository)
    {
        $this->currencyProviderRepository = $currencyProviderRepository;
    }

    public function index()
    {

    }

    public function fillCurrencyProviders(Request $request)
    {
        // Currency providers tablosunu doldur
        $providers = $request->input('providers', []);

        // Her bir provider için tabloya ekleme yap
        foreach ($providers as $provider) {
            $this->currencyProviderRepository->create($provider);
        }
        return response()->json(['message' => 'Currency providers have been filled successfully']);
    }
}
