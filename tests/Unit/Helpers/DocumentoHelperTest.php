<?php

use App\Helpers\DocumentoHelper;

test('`temSeparadores` identifica separadores em documento corretamente', function () {
    expect(DocumentoHelper::temSeparadores('12.345.678/0001-90'))->toBeTrue();
    expect(DocumentoHelper::temSeparadores('12345678000190'))->toBeFalse();
});

test('`removerSeparadores` remove separadores corretamente', function () {
    $documento = '12.345.678/0001-90';
    $esperado = '12345678000190';
    
    expect(DocumentoHelper::removerSeparadores($documento))->toBe($esperado);
});