# Plano de Migração: PHP Estruturado → Laravel

## Objetivo
Modernizar a base de código, facilitar a manutenção e adoção de melhores práticas, utilizando o framework Laravel.

## Projeto Legado
O código fonte do projeto legado se encontra dentro do diretório `./docs/migration/src` juntamente com esse documento, seguindo a seguinte estrutura:

```
projeto/ 
├── docs/      
│   └── migration/         # Pasta contento tudo relacionado a migração
│   │   ├── src/           # Pasta contento código fonte do projeto legado
│   │   └── MIGRATION.md   # Plano de migração
```

## Escopo
A migração ocorrerá de modo incremental, módulo a módulo, para reduzir riscos e permitir entregas e validações parciais. Cada módulo migrado será integrado ao sistema novo e validado antes da migração do próximo.
1. **Dados:** Será realizado um mapeamento completo das tabelas, campos e relacionamentos do banco de dados atual. Serão criadas migrations no Laravel compatíveis com a estrutura vigente, aproveitando recursos de versionamento e rollback.
2. **Campos e Validações:** Os campos de cada entidade serão revisados. Todas as validações presentes no escopo a ser migrado (tipos, obrigatoriedade, formatos, regras de negócio) serão mapeadas e implementadas utilizando as regras de validação do Laravel em Requests e Service Layers.
3. **Padrões e estrutura do projeto:** Para que o projeto mantenha sua consistência e qualidade durante as transições, foi aderido um manual de padronização do projeto que deve servir de guia para todos os desenvolvedores do projeto. Disponível nesse link: [AQUI](../wiki/README.md).

## Etapas
1. **Análise do Sistema Atual**  
   Levantamento de funcionalidades, fluxos, dependências, tabelas e campos do banco.
2. **Planejamento e Priorização**  
   Definição da ordem de migração dos módulos e entidades de dados.
3. **Definição da Arquitetura Laravel**  
   Setup do novo projeto, padrões de código, estrutura de pastas, definição de migrations e integração com serviços externos.
4. **Migração Incremental**  
   Refatoração dos módulos para Laravel, criação das migrations e implementação das validações, criando testes automatizados a cada etapa.
5. **Migração de Dados**  
   Execução de scripts de migração para dados históricos, validação de integridade e testes de consistência.
6. **Testes e Validação**  
   Testes unitários, integração e homologação com usuários-chave, validando campos e regras de negócio.
7. **Deploy e Monitoramento**  
   Publicação da nova aplicação, monitoramento e ajuste de eventuais problemas.

## Riscos e Desafios
- Garantir a fidelidade das regras de negócio e validações.
- Sincronização de dados durante o período de convivência dos sistemas.

## Critérios de Sucesso
- Todas as funcionalidades migradas e validadas.
- Todas as regras e validações de campos mantidas.
- Sem perda de dados.
- Testes automatizados cobrindo ao menos 80% do código.
- Sistema em produção operando conforme esperado.

## Responsabilidades
- Equipe de desenvolvimento: migração, implementação de validações, testes.
- QA: validação e homologação.
- Produto/Negócio: apoio na validação de funcionalidades e regras de negócio.

## Cronograma Resumido
- Início: 01/10/2025
- Término estimado: 01/02/2026
- Revisões semanais de progresso.
