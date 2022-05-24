<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// grupo de rotas protegidas pelo sistema de autenticação
Route::middleware(['auth'])->group(
    function () {
        Route::get('/home', [App\Http\Controllers\Core\HomeController::class, 'index'])->name('home');
        Route::get('/tasks/create', [App\Http\Controllers\Core\TaskController::class, 'create'])->name('tasks.create');
        Route::get('/tasks/{task}/edit', [App\Http\Controllers\Core\TaskController::class, 'edit'])->name('tasks.edit');
        Route::post('/tasks/store', [App\Http\Controllers\Core\TaskController::class, 'store'])->name('tasks.store');
        Route::patch('/tasks/{task}/update', [App\Http\Controllers\Core\TaskController::class, 'update'])->name('tasks.update');
        Route::get('/tasks/{task}/destroy', [App\Http\Controllers\Core\TaskController::class, 'destroy'])->name('tasks.destroy');
        Route::get('/tasks/{task}/status/{status}', [App\Http\Controllers\Core\TaskController::class, 'setStatus'])->name('tasks.status');
        Route::get('/tasks/{status}', [App\Http\Controllers\Core\TaskController::class, 'showFilteredTasks'])->name('tasks.filtered');
    }
);