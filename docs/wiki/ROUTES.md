# Guia de Utilização das Rotas - `api.php`

Este documento descreve as rotas disponíveis no arquivo `api.php`, incluindo exemplos de requisição e os possíveis formatos de resposta.

---

## Sumário

- [1. Criar Fornecedor](#1-criar-fornecedor)
- [2. Listar Fornecedores](#2-listar-fornecedores)

---

## 1. Criar Fornecedor

- **Rota:** `POST /api/fornecedores`
- **Descrição:** Cria um novo fornecedor.

### Exemplo de Requisição

```http
POST /api/fornecedores HTTP/1.1
Content-Type: application/json

{
  "nome": "Fornecedor Exemplo",
  "cnpj": "12345678000199",
  "email": "contato@exemplo.com"
}
```

### Possíveis Respostas

#### Sucesso

```json
Status: 201 Created
{
    "data": {
        "id": 8,
        "nome": "Fornecedor X",
        "cnpj": "32692566000118",
        "email": "malaquias@gmail.com",
        "created_at": "2025-09-21T04:31:22.000000Z",
        "updated_at": "2025-09-21T04:31:22.000000Z"
    }
}
```

#### Erro de Validação

```json
Status: 422 Unprocessable Entity
{
    "message": "O campo cnpj deve conter 14 digitos.",
    "errors": {
        "cnpj": [
            "O campo cnpj deve conter 14 digitos."
        ]
    }
}
```
---

## 2. Listar Fornecedores

- **Rota:** `GET /api/fornecedores`
- **Descrição:** Lista fornecedores cadastrados. Aceita parâmetro opcional de busca por nome.

### Parâmetros de Consulta

| Parâmetro | Tipo   | Descrição                    |
|-----------|--------|------------------------------|
| `nome`    | string | (opcional) Filtro por nome   |

### Exemplo de Requisição

```http
GET /api/fornecedores?nome=Exemplo HTTP/1.1
```

### Possíveis Respostas

#### Sucesso

```json
Status: 200 OK
{
    "data": [
        {
            "id": 5,
            "nome": "Paz e Espinoza",
            "cnpj": "56485869000128",
            "email": "rosana24@example.com",
            "created_at": "2025-09-21T04:20:10.000000Z",
            "updated_at": "2025-09-21T04:20:10.000000Z"
        },
        {
            "id": 6,
            "nome": "Soares Ltda.",
            "cnpj": "27505589000136",
            "email": "dteles@example.com",
            "created_at": "2025-09-21T04:20:10.000000Z",
            "updated_at": "2025-09-21T04:20:10.000000Z"
        },
    ]
}
```

#### Nenhum resultado

```json
Status: 200 OK
{
    "data": []
}
```

> **Dica:** Todas as rotas retornam respostas em formato JSON.
>  
> Para autenticação ou headers adicionais, consulte a documentação geral do projeto.
