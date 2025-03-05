@extends('layouts.app')

@section('title', 'Todo List')

@section('content')

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="mb-3 d-flex justify-content-between align-items-center border-bottom">
                <h2>Todo List</h2>
                <a class="btn btn-primary" href="{{ route('todos.create') }}"><i class="bi bi-plus"></i> Create</a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @isset($q)
                    <div class="alert alert-info d-flex justify-content-between">
                        Search Result for : {{ $q }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endisset

                    <table class="table text-center align-middle table-striped">
                        <thead>
                            <tr>
                                <th class="text-start">Name</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($todos as $todo)
                                <tr>
                                    <td class="text-start">{{ $todo->name }}</td>
                                    <td>
                                        @if($todo->completed)
                                            <span class="badge text-bg-success">Completed</span>
                                        @else
                                            <span class="badge text-bg-danger">Incomplete</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('todos.edit', $todo->id) }}" class="d-inline btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                        </form>
                                        <form action="{{ route('todos.status', $todo->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-info btn-sm">
                                                @if($todo->completed)
                                                <i class="bi bi-x"></i>
                                                @else
                                                    <i class="bi bi-check2"></i>
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

            </div>
        </div>
    </div>
</div>

@endsection
