@extends('layouts.app')

@section('title', 'Todo List')

@section('content')

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="mb-3 d-flex justify-content-between align-items-center border-bottom">
                <h2>Edit Todo</h2>
                <a class="btn btn-secondary" href="{{ route('todos.index') }}"><i class="bi bi-arrow-left"></i> Back</a>
                </div>

                <div class="mx-auto col-md-6">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="name" placeholder="Enter title" value="{{ old('title', $todo->name) }}">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Is Completed? </label>
                            <input type="checkbox" class="form-check-input" id="completed" name="completed" value="1" {{ $todo->completed ? 'checked' : '' }}>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
