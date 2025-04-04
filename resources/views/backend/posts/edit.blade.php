@extends('backend.layouts.app')

@section('title', 'Edit Post')

@section('content')

    <x-backend.main.header class="btn-secondary" title="Edit Post" :route="route('backend.posts.index')" linkText="Back"></x-backend.main.header>

    <div class="mx-auto col-md-8">

        <form action="{{ route('backend.posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')


            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @if($errors->has('title') || $errors->has('slug')) is-invalid @endif" id="title" name="title" placeholder="Enter title" value="{{ old('title', $post->title) }}">
                @error('title')
                    <div class="my-2 text-danger ms-2">{{ $message }}</div>
                @enderror
                @error('slug')
                    <div class="my-2 text-danger ms-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Enter description">{{ old('description', $post->description) }}</textarea>
                @error('description')
                <div class="my-2 text-danger ms-2">{{ $message }}</div>
            @enderror
            </div>

            <div class="mb-3 row">
                <div class="col-md-12">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select" id="category_id" name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{$post->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-md-12">
                    <label for="tags" class="form-label">Tags</label>
                    <select class="form-select js-example-basic-multiple"  id="tags" name="tags[]" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" 
                                @foreach ($post->tags as $t)
                                    {{ $t->id === $tag->id ? 'selected': '' }}
                                @endforeach
                                >{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Upload Image</label>
                <div class="gap-3 d-flex align-items-center">
                    <div id="preview-image"><img src="@if($post->photo) {{ asset('storage/' . $post->photo) }} @else https://placehold.co/150   @endif" class="rounded-circle" style="max-width: 150px; height: auto" alt="Photo"></div>
                    <input type="file" class="form-control" id="photo" name="photo">
                </div>
                @error('photo')
                    <div class="my-2 text-danger ms-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 @error('content') border rounded border-danger @enderror">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="6" placeholder="Enter content">{{ old('content', $post->content) }}</textarea>
                @error('content')
                <div class="my-2 text-danger ms-2">{{ $message }}</div>
            @enderror
            </div>

            <div class="mb-3">
                <label for="published" class="form-label">Published</label>
                <input type="checkbox" class="form-check-input" id="published" name="published" value="1" {{ old('published', $post->published) ? 'checked' : '' }}>
            </div>

            <div class="mt-3 text-end"><button type="submit" class="btn btn-warning">Update</button></div>
        </form>
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
