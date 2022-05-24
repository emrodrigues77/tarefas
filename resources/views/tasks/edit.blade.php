@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12 p-3 rounded">
                <h1 class="display-6">
                    <i class="fa-solid fa-list-check"></i>
                    {{ $title }}
                </h1>

                @php
                    $formAction = $formType === 'new' ? route('tasks.store') : route('tasks.update', $task);
                    $formMethod = $formType === 'new' ? 'POST' : 'PATCH';
                @endphp


                <form action='{{ $formAction }}' method="post" enctype="multipart/form-data">
                    @csrf
                    @method($formMethod)

                    <div class="form-group mt-3">
                        <label for="description">Descrição da Tarefa</label>
                        <input type="text" name="description" id="description"
                            class="form-control @error('description') is-invalid @enderror"
                            value="{{ $task->description }}" />

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <input type="submit" value="Salvar" class="btn btn-primary" />
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
