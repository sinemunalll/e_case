<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;

    protected $table = 'exchange_rates';

    protected $fillable = [
        'currency_id', 'provider_id', 'rate', 'timestamp',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function provider()
    {
        return $this->belongsTo(CurrencyProvider::class);
    }


}
