<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'client_id',
        'product_id',
        'quantity',
        'amount',
        'date_requested',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => match ($value) {
                'open' => 'Em Aberto',
                'paid' => 'Pago',
                'canceled' => 'Cancelado',
            }
        );
    }

    public function dateRequested(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format("d/m/Y")
        );
    }
}
