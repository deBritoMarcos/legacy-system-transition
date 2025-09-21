<?php

namespace App\Dtos\Fornecedores;

final readonly class FiltrarFornecedorDto
{
    public function __construct(
        public ?string $nome = null,
        public string $ordernarPor = 'created_at',
        public string $ordernarDirecao = 'desc',
    ) {}
}