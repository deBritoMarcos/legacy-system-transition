<?php

use App\Dtos\Fornecedores\EncontrePorAtributoDto;
use App\Dtos\Fornecedores\FiltrarFornecedorDto;
use App\Models\Fornecedor;
use App\Repositories\Fornecedores\Contratos\FornecedorEloquentRepositoryInterface;
use App\Services\Fornecedores\BuscadorDeFornecedorService;
use Illuminate\Support\Collection;

test('`busqueMuitosFiltrandoEOrdernando` busca muitos fornecedores filtrando pelo nome', function () {
    $mockRepo = Mockery::mock(FornecedorEloquentRepositoryInterface::class);
    $mockRepo->shouldReceive('listarFiltrandoEOrdernando')
        ->once()
        ->withArgs(function(FiltrarFornecedorDto $dto) {
            return $dto->nome == 'Fornecedor A'
                && $dto->ordernarPor == 'created_at'
                && $dto->ordernarDirecao == 'desc';
        })
        ->andReturn(collect([new Fornecedor(['nome' => 'Fornecedor A'])]));

    $service = new BuscadorDeFornecedorService($mockRepo);

    $result = $service->busqueMuitosFiltrandoEOrdernando(['nome' => 'Fornecedor A']);
    expect($result)->toBeInstanceOf(Collection::class);
    expect($result->first()->nome)->toBe('Fornecedor A');
});

test('`busqueUmPorAtributo` busca um fornecedor por atributo', function () {
    $mockRepo = Mockery::mock(FornecedorEloquentRepositoryInterface::class);
    $mockRepo->shouldReceive('encontrePorAtributo')
        ->once()
        ->withArgs(function(EncontrePorAtributoDto $dto) {
            return $dto->atributo == 'cnpj'
                && $dto->valor == '50941621000148';
        })
        ->andReturn(new Fornecedor(['id' => 1, 'cnpj' => '50941621000148']));

    $service = new BuscadorDeFornecedorService($mockRepo);

    $result = $service->busqueUmPorAtributo('cnpj', '50941621000148');
    expect($result)->toBeInstanceOf(Fornecedor::class);
    expect($result->cnpj)->toBe('50941621000148');
});

test('`busqueUmPorAtributo` retorna null ao não encontrar fornecedor por atributo', function () {
    $mockRepo = Mockery::mock(FornecedorEloquentRepositoryInterface::class);
    $mockRepo->shouldReceive('encontrePorAtributo')
        ->once()
        ->withArgs(function(EncontrePorAtributoDto $dto) {
            return $dto->atributo == 'id'
                && $dto->valor == 999;
        })
        ->andReturn(null);

    $service = new BuscadorDeFornecedorService($mockRepo);

    $result = $service->busqueUmPorAtributo('id', 999);
    expect($result)->toBeNull();
});