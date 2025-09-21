<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Fornecedores\FornecedorResourceController;

Route::prefix('/fornecedores')->name('fornecedores.')->group(function () {
    Route::post('/salvar', [FornecedorResourceController::class, 'salvar'])->name('salvar');
});
