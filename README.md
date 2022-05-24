# Lista de Tarefas

## Aplicativo

O aplicativo foi desenvolvido com o framework Laravel 9 e PHP 8.1, utilizando de recursos UI do Bootstrap e persistindo os dados num banco de dados MySQL 8.0.

O processo de cadastramento e autenticação de usuários é feito pelo Auth Scaffolding do Boostrap e tokens JWT.

A versão online do aplicativo está disponível em http://www.eduardo.rodrigues.nom.br/tarefas

## API

Todos os endpoints, com exceção da rota de login e de registro de novo usuário estão protegidos pelo sistema de autenticação JWT.

Uma vez que para testá-los com Postman é necessário efetuar o login para obter um token válido, eu desabilitei a função de checagem do token.

### Endpoints da API

**POST /api/v1/login** Efetua o login do usuário

**POST /api/v1/register** Registra um novo usuário

**POST /api/v1/logout** Efetua logoff do usuário

**GET /api/v1/{user}/tasks/all** Lista todas as tarefas do usuário

**GET /api/v1/{user}/tasks/finished** Lista todas as tarefas concluídas do usuário

**GET /api/v1/{user}/tasks/unfinished** Lista todas as tarefas não concluídas do usuário

**GET /api/v1/{user}/tasks/stats** Lista todas as estatísticas de tarefas do usuário

**POST /api/v1/{user}/tasks/store** Salva uma nova tarefa no sistema

**PATCH /api/v1/{user}/tasks/{task}/update** Atualiza uma tarefa

**PATCH /api/v1/{user}/tasks/{task}/status/{status}** Muda o status de uma tarefa

**DELETE /api/v1/{user}/tasks/{task}/destroy** Apaga uma tarefa

**GET /api/v1/{user}/tasks/all/count** Lista o número total de tarefas do usuário

**GET /api/v1/{user}/tasks/finished/count** Lista o número de tarefas concluídas do usuário

**GET /api/v1/{user}/tasks/unfinished/count** Lista o número de tarefas não concluídas do usuário
