<?php

namespace App\Services;

class SecondCurrencyService extends CurrencyService
{
    public function getProvider(){
        return $this->currencyProviderRepository->getProvider('second');

    }
}
