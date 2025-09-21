<?php

namespace App\Repositories\Fornecedores;

use App\Dtos\Fornecedores\EncontrePorAtributoDto;
use App\Dtos\Fornecedores\SalvarFornecedorDto;
use App\Models\Fornecedor;
use App\Repositories\Fornecedores\Contratos\FornecedorEloquentRepositoryInterface;

class FornecedorEloquentRepository implements FornecedorEloquentRepositoryInterface
{
    public function encontrePorAtributo(EncontrePorAtributoDto $filtro): ?Fornecedor
    {
        return Fornecedor::where($filtro->atributo, $filtro->valor)->first();
    }

    public function salvar(SalvarFornecedorDto $fornecedorDto): Fornecedor
    {
        return Fornecedor::create($fornecedorDto->toArray());
    }
}