<?php

namespace App\Services\Fornecedores\Contratos;

use App\Models\Fornecedor;

interface BuscadorDeFornecedorServiceInterface
{
    public function busqueUmPorAtributo(string $atributo, mixed $valor): ?Fornecedor;
}