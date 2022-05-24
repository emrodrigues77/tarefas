<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12 p-3 rounded">
            <h2 class="border p-2 bg-primary text-white rounded">
                <i class="fa-solid fa-list-check"></i>
                Minhas Tarefas
            </h2>

            @if (Session::has('task-deleted-message'))
                <div class="alert alert-danger">{{ session('task-deleted-message') }}</div>
            @elseif (Session::has('task-created-message'))
                <x-common.alert type="alert alert-success" icon="fa-circle-info" :message="session('task-created-message')" />
            @elseif (Session::has('task-updated-message'))
                <x-common.alert type="alert alert-info" icon="fa-circle-info" :message="session('task-updated-message')" />
            @elseif (Session::has('task-new-status-message'))
                <x-common.alert type="alert alert-warning" icon="fa-circle-info" :message="session('task-new-status-message')" />
            @endif

            <div>
                <table class="table table-bordered table-hover table-responsive mt-2" id="dataTable" width="100%"
                    cellspacing="0">
                    <caption>Lista de Tarefas</caption>
                    <thead class='table-light'>
                        <tr class="text-start">
                            <th width='55%'>Descrição</th>
                            <th width='15%'>Criada</th>
                            <th width='15%'>Concluída</th>
                            <th width='15%'>Opções</th>
                        </tr>
                    </thead>
                    <tfoot class='table-light'>
                        <tr class="text-start">
                            <th width='55%'>Descrição</th>
                            <th width='15%'>Criada</th>
                            <th width='15%'>Concluída</th>
                            <th width='15%'>Opções</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($tasks as $task)
                            @php
                                $textSuccess = $task->finished == '1';
                                $textDanger = $task->finished == '0';
                                $criada = date('d/m/Y H:i:s', strtotime($task->created_at));
                                $concluida = $task->finished == '1' ? date('d/m/Y H:i:s', strtotime($task->updated_at)) : '----';
                            @endphp

                            <tr @class([
                                'text-success' => $textSuccess,
                                'text-danger' => $textDanger,
                            ])>
                                <td class='fw-bold'>
                                    @if ($task->finished == '1')
                                        <i class="fa-solid fa-circle-check"></i>
                                    @else
                                        <i class="fa-solid fa-circle-exclamation"></i>
                                    @endif

                                    {{ $task->description }}
                                </td>
                                <td>{{ $criada }}</td>
                                <td>{{ $concluida }}</td>
                                <td>
                                    @can('view', $task)
                                        <a href="{{ route('tasks.edit', $task) }}" title="Editar Tarefa"
                                            class='text-decoration-none'>
                                            <i class="fa-solid fa-square-pen fa-xl"></i>
                                        </a>
                                        <a href="{{ route('tasks.destroy', $task) }}" title="Apagar Tarefa"
                                            class='text-decoration-none'>
                                            <i class="text-danger fa-solid fa-circle-minus fa-xl"></i>
                                        </a>

                                        @if ($task->finished === 0)
                                            <a href="{{ route('tasks.status', ['task' => $task, 'status' => 1]) }}"
                                                title="Marcar como Concluída" class='text-decoration-none'>
                                                <i class="text-success fa-solid fa-circle-check fa-xl"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('tasks.status', ['task' => $task, 'status' => 0]) }}"
                                                title="Marcar como não Concluída" class='text-decoration-none'>
                                                <i class="text-warning fa-solid fa-rotate-left fa-xl"></i>
                                            </a>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- scripts e folhas de estilo para renderização da tabela -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
