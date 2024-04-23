<?php

namespace App\Console\Commands;

use App\Adapters\FirstCurrencyAdapter;
use App\Adapters\SecondCurrencyAdapter;
use App\Services\ExchangeManager;
use App\Services\FirstCurrencyService;
use App\Services\SecondCurrencyService;
use Illuminate\Console\Command;

class FetchExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange-rates:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected ExchangeManager $exchangeRateManager;
    protected FirstCurrencyService $firstCurrencyService;
    protected SecondCurrencyService $secondCurrencyService;

    public function __construct(ExchangeManager $exchangeRateManager, FirstCurrencyService $firstCurrencyService, SecondCurrencyService $secondCurrencyService
    )
    {
        parent::__construct();
        $this->exchangeRateManager = $exchangeRateManager;
        $this->firstCurrencyService = $firstCurrencyService;
        $this->secondCurrencyService = $secondCurrencyService;
    }

    public function handle()
    {
        $firstAdapter = new FirstCurrencyAdapter($this->firstCurrencyService);
        $secondAdapter = new SecondCurrencyAdapter($this->secondCurrencyService);

        $this->exchangeRateManager->addAdapter($firstAdapter);
        $this->exchangeRateManager->addAdapter($secondAdapter);
        $this->exchangeRateManager->fetchExchangeRates();
    }
}
