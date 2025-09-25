<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'cnpj',
        'observation',
        'contract_value'
    ];

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function contractValue(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return number_format($value, 2, '.', '');
            },
            set: fn ($value) => (int) ($value * 100)
        );
    }
}
