<?php

use App\Rules\Documento\Cnpj;
use Illuminate\Support\Facades\Validator;

test('passa quando valida um CNPJ válido', function () {
    $data = ['cnpj' => '55.301.471/0001-21'];
    $rules = ['cnpj' => new Cnpj];
    $validator = Validator::make($data, $rules);
   
    expect($validator->passes())->toBeTrue();
});

test('falha se o valor for vazio', function () {
    $data = ['cnpj' => null];
    $rules = ['cnpj' => new Cnpj];
    $validator = Validator::make($data, $rules);

    expect($validator->passes())->toBeFalse();
    expect($validator->errors()->first())->toBe('O campo cnpj deve conter um valor válido.');
});

test('falha se não for string', function () {
    $data = ['cnpj' => 12345678901234];
    $rules = ['cnpj' => new Cnpj];
    $validator = Validator::make($data, $rules);

    expect($validator->passes())->toBeFalse();
    expect($validator->errors()->first())->toBe('O campo cnpj deve conter um valor válido.');
});

test('falha se o tamanho for inválido', function () {
    $data = ['cnpj' => '123'];
    $rules = ['cnpj' => new Cnpj];
    $validator = Validator::make($data, $rules);

    expect($validator->passes())->toBeFalse();
    expect($validator->errors()->first())->toBe('O campo cnpj deve conter 14 digitos.');
});

test('falha se for sequência repetida', function () {
    $data = ['cnpj' => str_repeat('1', 14)];
    $rules = ['cnpj' => new Cnpj];
    $validator = Validator::make($data, $rules);

    expect($validator->passes())->toBeFalse();
    expect($validator->errors()->first())->toBe('O campo cnpj não deve conter numeros repetidos.');
});

test('falha se dígitos verificadores inválidos', function () {
    $data = ['cnpj' => '51.637.683/0001-99'];
    $rules = ['cnpj' => new Cnpj];
    $validator = Validator::make($data, $rules);

    expect($validator->passes())->toBeFalse();
    expect($validator->errors()->first())->toBe('O campo cnpj possui um valor invalido.');
});