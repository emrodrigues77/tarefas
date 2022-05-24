<?php

namespace App\Http\Controllers\API;

use App\Exceptions\UserDoesntOwnTaskException;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Traits\BearerToken;
use App\Traits\TaskOwnership;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Classe controladora de ações relacionadas às tarefas que são enviadas via API
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class TaskController {

    // traits utilizados pela classe
    use BearerToken, TaskOwnership;

    /**
     * Armazena a resposta retornada às requisições via API
     *  
     * @var Illuminate\Http\Response
     */
    private $response;

    /**
     * Grava uma nova tarefa no banco de dados
     *
     * @var TaskRequest $request Requisição recebida
     * @var User $user Usuário que fez a requisição 
     * @return Illuminate\Http\Response
     */
    public function store(TaskRequest $request, User $user) {
        try {
            if ($this->checkToken($request) === true) {
                $task = new Task();
                $task->description = $request['description'];
                $task->user_id = $user->id;
                $task->save();

                $this->response = response()->json([
                    'status' => 'Nova tarefa criada com sucesso'
                ], 200);
            }
        } catch (\Exception $ex) {
            $this->response = response('Ocorreu um erro ao processar sua requisição. Código do erro: ' . $ex->getCode(), 400);
        } finally {
            return $this->response;
        }
    }

    /**
     * Atualiza uma tarefa no banco de dados
     *
     * @var int $user_id Identificador do usuário que fez a requisição
     * @var int $task_id Identificador da tarefa a ser atualizada
     * @var TaskRequest $request Requisição recebida     
     * @return Illuminate\Http\Response
     */
    public function update($user_id, $task_id, Request $request) {
        try {
            if ($this->checkToken($request) === true) {

                if ($this->checkTaskOwner($user_id, $task_id)) {
                    $task = Task::findOrFail($task_id);
                    $task->description = $request['description'];
                    $task->update();

                    $this->response = response()->json([
                        'status' => 'Tarefa atualizada com sucesso'
                    ], 200);
                }
            }
        } catch (UserDoesntOwnTaskException $ex) {
            $this->response = response('Tarefa pertence a outro usuário.', 400);
        } catch (ModelNotFoundException $ex) {
            $this->response = response('Tarefa não encontrada.', 400);
        } catch (\Exception $ex) {
            $this->response = response('Ocorreu um erro ao processar sua requisição. Código do erro: ' . $ex->getCode(), 400);
        } finally {
            return $this->response;
        }
    }

    /**
     * Apaga uma tarefa no banco de dados
     *
     * @var int $user_id Identificador do usuário que fez a requisição
     * @var int $task_id Identificador da tarefa a ser apagada
     * @var TaskRequest $request Requisição recebida     
     * @return Illuminate\Http\Response
     */
    public function destroy($user_id, $task_id, Request $request) {
        try {
            if ($this->checkToken($request) === true) {

                if ($this->checkTaskOwner($user_id, $task_id)) {
                    $task = Task::findOrFail($task_id);
                    $task->delete();

                    $this->response = response()->json([
                        'status' => 'Tarefa deletada com sucesso'
                    ], 200);
                }
            }
        } catch (UserDoesntOwnTaskException $ex) {
            $this->response = response('Tarefa pertence a outro usuário.', 400);
        } catch (ModelNotFoundException $ex) {
            $this->response = response('Tarefa não encontrada.', 400);
        } catch (\Exception $ex) {
            $this->response = response('Ocorreu um erro ao processar sua requisição. Código do erro: ' . $ex->getCode(), 400);
        } finally {
            return $this->response;
        }
    }

    /**
     * Atualiza o status de conclusão de tarefa no banco de dados
     *
     * @var int $user_id Identificador do usuário que fez a requisição
     * @var int $task_id Identificador da tarefa a ser atualizada
     * @var TaskRequest $request Requisição recebida     
     * @return Illuminate\Http\Response
     */
    public function setStatus($user_id, $task_id, $status, Request $request) {
        try {
            if ($this->checkToken($request) === true) {

                if ($this->checkTaskOwner($user_id, $task_id)) {
                    $task = Task::findOrFail($task_id);
                    $task->finished = $status;
                    $task->update();

                    $this->response = response()->json([
                        'status' => 'Tarefa atualizada com sucesso'
                    ], 200);
                }
            }
        } catch (UserDoesntOwnTaskException $ex) {
            $this->response = response('Tarefa pertence a outro usuário.', 400);
        } catch (ModelNotFoundException $ex) {
            $this->response = response('Tarefa não encontrada.', 400);
        } catch (\Exception $ex) {
            $this->response = response('Ocorreu um erro ao processar sua requisição. Código do erro: ' . $ex->getMessage(), 400);
        } finally {
            return $this->response;
        }
    }
}