<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name'   => 'required|string|max:100',
            'gender' => 'required|string|max:1',
            'cpf'    => 'required|string|unique:clients,cpf|size:11'
        ];
    }

    public function messages()
    {
        return [
            'name.required'   => 'O nome é obrigatório. Favor preencher',
            'name.string'     => 'O nome deve ser uma string',
            'name.max'        => 'O nome deve ter no máximo 100 caracteres',
            'gender.required' => 'O gênero é obrigatório. Favor preencher',
            'gender.string'   => 'O gênero deve ser uma string',
            'cpf.required'    => 'O CPF é obrigatório. Favor preencher',
            'cpf.unique'      => 'O CPF deve ser único. Favor verificar se não existe cadastro com este CPF',
            'cpf.size'        => 'O CPF deve ter 11 caracteres'
        ];
    }
}
