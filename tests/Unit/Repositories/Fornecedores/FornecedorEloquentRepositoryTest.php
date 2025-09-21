<?php

use App\Dtos\Fornecedores\EncontrePorAtributoDto;
use App\Dtos\Fornecedores\FiltrarFornecedorDto;
use App\Dtos\Fornecedores\SalvarFornecedorDto;
use App\Models\Fornecedor;
use App\Repositories\Fornecedores\FornecedorEloquentRepository;

test('`listarFiltrandoEOrdernando` lista fornecedores filtrando por nome', function () {
    Fornecedor::factory(2)
        ->sequence(
            ['nome' => 'Fornecedor A'],
            ['nome' => 'Fornecedor B']
        )
        ->create();

    $repo = new FornecedorEloquentRepository();

    $dto = new FiltrarFornecedorDto(nome: 'Fornecedor A');
    $result = $repo->listarFiltrandoEOrdernando($dto);

    expect($result)->toHaveCount(1);
    expect($result->first()->nome)->toBe('Fornecedor A');
});

test('`listarFiltrandoEOrdernando` lista fornecedores ordenando conforme filtro', function () {
    Fornecedor::factory(2)
        ->sequence(
            ['created_at' => '2025-09-19 11:45:00'],
            ['created_at' => '2025-09-20 11:45:00']
        )
        ->create();

    $repo = new FornecedorEloquentRepository();

    $dto = new FiltrarFornecedorDto();
    $result = $repo->listarFiltrandoEOrdernando($dto);
    
    expect($result)
        ->sequence(
            fn ($fornecedor) => $fornecedor->created_at->format('Y-m-d H:i:s')->toBe('2025-09-20 11:45:00'),
            fn ($fornecedor) => $fornecedor->created_at->format('Y-m-d H:i:s')->toBe('2025-09-19 11:45:00'),
        );
});

test('`listarFiltrandoEOrdernando` lista fornecedores sem filtro', function () {
    Fornecedor::factory(2)->create();

    $repo = new FornecedorEloquentRepository();

    $dto = new FiltrarFornecedorDto();
    $result = $repo->listarFiltrandoEOrdernando($dto);

    expect($result)->toHaveCount(2);
});

test('`encontrePorAtributo` encontra fornecedor por atributo', function () {
    $fornecedor = Fornecedor::factory()->create(['cnpj' => '12345678000190']);

    $repo = new FornecedorEloquentRepository();

    $dto = new EncontrePorAtributoDto('cnpj', '12345678000190');
    $encontrado = $repo->encontrePorAtributo($dto);

    expect($encontrado)->not->toBeNull();
    expect($encontrado->id)->toBe($fornecedor->id);
});

test('`encontrePorAtributo` retorna null se não encontrar por atributo', function () {
    $repo = new FornecedorEloquentRepository();

    $dto = new EncontrePorAtributoDto('cnpj', '99999999999999');
    $encontrado = $repo->encontrePorAtributo($dto);

    expect($encontrado)->toBeNull();
});

test('`salvar` salva fornecedor com sucesso', function () {
    $repo = new FornecedorEloquentRepository();

    $dto = new SalvarFornecedorDto(
        nome: 'Fornecedor Teste',
        cnpj: '12345678000190',
        email: 'usuario.test@email.com'
    );
    $fornecedor = $repo->salvar($dto);

    expect($fornecedor)->toBeInstanceOf(Fornecedor::class);
    expect($fornecedor)
        ->nome->toBe('Fornecedor Teste')
        ->cnpj->toBe('12345678000190')
        ->email->toBe('usuario.test@email.com');
});