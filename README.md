# RotaCerta API

API REST em Laravel para gestão de pedidos, clientes e itens em estoque. O frontend será desenvolvido em Flutter, em um repositório separado.

**Autor:** Gabriel Vinicius de Oliveira  
**Status:** em desenvolvimento. As rotas abaixo representam o contrato planejado e ainda precisam ser implementadas e testadas.

## Funcionalidades

- Login e logout de usuários.
- CRUD de clientes, categorias, itens e pedidos.
- Consulta de pedidos pendentes, entregues, cancelados e atrasados.
- Consulta de quantidades em estoque, com atualização manual.
- Visualização de etiqueta de entrega pelo aplicativo Flutter.

## Dados principais

| Recurso | Campos previstos |
| --- | --- |
| Clientes | Nome e telefone |
| Categorias | Nome e descrição |
| Itens | Nome, categoria e quantidade em estoque |
| Pedidos | Cliente, item, quantidade, endereço de entrega, prazo máximo e status |

## Rotas planejadas

Todas as rotas usam o prefixo `/api` e respostas JSON. `{id}` representa o identificador do registro.

### Autenticação

| Método | Rota | Descrição | Acesso |
| --- | --- | --- | --- |
| POST | `/api/login` | Autenticar com e-mail e senha e obter um token | Público |
| GET | `/api/me` | Consultar o usuário autenticado | Autenticado |
| POST | `/api/logout` | Encerrar a sessão, revogando o token atual | Autenticado |

Nesta versão, os usuários de demonstração serão criados por seeders; não haverá cadastro público de usuários. As demais rotas exigirão `Authorization: Bearer <token>` e acesso restrito aos registros do usuário autenticado.

### Clientes

| Método | Rota | Descrição |
| --- | --- | --- |
| GET | `/api/clientes` | Listar clientes |
| POST | `/api/clientes` | Cadastrar cliente |
| GET | `/api/clientes/{id}` | Consultar cliente |
| PUT | `/api/clientes/{id}` | Editar cliente |
| DELETE | `/api/clientes/{id}` | Excluir cliente |

### Categorias

| Método | Rota | Descrição |
| --- | --- | --- |
| GET | `/api/categorias` | Listar categorias |
| POST | `/api/categorias` | Cadastrar categoria |
| GET | `/api/categorias/{id}` | Consultar categoria |
| PUT | `/api/categorias/{id}` | Editar categoria |
| DELETE | `/api/categorias/{id}` | Excluir categoria |

### Itens

| Método | Rota | Descrição |
| --- | --- | --- |
| GET | `/api/itens` | Listar itens e quantidades em estoque |
| POST | `/api/itens` | Cadastrar item |
| GET | `/api/itens/{id}` | Consultar item |
| PUT | `/api/itens/{id}` | Editar item, incluindo a quantidade em estoque |
| DELETE | `/api/itens/{id}` | Excluir item |

### Pedidos

| Método | Rota | Descrição |
| --- | --- | --- |
| GET | `/api/pedidos` | Listar pedidos |
| POST | `/api/pedidos` | Cadastrar pedido |
| GET | `/api/pedidos/{id}` | Consultar detalhes do pedido, incluindo cliente e item |
| PUT | `/api/pedidos/{id}` | Editar pedido |
| PATCH | `/api/pedidos/{id}/status` | Alterar status para pendente, entregue ou cancelado |
| DELETE | `/api/pedidos/{id}` | Excluir pedido |

O resumo da tela inicial será calculado no Flutter a partir dos pedidos retornados. A etiqueta também será montada no Flutter usando os dados de `GET /api/pedidos/{id}`. Não haverá rota adicional, geração de PDF ou integração com impressora nesta versão.

## Regras de negócio

- Cada pedido contém um único tipo de item e uma quantidade inteira maior que zero.
- Novos pedidos começam com status `pendente`.
- Os status permitidos são `pendente`, `entregue` e `cancelado`.
- Um pedido é considerado atrasado quando está pendente e sua data limite já passou. Atrasado é uma indicação calculada, não um status salvo.
- A quantidade em estoque é inteira, não negativa e atualizada manualmente.
- Criar, editar, excluir ou cancelar pedidos não altera nem reserva estoque. O estoque disponível não bloqueia o cadastro de pedidos.
- Clientes e itens vinculados a pedidos não podem ser excluídos. Categorias vinculadas a itens também não podem ser excluídas.
- Os vínculos entre pedidos, clientes, itens e categorias devem pertencer ao mesmo usuário autenticado.

## Organização prevista

- **Controllers:** recebem requisições e retornam respostas JSON.
- **Requests:** validam os dados recebidos.
- **Services:** aplicam as regras de negócio.
- **Repositories:** concentram as consultas e gravações no banco.
- **Models:** representam as entidades e seus relacionamentos.
- **Migrations:** definem a estrutura do banco de dados.
- **Factories e Seeders:** preparam dados de demonstração.

## Execução e demonstração

As instruções de instalação, configuração do banco e execução serão adicionadas após a configuração do backend. A demonstração das rotas será disponibilizada em um arquivo `rest.http`.

O arquivo `.env`, senhas reais e tokens de acesso não devem ser enviados ao repositório. O `.env.example` deverá conter apenas configurações de exemplo sem segredos.
