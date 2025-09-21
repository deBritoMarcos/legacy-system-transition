<?php

namespace App\Rules\Documento;

use App\Helpers\DocumentoHelper;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Cnpj implements ValidationRule
{
    const CNPJ_SIZE = 14;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->valorDeEntradaEInvalido($value)) {
            $fail('validation.cnpj.invalid-input')->translate();
            return;
        }

        $valorHigienizado = DocumentoHelper::temSeparadores($value)
            ? DocumentoHelper::removerSeparadores($value)
            : $value;

        if ($this->oTamanhoEInvalido($valorHigienizado)) {
            $fail('validation.cnpj.invalid-size')->translate();
            return;
        }

        if ($this->eUmaSequenciaRepetida($valorHigienizado)) {
            $fail('validation.cnpj.repeated-value')->translate();
            return;
        }

        if ($this->digitosVerificadoresSaoInvalidos($valorHigienizado)) {
            $fail('validation.cnpj.invalid-cnpj')->translate();
        }
    }

    private function valorDeEntradaEInvalido(mixed $valor): bool 
    {
        if (empty($valor)) {
            return true;
        }

        if (!is_string($valor)) {
            return true;
        }

        return false;
    }

    private function oTamanhoEInvalido(string $valor): bool 
    {
        return strlen($valor) != self::CNPJ_SIZE;
    }

    private function eUmaSequenciaRepetida(string $valor): bool 
    {
        return preg_match('/^(\d)\1{13}$/', $valor);
    }

    private function digitosVerificadoresSaoInvalidos(string $valor): bool 
    {
        $numeros = array_map('intval', str_split($valor));

        // Validação do primeiro dígito
        $primeiroMultiplicador = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;
        for ($i = 0; $i < 12; $i++) {
            $soma += $numeros[$i] * $primeiroMultiplicador[$i];
        }
        $resto = $soma % 11;
        $primeiroVerificador = ($resto < 2) ? 0 : 11 - $resto;

        if ($numeros[12] != $primeiroVerificador) {
            return true;
        }

        // Validação do segundo dígito
        $segundoMultiplicador = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;
        for ($i = 0; $i < 13; $i++) {
            $soma += $numeros[$i] * $segundoMultiplicador[$i];
        }
        $resto = $soma % 11;
        $segundoVerificador = ($resto < 2) ? 0 : 11 - $resto;

        if ($numeros[13] != $segundoVerificador) {
            return true;
        }

        return false;
    }
}
