<?php

use App\Http\Controllers\API\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\API\UserController;

Route::group([
    'prefix' => 'v1'
], function () {
    // rotas de usuário
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);

    // rotas de tarefas
    Route::get('/{user}/tasks/all', [UserController::class, 'getAllTasks']);
    Route::get('/{user}/tasks/finished', [UserController::class, 'getFinishedTasks']);
    Route::get('/{user}/tasks/unfinished', [UserController::class, 'getUnfinishedTasks']);
    Route::get('/{user}/tasks/stats', [UserController::class, 'getTasksStats']);
    Route::post('/{user}/tasks/store', [TaskController::class, 'store']);
    Route::patch('/{user}/tasks/{task}/update', [TaskController::class, 'update']);
    Route::patch('/{user}/tasks/{task}/status/{status}', [TaskController::class, 'setStatus']);
    Route::delete('/{user}/tasks/{task}/destroy', [TaskController::class, 'destroy']);

    // rotas de estatísticas de tarefas
    Route::get('/{user}/tasks/all/count', [UserController::class, 'getAllTasksCount']);
    Route::get('/{user}/tasks/finished/count', [UserController::class, 'getFinishedTasksCount']);
    Route::get('/{user}/tasks/unfinished/count', [UserController::class, 'getUnfinishedTasksCount']);
});
