<?php

namespace App\Http\Controllers;

use App\Repositories\Currency\CurrencyRepositoryInterface;

class CurrencyController extends Controller
{
    protected $currencyRepository;

    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;

    }

    public function index()
    {
        $currencies = $this->currencyRepository->getAll();
        return view('currencies.index', compact('currencies'));
    }
}
