<?php

namespace App\Repositories\Fornecedores;

use App\Dtos\Fornecedores\EncontrePorAtributoDto;
use App\Dtos\Fornecedores\FiltrarFornecedorDto;
use App\Dtos\Fornecedores\SalvarFornecedorDto;
use App\Models\Fornecedor;
use App\Repositories\Fornecedores\Contratos\FornecedorEloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class FornecedorEloquentRepository implements FornecedorEloquentRepositoryInterface
{
    const TOTAL_DE_REGISTROS_PADRAO = 50;

    public function listarFiltrandoEOrdernando(FiltrarFornecedorDto $filtro): Collection
    {
        $nome = $filtro->nome;
        
        return Fornecedor::when($nome, function (Builder $query, string $nome) {
                $query->where('nome', 'LIKE', "%{$nome}%");
            })
            ->orderBy($filtro->ordernarPor, $filtro->ordernarDirecao)
            ->limit(self::TOTAL_DE_REGISTROS_PADRAO)
            ->get();
    }

    public function encontrePorAtributo(EncontrePorAtributoDto $filtro): ?Fornecedor
    {
        return Fornecedor::where($filtro->atributo, $filtro->valor)->first();
    }

    public function salvar(SalvarFornecedorDto $fornecedorDto): Fornecedor
    {
        return Fornecedor::create($fornecedorDto->toArray());
    }
}