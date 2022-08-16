<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'description',
        'price',
        'stock'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    public function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value == 'active' ? 'Ativo' : 'Inativo'
        );
    }

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }
}
