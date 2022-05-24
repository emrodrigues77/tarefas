<?php

namespace App\Traits;

use App\Exceptions\UserDoesntOwnTaskException;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Trait que oferece funcionalidades relacionadas aos proprietários de tarefas
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
trait TaskOwnership {

    /**
     * Verifica se a tarefa pertence ao usuário
     *
     * @param int $user_id Identificador do usuário
     * @param int $task_id Identificador da tarefa
     * @return mixed
     */
    public function checkTaskOwner($user_id, $task_id) {
        try {
            $task = Task::findOrFail($task_id);

            if ($task->user_id != $user_id) {
                throw new UserDoesntOwnTaskException('Tarefa não encontrada.');
            } else {
                return true;
            }
        } catch (ModelNotFoundException $ex) {
            $this->response = response('Tarefa não encontrada.', 400);
        } catch (\Throwable $th) {
            throw new UserDoesntOwnTaskException('Tarefa não encontrada.');
        }
    }
}
