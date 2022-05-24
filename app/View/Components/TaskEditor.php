<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * Classe que controla o componente que envia dados para a view que permite a edição/inclusão de tarefas
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class TaskEditor extends Component {


    /**
     * Tarefa gerenciada pelo componente
     *
     * @var App\Http\Models\Task
     */
    protected $task;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($task) {
        $this->task = $task;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        $title = $this->task->id == 0 ? "Nova Tarefa" : "Editar Tarefa";
        $formType = $this->task->id == 0 ? "new" : "update";
        return view('tasks.edit', [
            'task' => $this->task, 'title' => $title, 'formType' => $formType
        ]);
    }
}