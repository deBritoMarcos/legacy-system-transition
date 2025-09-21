<?php

namespace App\Services\Fornecedores\Contratos;

use App\Models\Fornecedor;
use Illuminate\Support\Collection;

interface BuscadorDeFornecedorServiceInterface
{
    public function busqueMuitosFiltrandoEOrdernando(array $filtros): Collection;
    
    public function busqueUmPorAtributo(string $atributo, mixed $valor): ?Fornecedor;
}