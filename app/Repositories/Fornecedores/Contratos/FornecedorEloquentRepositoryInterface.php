<?php

namespace App\Repositories\Fornecedores\Contratos;

use App\Dtos\Fornecedores\EncontrePorAtributoDto;
use App\Dtos\Fornecedores\FiltrarFornecedorDto;
use App\Dtos\Fornecedores\SalvarFornecedorDto;
use App\Models\Fornecedor;
use Illuminate\Support\Collection;

interface FornecedorEloquentRepositoryInterface
{
    public function listarFiltrandoEOrdernando(FiltrarFornecedorDto $filtro): Collection;
    
    public function encontrePorAtributo(EncontrePorAtributoDto $filtro): ?Fornecedor;

    public function salvar(SalvarFornecedorDto $fornecedorDto): Fornecedor;
}