<?php

namespace App\Http\Requests\Fornecedores;

use App\Helpers\DocumentoHelper;
use App\Rules\Documento\Cnpj;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CriarFornecedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|min:3|max:255',
            'cnpj' => ['required', 'string', new Cnpj],
            'email' => 'nullable|email|max:255',
        ];
    }
}
