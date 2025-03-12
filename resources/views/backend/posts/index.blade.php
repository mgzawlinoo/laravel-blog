@extends('backend.layouts.app')

@section('title', 'Post List')

@section('content')

   <x-header class="btn-primary" title="Post List" :route="route('backend.posts.create')" icon="fa-solid fa-plus"  linkText="Create">
   </x-header>

    @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif

    @if(session('search'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('search') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
            Search Result for : {{ $q }} <a href="{{ route('backend.posts.index') }}" class="btn btn-secondary btn-sm">Clear</a>
        </div>
    @endisset

    <div class="table-responsive">
        <table class="table text-center align-middle table-striped">
            <thead>
                <tr>
                    <th class="text-start">#</th>
                    <th class="text-start">Title</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Author</th>
                    <th class="text-center">Updated At</th>
                    <th class="text-center">Published</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td class="text-start">{{ $posts->firstItem() + $loop->index }}</td>
                        <td class="text-start">{!! redColor($post->title) !!}</td>
                        <td class="text-center"> <img src="{{ $post->photo ? asset('storage/' . $post->photo) : 'https://placehold.co/50x50/DDD/333' }}" alt="Post Photo" style="max-width: 100%; height: 50px">
                        <td class="text-center">{{ $post->category->name }}</td>
                        <td class="text-center">{{ $post->user->name }}</td>
                        <td class="text-center">{{ $post->updated_at->diffForHumans() }}</td>
                        <td class="text-center">{{ $post->published ? 'Yes' : 'No' }}</td>
                        <td class="text-end">

                            <div class="gap-2 d-grid d-md-flex justify-content-md-end">
                                <a href="{{ route('backend.posts.show', $post->slug) }}" class="btn btn-primary btn-sm"><i class="text-white fa-regular fa-eye"></i></a>
                                <a href="{{ route('backend.posts.edit', $post->slug) }}" class="btn btn-warning btn-sm"><i class="text-white fa-regular fa-pen-to-square"></i></a>
                                <form action="{{ route('backend.posts.destroy', $post->slug) }}" method="POST" class="btn btn-danger btn-sm">
                                    @csrf
                                    @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" type="submit" class="bg-transparent border-0"><i class="text-white fa-regular fa-trash-can"></i></button>
                            </form>
                        </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">
                        <div class="pt-4">
                            {{ $posts->withQueryString()->links() }}
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>


@endsection
