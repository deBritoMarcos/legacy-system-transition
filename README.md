#  JML Test – Migração projeto legado

Projeto criado como desafio técnico de migração de um projeto legado em PHP estruturado para Laravel 12. 

O projeto possui a seguinte estrutura de pastas:

```
projeto/
├── app/                # Pasta contento o c código principal da aplicação (MVC, Traits, Repositories, Controllers, etc)
├── docs/               # Pasta contento todas as documentações do projeto
│   ├── wiki/           # Pasta contento regras e padrões de desenvolvimento, guia de rotas da API
│   └── migration/      # Pasta contento o plano de migração e código fonte do projeto legado
├── tests/              # Testes unitários e de feature
└── ...                 # Outros arquivos do projeto (.env, composer.json, etc)
```

## Instalação do Projeto

- **Pré-requisitos**

[Docker](https://www.docker.com/get-started) e [Docker Compose](https://docs.docker.com/compose/)

- **Copie o arquivo de ambiente**

```bash
cp .env.example .env && cp .env.testing.example .env.testing 
```

- **Instale as dependencias do projeto**

Se não tiver o Composer instalado em seu computador, use o seguinte comando:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    composer install
```

Se já tiver o Composer instalado localmente, rode o comando:

```bash
composer install
```

- **Crie os containers e levante a aplicação**

```bash
./vendor/bin/sail up -d
```

- **Gere a chave da aplicação**

```bash
./vendor/bin/sail artisan key:generate
```

- **Execute as migrations**

```bash
./vendor/bin/sail artisan migrate
```

- **Popule o banco de dados**

```bash
./vendor/bin/sail artisan db:seed
```

## Acesso

- A API estará disponível em: [http://localhost](http://localhost) (ou a porta configurada no `docker-compose.yml`)

## Comandos úteis

- Parar containers: `./vendor/bin/sail down`
- Rodar os testes: `./vendor/bin/sail test`

## Plano de Migração

O projeto segue um plano de migração, para mais detalhes acompanhar desse [DOCUMENTO](./docs/migration/MIGRATION.md) 

## Wikipidia do projeto

O projeto possui um wikipdia que serve de guia para o projeto seguir um padrão no seu desenvolvimento, para mais detalhes acessar esse [DOCUMENTO](./docs/wiki/README.md). Junto a isso, também é possivel acompanhar um guia de rotas das API nesse [DOCUMENTO](./docs/wiki/ROUTES.md)

## Documentação Oficial do framework

- [Laravel 12](https://laravel.com/docs/12.x).