<?php

namespace App\Providers;

use App\Services\Fornecedores\BuscadorDeFornecedorService;
use App\Services\Fornecedores\Contratos\BuscadorDeFornecedorServiceInterface;
use App\Services\Fornecedores\Contratos\CriadorDeFornecedorServiceInterface;
use App\Services\Fornecedores\CriadorDeFornecedorService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            CriadorDeFornecedorServiceInterface::class,
            CriadorDeFornecedorService::class
        ); 

        $this->app->bind(
            BuscadorDeFornecedorServiceInterface::class,
            BuscadorDeFornecedorService::class
        ); 
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
