<?php

namespace App\Services;

use App\Repositories\CurrencyProvider\CurrencyProviderRepositoryInterface;
use GuzzleHttp\Client;

abstract class CurrencyService
{
    protected Client $httpClient;
    protected CurrencyProviderRepositoryInterface $currencyProviderRepository;

    public function __construct(Client $httpClient, CurrencyProviderRepositoryInterface $currencyProviderRepository)
    {
        $this->httpClient = $httpClient;
        $this->currencyProviderRepository = $currencyProviderRepository;
    }

    abstract public function getProvider();

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetch(): array
    {
        $provider = $this->getProvider();

        if ($provider) {
            $response = $this->httpClient->get($provider->url);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                $dataWithProviderId = array_map(function ($currencyData) use ($provider) {
                    $currencyData['provider_id'] = $provider->id;
                    return $currencyData;
                }, $data);

                return $dataWithProviderId ?? [];
            }
        }

        return [];
    }
}
