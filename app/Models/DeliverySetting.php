<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_kg_charge',
        'additional_kg_charge',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'first_kg_charge' => 'decimal:2',
            'additional_kg_charge' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }
}
