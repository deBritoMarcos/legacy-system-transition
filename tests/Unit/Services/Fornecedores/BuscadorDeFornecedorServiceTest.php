<?php

use App\Dtos\Fornecedores\EncontrePorAtributoDto;
use App\Models\Fornecedor;
use App\Repositories\Fornecedores\Contratos\FornecedorEloquentRepositoryInterface;
use App\Services\Fornecedores\BuscadorDeFornecedorService;

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