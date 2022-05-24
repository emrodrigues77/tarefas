<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Classe controladora de ações relacionadas às tela principal do sistema
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Mostra a tela principal do aplicativo
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $tasks = Auth::user()->tasks;
        $allTasksCount = Auth::user()->tasksCount();
        $finishedTasksCount = Auth::user()->tasksCount(1);
        $unfinishedTasksCount = Auth::user()->tasksCount(0);
        return view('home', compact('tasks', 'allTasksCount', 'finishedTasksCount', 'unfinishedTasksCount'));
    }
}