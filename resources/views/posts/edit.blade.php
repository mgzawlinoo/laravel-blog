@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="mb-3 d-flex justify-content-between align-items-center border-bottom">
                <h2>Edit Post</h2>
                <a class="btn btn-secondary" href="{{ route('posts.index') }}"><i class="text-white fa-solid fa-arrow-left"></i> Back</a>
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

                    <form action="{{ route('posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ old('title', $post->title) }}">
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{$post->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="user_id" class="form-label">User</label>
                            <select class="form-select" id="user_id" name="user_id">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{$post->user_id == $user->id ? 'selected' : ''}}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Upload Image</label>
                            <div class="gap-3 d-flex align-items-center">
                                <div id="preview-image"><img src="@if($post->photo) {{ asset('storage/' . $post->photo) }} @else https://placehold.co/150   @endif" class="rounded-circle" style="max-width: 150px; height: auto" alt="Photo"></div>
                                <input type="file" class="form-control" id="photo" name="photo">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control" id="content" name="content" rows="6" placeholder="Enter content">{{ old('content', $post->content) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    const chooseFile = document.getElementById("photo");
    const imgPreview = document.getElementById("preview-image");

    chooseFile.addEventListener("change", function () {
        getImgData();
    });

    function getImgData() {
        const files = chooseFile.files[0];
        if (files) {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);
            fileReader.addEventListener("load", function () {
            imgPreview.style.display = "block";
            imgPreview.innerHTML = '<img class="rounded-circle" style="max-width: 150px; height: auto" alt="Teacher" src="' + this.result + '" />';
            });
        }
    }
</script>

@endsection
