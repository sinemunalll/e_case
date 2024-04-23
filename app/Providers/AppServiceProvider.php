<?php

namespace App\Providers;

use App\Repositories\Currency\CurrencyRepository;
use App\Repositories\Currency\CurrencyRepositoryInterface;
use App\Repositories\CurrencyProvider\CurrencyProviderRepository;
use App\Repositories\CurrencyProvider\CurrencyProviderRepositoryInterface;
use App\Repositories\ExchangeRate\ExchangeRateRepository;
use App\Services\FirstCurrencyService;
use App\Services\SecondCurrencyService;
use Illuminate\Support\ServiceProvider;

use App\Repositories\ExchangeRate\ExchangeRateRepositoryInterface;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CurrencyProviderRepositoryInterface::class, CurrencyProviderRepository::class);
        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);
        $this->app->bind(ExchangeRateRepositoryInterface::class, ExchangeRateRepository::class);

        $this->app->singleton(FirstCurrencyService::class, function ($app) {
            $httpClient = $app->make(Client::class);
            $currencyProviderRepository = $app->make(CurrencyProviderRepositoryInterface::class);
            $exchangeRateRepository = $app->make(ExchangeRateRepositoryInterface::class);

            return new FirstCurrencyService($httpClient, $currencyProviderRepository, $exchangeRateRepository);
        });

        $this->app->singleton(SecondCurrencyService::class, function ($app) {
            $httpClient = $app->make(Client::class);
            $currencyProviderRepository = $app->make(CurrencyProviderRepositoryInterface::class);
            $exchangeRateRepository = $app->make(ExchangeRateRepositoryInterface::class);

            return new SecondCurrencyService($httpClient, $currencyProviderRepository, $exchangeRateRepository);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
