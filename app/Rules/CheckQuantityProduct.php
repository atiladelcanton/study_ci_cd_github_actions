<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class CheckQuantityProduct implements Rule
{
    private int $quantity;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $product = Product::find($value);

        if(!$product || $product->stock < $this->quantity) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Não há estoque suficiente para a venda.';
    }
}
