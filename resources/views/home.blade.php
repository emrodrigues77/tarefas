@extends('layouts.app')

@section('content')
    <h1 class="display-6 border p-3 bg-primary text-white rounded shadow">
        <i class="fa-solid fa-gears"></i>
        Painel de Controle
    </h1>

    <div class="row row-cols-4">
        <!-- card para nova tarefa -->
        <div class="col-sm">
            <a href="{{ route('tasks.create') }}" class="text-decoration-none">
                <div class="card text-white bg-info h-100 text-center">
                    <div class="card-body">
                        <i class="display-3 fa-solid fa-square-plus"></i>
                        <p class="card-text">Nova Tarefa</p>
                    </div>
                </div>
            </a>
        </div>
        <!-- cards com estatísticas de tarefas -->
        <x-home.task-count borderType='border-black' count='{{ $allTasksCount }}' textType='text-black'
            text='Tarefas Totais' status='%'>
        </x-home.task-count>
        <x-home.task-count borderType='border-success' count='{{ $finishedTasksCount }}' textType='text-success'
            text='Tarefas Concluídas' status='1'>
        </x-home.task-count>
        <x-home.task-count borderType='border-danger' count='{{ $unfinishedTasksCount }}' textType='text-danger'
            text='Tarefas Incompletas' status='0'>
        </x-home.task-count>
    </div>

    <div class="row">
        <x-tasks-datatable :tasks="$tasks" />
    </div>
@endsection
