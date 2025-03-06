@extends('layouts.app')

@section('title', 'Post List')

@section('content')

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="mb-3 d-flex justify-content-between align-items-center border-bottom">
                <h2>Post List</h2>
                <a class="btn btn-primary" href="{{ route('posts.create') }}"><i class="text-white fa-regular fa-plus"></i> Create</a>
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
                                <th class="text-start">#</th>
                                <th class="text-start">Title</th>
                                <th class="text-center">Image</th>
                                <th class="text-start">Category</th>
                                <th class="text-start">Author</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td class="text-start">{{ $posts->firstItem() + $loop->index }}</td>
                                    <td class="text-start">{{ $post->title }}</td>
                                    <td class="text-center"> <img src="{{ $post->photo ? asset('storage/' . $post->photo) : 'https://placehold.co/50x50/DDD/333' }}" alt="Post Photo" style="max-width: 100%; height: 50px">
                                    <td class="text-start">{{ $post->category->title }}</td>
                                    <td class="text-start">{{ $post->user->name }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('posts.edit', $post->id) }}" class="d-inline btn btn-warning btn-sm"><i class="text-white fa-regular fa-pen-to-square"></i></a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="text-white fa-regular fa-trash-can"></i></button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <div class="pt-4">
                                        {{ $posts->withQueryString()->links() }}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

            </div>
        </div>
    </div>
</div>

@endsection
