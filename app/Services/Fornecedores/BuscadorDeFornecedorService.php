<?php

namespace App\Services\Fornecedores;

use App\Dtos\Fornecedores\EncontrePorAtributoDto;
use App\Models\Fornecedor;
use App\Repositories\Fornecedores\Contratos\FornecedorEloquentRepositoryInterface;
use App\Services\Fornecedores\Contratos\BuscadorDeFornecedorServiceInterface;

class BuscadorDeFornecedorService implements BuscadorDeFornecedorServiceInterface
{
    public function __construct(
        private FornecedorEloquentRepositoryInterface $fornecedorRepository, 
    ) {}

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