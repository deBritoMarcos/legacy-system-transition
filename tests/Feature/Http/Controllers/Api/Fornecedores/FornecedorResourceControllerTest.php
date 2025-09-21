<?php

use App\Models\Fornecedor;
use Illuminate\Http\Response;

test('`salvar` salva fornecedor com sucesso', function () {
    $request = [
        'nome' => 'Fornecedor X',
        'cnpj' => '50941621000148',
        'email' => 'teste@teste.com',
    ];

    $response = $this->postJson(route('api.fornecedores.salvar', $request))
        ->assertStatus(Response::HTTP_CREATED);

    $data = $response->getData(true)['data'];

    expect($data['nome'])->toBe('Fornecedor X');
    expect($data['cnpj'])->toBe('50941621000148');
    expect($data['email'])->toBe('teste@teste.com');

    $this->assertDatabaseHas('fornecedores', [
        'nome' => 'Fornecedor X',
        'cnpj' => '50941621000148',
        'email' => 'teste@teste.com',
    ]);
});

test('`salvar` retorna erro 422 e mensagem de CNPJ duplicado', function () {
    Fornecedor::factory()->create(['cnpj' => '50941621000148']);

    $request = [
        'nome' => 'Fornecedor X',
        'cnpj' => '50941621000148',
        'email' => 'teste@teste.com',
    ];

    $response = $this->postJson(route('api.fornecedores.salvar', $request))
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    
    $data = $response->getData(true)['data'];
    expect($data['errors']['cnpj'][0])->toBe('O valor indicado para o campo cnpj já cadastrado no sistema.');

    expect(Fornecedor::where('cnpj', '50941621000148')->count())->toBe(1);
});

test('`salvar` mostre o erro 422 quando passado um valor invalido', function ($nome, $cnpj, $email) {
    $request = [
        'nome' => $nome,
        'cnpj' => $cnpj,
        'email' => $email,
    ];

    $this->postJson(route('api.fornecedores.salvar', $request))
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    $this->assertDatabaseEmpty('fornecedores');
})
->with([
    'nome não informado' => [null, '50941621000148', 'teste@teste.com'],
    'nome minimo não atingido' => ['a', '50941621000148', 'teste@teste.com'],
    'nome máximo excedido' => [str_repeat('a', 256), '50941621000148', 'teste@teste.com'],
    'cnpj não informado' => ['Fornecedor X', null, 'teste@teste.com'],
    'cnpj inválido' => ['Fornecedor X', '50941621000199', 'teste@teste.com'],
    'email não é válido' => ['Fornecedor X', '50941621000148', 'teste'],
    'email máximo excedido' => ['Fornecedor X', '50941621000148', str_repeat('a', 256) . '@teste.com'],
]);