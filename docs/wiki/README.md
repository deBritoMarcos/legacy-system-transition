# Guia de Desenvolvimento

Este documento descreve os principais padrões e práticas que devem ser seguidos por toda a equipe durante o desenvolvimento do projeto.

## 1. Estrutura do Projeto

O projeto está organizado em camadas distintas para garantir separação de responsabilidades, facilidade de manutenção e escalabilidade. As principais camadas são:

- **Controllers**: Responsáveis por receber as requisições, validar dados iniciais e orquestrar a chamada dos serviços.
- **Services**: Contêm as regras de negócio e lógica da aplicação, centralizando as operações principais.
- **Repositories**: Realizam a comunicação com a base de dados, encapsulando as operações de persistência e consultas.
- **Models**: Representam as entidades e tabelas do banco de dados, incluindo relacionamentos e atributos.

Cada camada possui sua própria pasta, sendo que as dependências entre camadas seguem sempre a ordem: Controller → Service → Repository → Model.

## 2. Padrões de Desenvolvimento

- **Nomenclatura**: Todos os arquivos, classes, métodos e variáveis devem ser nomeados em **português**, refletindo seu propósito de forma clara.
- **Sufixos**: Os arquivos principais devem conter um sufixo que indique sua finalidade:
  - Serviços: `NomeDoServicoService.php`
  - Repositórios: `NomeDoRepositorioRepository.php`
  - Controladores: `NomeDoControladorController.php`
  - Requests: `NomeDaRequestRequest.php`
  - Resources: `NomeDoRecursoResource.php`
- **Consistência**: Mantenha sempre a padronização adotada em todo o projeto, facilitando legibilidade e colaboração.

## 3. Testes

- **Testes Unitários**: Devem cobrir obrigatoriamente:
  - **Happy Path**: Fluxo de sucesso da funcionalidade.
  - **Fail Paths**: Todos os caminhos de falha ou exceção possíveis.
  - **Validações**: Teste de todas as regras de validação dos dados.
  - **Regras de Negócio**: Cobertura das principais regras e particularidades do negócio.

- **Testes de Feature**:
  - Devem validar toda a funcionalidade de ponta a ponta, simulando o uso real do sistema.
  - Podem omitir a comunicação com sistemas terceiros, devendo ser simulada ou mockada quando necessário.

Siga sempre estes padrões para garantir qualidade, uniformidade e fácil manutenção do código.