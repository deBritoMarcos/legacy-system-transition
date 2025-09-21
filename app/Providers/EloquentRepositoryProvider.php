<?php

namespace App\Providers;

use App\Repositories\Fornecedores\Contratos\FornecedorEloquentRepositoryInterface;
use App\Repositories\Fornecedores\FornecedorEloquentRepository;
use Illuminate\Support\ServiceProvider;

class EloquentRepositoryProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            FornecedorEloquentRepositoryInterface::class,
            FornecedorEloquentRepository::class
        );
    }
}