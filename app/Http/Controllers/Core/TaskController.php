<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\View\Components\TaskEditor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Classe controladora de ações relacionadas às tarefas
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class TaskController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->authorize('create', Task::class);
        $task = new Task();
        $editor = new TaskEditor($task);
        return $editor->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request) {
        $task = new Task();
        $task->description = $request['description'];
        $task->user_id = Auth::id();
        $task->save();
        $request->session()->flash('task-created-message', 'Tarefa foi criada com sucesso');
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task) {
        $this->authorize('update', $task);
        $editor = new TaskEditor($task);
        return $editor->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task) {
        $this->authorize('update', $task);
        $task->description = $request['description'];
        $task->update();
        $request->session()->flash('task-updated-message', 'Tarefa foi alterada com sucesso');
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task, Request $request) {
        $this->authorize('delete', $task);
        $task->delete();
        $request->session()->flash('task-deleted-message', 'Tarefa foi excluída com sucesso');
        return back();
    }

    /**
     * Altera o estado de conclusão da tarefa
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function setStatus(Task $task, $status) {
        $this->authorize('update', $task);
        $task->finished = $status;
        $task->update();
        request()->session()->flash('task-new-status-message', 'Status da tarefa alterado com sucesso');
        return redirect('/home');
    }

    /**
     * Retorna uma view com as tarefas do usuário logado, filtrando-as pelo estado de conclusão
     *
     * @param mixed $status Status de conclusão da tarefa
     * @return \Illuminate\Http\Response
     */
    public function showFilteredTasks($status) {
        $tasks = Auth::user()->getFilteredTasks($status)->get();
        $allTasksCount = Auth::user()->tasksCount();
        $finishedTasksCount = Auth::user()->tasksCount(1);
        $unfinishedTasksCount = Auth::user()->tasksCount(0);
        return view('home', compact('tasks', 'allTasksCount', 'finishedTasksCount', 'unfinishedTasksCount'));
    }
}