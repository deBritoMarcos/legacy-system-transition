<?php

namespace App\Services\Fornecedores\Contratos;

use App\Models\Fornecedor;

interface CriadorDeFornecedorServiceInterface
{
    public function criar(array $fornecedorData): Fornecedor;
}