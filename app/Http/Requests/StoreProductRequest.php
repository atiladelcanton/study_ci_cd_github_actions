<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0.01',
            'stock'       => 'nullable|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => 'O nome do produto é obrigatório.',
            'name.string'          => 'O nome do produto deve ser uma string.',
            'name.max'             => 'O nome do produto deve ter no máximo 100 caracteres.',
            'description.string'   => 'A descrição do produto deve ser uma string.',
            'description.max'      => 'A descrição do produto deve ter no máximo 255 caracteres.',
            'price.required'       => 'O preço do produto é obrigatório.',
            'price.numeric'        => 'O preço do produto deve ser um número.',
            'price.min'            => 'O preço do produto deve ser maior que 0.',
            'stock.integer'        => 'O estoque do produto deve ser um número inteiro.',
        ];
    }
}
