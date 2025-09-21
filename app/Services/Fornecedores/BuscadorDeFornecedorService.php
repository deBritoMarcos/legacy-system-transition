<?php

namespace App\Services\Fornecedores;

use App\Dtos\Fornecedores\EncontrePorAtributoDto;
use App\Dtos\Fornecedores\FiltrarFornecedorDto;
use App\Models\Fornecedor;
use App\Repositories\Fornecedores\Contratos\FornecedorEloquentRepositoryInterface;
use App\Services\Fornecedores\Contratos\BuscadorDeFornecedorServiceInterface;
use Illuminate\Support\Collection;

class BuscadorDeFornecedorService implements BuscadorDeFornecedorServiceInterface
{
    public function __construct(
        private FornecedorEloquentRepositoryInterface $fornecedorRepository, 
    ) {}

    public function busqueMuitosFiltrandoEOrdernando(array $filtros): Collection
    {
        $filtroDto = new FiltrarFornecedorDto(
            nome: $filtros['nome'] ?? null
        );

        return $this->fornecedorRepository
            ->listarFiltrandoEOrdernando($filtroDto);
    }

    public function busqueUmPorAtributo(string $atributo, mixed $valor): ?Fornecedor
    {
        $filtroDto = new EncontrePorAtributoDto(
            atributo: $atributo,
            valor: $valor,
        );

        return $this->fornecedorRepository
            ->encontrePorAtributo($filtroDto);
    }    
}