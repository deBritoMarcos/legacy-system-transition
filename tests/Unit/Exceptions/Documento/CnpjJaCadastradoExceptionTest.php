<?php

use App\Exceptions\Documento\CnpjJaCadastradoException;
use Illuminate\Http\Response;

test('cria exception com mensagem e status padrão', function () {
    $exception = new CnpjJaCadastradoException();
    expect($exception->getMessage())->toBe('O valor indicado para o campo cnpj já cadastrado no sistema.');
    expect($exception->getCode())->toBe(Response::HTTP_UNPROCESSABLE_ENTITY);
});

test('cria exception com mensagem e status customizados', function () {
    $exception = new CnpjJaCadastradoException('CNPJ já existe!', 400);
    expect($exception->getMessage())->toBe('CNPJ já existe!');
    expect($exception->getCode())->toBe(Response::HTTP_BAD_REQUEST);
});