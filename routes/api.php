<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Fornecedores\FornecedorResourceController;

Route::prefix('/fornecedores')->name('fornecedores.')->group(function () {
    Route::get('/', [FornecedorResourceController::class, 'listar'])->name('listar');
    Route::post('/salvar', [FornecedorResourceController::class, 'salvar'])->name('salvar');
});
