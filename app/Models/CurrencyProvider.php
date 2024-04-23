<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyProvider extends Model
{
    use HasFactory;

    protected $table = 'currency_providers';

    protected $fillable = [
        'name', 'url',
    ];
}
