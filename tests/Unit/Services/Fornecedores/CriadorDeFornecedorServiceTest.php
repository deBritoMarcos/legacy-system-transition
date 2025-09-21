<?php

use App\Services\Fornecedores\CriadorDeFornecedorService;
use App\Repositories\Fornecedores\Contratos\FornecedorEloquentRepositoryInterface;
use App\Services\Fornecedores\Contratos\BuscadorDeFornecedorServiceInterface;
use App\Exceptions\Documento\CnpjJaCadastradoException;
use App\Models\Fornecedor;

test('`criar` cria fornecedor com sucesso se CNPJ ainda não foi cadastrado', function () {
    $mockRepo = Mockery::mock(FornecedorEloquentRepositoryInterface::class);
    $mockBuscador = Mockery::mock(BuscadorDeFornecedorServiceInterface::class);

    $mockBuscador->shouldReceive('busqueUmPorAtributo')
        ->with('cnpj', '12345678000190')
        ->andReturn(null);

    $mockRepo->shouldReceive('salvar')
        ->once()
        ->andReturn(new Fornecedor([
            'nome' => 'Fornecedor X', 
            'cnpj' => '12345678000190',
            'email' => 'teste@teste.com',
        ]));

    $service = new CriadorDeFornecedorService($mockRepo, $mockBuscador);

    $dados = [
        'nome' => 'Fornecedor X',
        'cnpj' => '12345678000190',
        'email' => 'teste@teste.com',
    ];

    $fornecedor = $service->criar($dados);

    expect($fornecedor)->toBeInstanceOf(Fornecedor::class);
    expect($fornecedor)
        ->nome->toBe('Fornecedor X')
        ->cnpj->toBe('12345678000190')
        ->email->toBe('teste@teste.com');
});

test('`criar` higieniza o CNPJ caso venha com separadores', function () {
    $mockRepo = Mockery::mock(FornecedorEloquentRepositoryInterface::class);
    $mockBuscador = Mockery::mock(BuscadorDeFornecedorServiceInterface::class);

    $mockBuscador->shouldReceive('busqueUmPorAtributo')
        ->with('cnpj', '12345678000190')
        ->andReturn(null);

    $mockRepo->shouldReceive('salvar')
        ->once()
        ->andReturn(new Fornecedor(['nome' => 'Fornecedor X', 'cnpj' => '12345678000190']));

    $service = new CriadorDeFornecedorService($mockRepo, $mockBuscador);

    $dados = [
        'nome' => 'Fornecedor X',
        'cnpj' => '12.345.678/0001-90',
        'email' => 'teste@teste.com',
    ];

    $fornecedor = $service->criar($dados);

    expect($fornecedor->cnpj)->toBe('12345678000190');
});

test('`criar` lança exceção se CNPJ já cadastrado', function () {
    $mockRepo = Mockery::mock(FornecedorEloquentRepositoryInterface::class);
    $mockBuscador = Mockery::mock(BuscadorDeFornecedorServiceInterface::class);

    $mockBuscador->shouldReceive('busqueUmPorAtributo')
        ->with('cnpj', '12345678000190')
        ->andReturn(new Fornecedor(['nome' => 'Fornecedor Existente', 'cnpj' => '12345678000190']));

    $service = new CriadorDeFornecedorService($mockRepo, $mockBuscador);

    $dados = [
        'nome' => 'Fornecedor Novo',
        'cnpj' => '12345678000190',
        'email' => 'novo@teste.com',
    ];

    $this->expectException(CnpjJaCadastradoException::class);
    $service->criar($dados);
});