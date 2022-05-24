<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * Classe que controla o componente que exibe as tarefas em uma tabela
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class TasksDatatable extends Component {

    /**
     * Tarefa gerenciada pelo componente
     *
     * @var App\Http\Models\Task
     */
    protected $tasks;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tasks) {
        $this->tasks = $tasks;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.common.tasks-datatable', ['tasks' => $this->tasks]);
    }
}