<?php

namespace App\Services;

class FirstCurrencyService extends CurrencyService
{
    public function getProvider(){
        return $this->currencyProviderRepository->getProvider('first');

    }
}
