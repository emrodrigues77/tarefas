<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Traits\BearerToken;
use Illuminate\Http\Request;

/**
 * Classe controladora de ações relacionadas aos usuários que são enviadas via API
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class UserController {

    // traits utilizados pela classe
    use BearerToken;

    /**
     * Armazena a resposta retornada às requisições via API
     *  
     * @var Illuminate\Http\Response
     */
    private $response;

    /**
     * Retorna uma resposta com a contagem de tarefas relacionadas a um determinado usuário, filtrando-as por status de conclusão
     *
     * @param User $user Usuário que fez a requisição
     * @param Request $request Requisição recebida
     * @param string $status Estado de conclusão
     * @return Illuminate\Http\Response
     */
    private function getTasksCount(User $user, Request $request, $status = "%") {
        try {
            if ($this->checkToken($request) === true) {
                $tasksCount = $user->tasksCount($status);

                $this->response = response()->json([
                    'tasksCount' => $tasksCount,
                ], 200);
            }
        } catch (\Exception $ex) {
            $this->response = response('Ocorreu um erro ao processar sua requisição. Código do erro: ' . $ex->getCode(), 400);
        } finally {
            return $this->response;
        }
    }

    /**
     * Retorna uma resposta com o número total de tarefas do usuário
     *
     * @param User $user Usuário que fez a requisição
     * @param Request $request Requisição recebida
     * @return Illuminate\Http\Response
     */
    public function getAllTasksCount(User $user, Request $request) {
        return $this->getTasksCount($user, $request);
    }

    /**
     * Retorna uma resposta com o número de tarefas não concluídas do usuário
     *
     * @param User $user Usuário que fez a requisição
     * @param Request $request Requisição recebida
     * @return Illuminate\Http\Response
     */
    public function getUnfinishedTasksCount(User $user, Request $request) {
        return $this->getTasksCount($user, $request, 0);
    }

    /**
     * Retorna uma resposta com o número de tarefas concluídas do usuário
     *
     * @param User $user Usuário que fez a requisição
     * @param Request $request Requisição recebida
     * @return Illuminate\Http\Response
     */
    public function getFinishedTasksCount(User $user, Request $request) {
        return $this->getTasksCount($user, $request, 1);
    }

    /**
     * Retorna uma resposta com todas as estatísticas de tarefas do usuário
     *
     * @param User $user Usuário que fez a requisição
     * @param Request $request Requisição recebida   
     * @return Illuminate\Http\Response
     */
    public function getTasksStats(User $user, Request $request) {
        try {
            if ($this->checkToken($request) === true) {
                $tasks = $user->tasksCount("%");
                $finished = $user->tasksCount("1");
                $unfinished = $user->tasksCount("0");

                $this->response = response()->json([
                    'totalTasks' => $tasks,
                    'finishedTasks' => $finished,
                    'unfinishedTasks' => $unfinished
                ], 200);
            }
        } catch (\Exception $ex) {
            $this->response = response('Ocorreu um erro ao processar sua requisição. Código do erro: ' . $ex->getCode(), 400);
        } finally {
            return $this->response;
        }
    }

    /**
     * Retorna uma resposta com as tarefas relacionadas a um determinado usuário, filtrando-as por status de conclusão
     *
     * @param User $user Usuário que fez a requisição
     * @param Request $request Requisição recebida
     * @param string $status Estado de conclusão
     * @return Illuminate\Http\Response
     */
    private function getTasks(User $user, Request $request, $status = "%") {
        try {
            if ($this->checkToken($request) === true) {
                $tasks = $user->tasks()->where("finished", "LIKE", $status)->get();

                $this->response = response()->json([
                    'httpCode' => '200',
                    'status' => 'Ok',
                    'tasks' => $tasks,
                ], 200);
            }
        } catch (\Exception $ex) {
            $this->response = response('Ocorreu um erro ao processar sua requisição. Código do erro: ' . $ex->getCode(), 400);
        } finally {
            return $this->response;
        }
    }

    /**
     * Retorna uma resposta com todas as tarefas do usuário
     *
     * @param User $user Usuário que fez a requisição
     * @param Request $request Requisição recebida
     * @return Illuminate\Http\Response
     */
    public function getAllTasks(User $user, Request $request) {
        return $this->getTasks($user, $request, "%");
    }

    /**
     * Retorna uma resposta com todas as tarefas não concluídas do usuário
     *
     * @param User $user Usuário que fez a requisição
     * @param Request $request Requisição recebida
     * @return Illuminate\Http\Response
     */
    public function getFinishedTasks(User $user, Request $request) {
        return $this->getTasks($user, $request, "1");
    }

    /**
     * Retorna uma resposta com todas as tarefas concluídas do usuário
     *
     * @param User $user Usuário que fez a requisição
     * @param Request $request Requisição recebida
     * @return Illuminate\Http\Response
     */
    public function getUnfinishedTasks(User $user, Request $request) {
        return $this->getTasks($user, $request, "0");
    }
}