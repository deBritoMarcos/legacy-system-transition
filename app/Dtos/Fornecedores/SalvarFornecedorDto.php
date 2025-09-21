<?php

namespace App\Dtos\Fornecedores;

final readonly class SalvarFornecedorDto
{
    public function __construct(
        public string $nome,
        public string $cnpj,
        public ?string $email = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            nome: $data['nome'],
            cnpj: $data['cnpj'],
            email: $data['email'],
        );
    }

    public function toArray(): array
    {
        return [
            'nome' => $this->nome,
            'cnpj' => $this->cnpj,
            'email' => $this->email,
        ];
    }
}