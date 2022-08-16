<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'name',
        'email',
        'gender',
        'cpf'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function status(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value == 'active' ? 'Ativo' : 'Inativo'
        );
    }

    public function cpf(): Attribute
    {
        return Attribute::make(
            get: fn($value) => preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $value)
        );
    }

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }

}
