<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Classe que estabelece as políticas para manipulação das tarefas
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class TaskPolicy {
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user) {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Task $task) {
        return $user->id === $task->user_id
            ? Response::allow()
            : Response::deny('Você não é o dono desta tarefa.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user) {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Task $task) {
        return $user->id === $task->user_id
            ? Response::allow()
            : Response::deny('Você não é o dono desta tarefa.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Task $task) {
        return $user->id === $task->user_id
            ? Response::allow()
            : Response::deny('Você não é o dono desta tarefa.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Task $task) {
        return $user->id === $task->user_id
            ? Response::allow()
            : Response::deny('Você não é o dono desta tarefa.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Task $task) {
        return $user->id === $task->user_id
            ? Response::allow()
            : Response::deny('Você não é o dono desta tarefa.');
    }
}