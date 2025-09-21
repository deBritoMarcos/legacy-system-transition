<?php

namespace App\Dtos\Fornecedores;

final readonly class EncontrePorAtributoDto
{
    public function __construct(
        public string $atributo,
        public mixed $valor,
    ) {}
}