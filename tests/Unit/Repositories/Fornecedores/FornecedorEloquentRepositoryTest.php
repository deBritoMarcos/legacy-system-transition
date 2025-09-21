<?php

use App\Dtos\Fornecedores\EncontrePorAtributoDto;
use App\Dtos\Fornecedores\SalvarFornecedorDto;
use App\Models\Fornecedor;
use App\Repositories\Fornecedores\FornecedorEloquentRepository;

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