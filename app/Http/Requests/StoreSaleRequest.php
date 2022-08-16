<?php

namespace App\Http\Requests;

use App\Rules\CheckQuantityProduct;
use App\Rules\CheckUserInactive;
use Illuminate\Foundation\Http\FormRequest;


class StoreSaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'client_id' => ['required','exists:clients,id', new CheckUserInactive()],
            'product_id' => ['required','exists:products,id', new CheckQuantityProduct($this->quantity)],
            'quantity' => 'required|integer|min:1',
            'date_requested' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'O cliente é obrigatório',
            'client_id.exists' => 'Client informado não existe.',
            'product_id.required' => 'Product é obrigatório',
            'product_id.exists' => 'Product informado não existe.',
            'quantity.required' => 'É necessário informar a quantidade.',
            'quantity.integer' => 'A quantidade deve ser um número inteiro.',
            'quantity.min' => 'A quantidade deve ser maior que zero.',
            'date_requested.required' => 'É necessário informar a data da venda.',
            'date_requested.date' => 'A data da venda deve ser uma data válida.'
        ];
    }
}
