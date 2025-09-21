<?php

namespace App\Repositories\Fornecedores\Contratos;

use App\Dtos\Fornecedores\EncontrePorAtributoDto;
use App\Dtos\Fornecedores\SalvarFornecedorDto;
use App\Models\Fornecedor;

interface FornecedorEloquentRepositoryInterface
{
    public function encontrePorAtributo(EncontrePorAtributoDto $filtro): ?Fornecedor;

    public function salvar(SalvarFornecedorDto $fornecedorDto): Fornecedor;
}