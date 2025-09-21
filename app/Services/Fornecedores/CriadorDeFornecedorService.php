<?php

namespace App\Services\Fornecedores;

use App\Dtos\Fornecedores\SalvarFornecedorDto;
use App\Exceptions\Documento\CnpjJaCadastradoException;
use App\Helpers\DocumentoHelper;
use App\Models\Fornecedor;
use App\Repositories\Fornecedores\Contratos\FornecedorEloquentRepositoryInterface;
use App\Services\Fornecedores\Contratos\BuscadorDeFornecedorServiceInterface;
use App\Services\Fornecedores\Contratos\CriadorDeFornecedorServiceInterface;

class CriadorDeFornecedorService implements CriadorDeFornecedorServiceInterface
{
    public function __construct(
        private FornecedorEloquentRepositoryInterface $fornecedorRepository,
        private BuscadorDeFornecedorServiceInterface $buscadorDeFornecedorService,
    ) {}
    
    /**
     * @throws CnpjJaCadastradoException
     */
    public function criar(array $fornecedorData): Fornecedor
    {
        $fornecedorDto = SalvarFornecedorDto::fromArray([
            'nome' => $fornecedorData['nome'],
            'cnpj' => $this->higienizarCnpjSeNecessario($fornecedorData['cnpj']),
            'email' => $fornecedorData['email'] ?? null,
        ]);

        if ($this->cnpjJaCadastrado($fornecedorDto->cnpj)) {
            throw new CnpjJaCadastradoException();
        }

        return $this->fornecedorRepository->salvar($fornecedorDto);
    }

    private function higienizarCnpjSeNecessario(string $cnpj): string
    {
        if (!DocumentoHelper::temSeparadores($cnpj)) {
            return $cnpj;
        }

        return DocumentoHelper::removerSeparadores($cnpj);
    }

    private function cnpjJaCadastrado(string $cnpj): bool
    {
        $fornecedor = $this->buscadorDeFornecedorService
            ->busqueUmPorAtributo('cnpj', $cnpj);

        return !empty($fornecedor);
    }
}