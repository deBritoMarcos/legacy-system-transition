<?php

namespace App\Http\Requests\Fornecedores;

use Illuminate\Foundation\Http\FormRequest;

class ListarFornecedoresRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'nullable|max:255',
        ];
    }
}
