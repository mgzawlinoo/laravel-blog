@extends('backend.layouts.app')

@section('title', 'Create Post')

@section('content')

    <div class="p-3 mb-3 rounded bg-warning-subtle d-flex justify-content-between align-items-center">
        <h4 class="p-0 m-0">Create Post</h4>
        <a class="btn btn-secondary" href="{{ route('backend.posts.index') }}"><i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>

    <div class="mx-auto col-12 col-md-8">
        <form action="{{ route('backend.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @if($errors->has('title') || $errors->has('slug')) is-invalid @endif" id="title" name="title" placeholder="Enter title" value="{{ old('title') }}">
                @error('title')
                    <div class="my-2 text-danger ms-2">{{ $message }}</div>
                @enderror
                @error('slug')
                    <div class="my-2 text-danger ms-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Enter description">{{ old('description') }}</textarea>
                @error('description')
                <div class="my-2 text-danger ms-2">{{ $message }}</div>
                @enderror
        </div>
            

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select class="form-select" id="user_id" name="user_id">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Upload Image</label>
                <div class="gap-3 d-flex align-items-center">
                    <div id="preview-image"><img src="https://placehold.co/150" class="rounded-circle" style="max-width: 150px; height: auto" alt="Photo"></div>
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo">
                </div>
                @error('photo')
                    <div class="my-2 text-danger ms-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 @error('content') border rounded border-danger @enderror" >
                <textarea class="form-control" id="content" name="content" rows="6" placeholder="Enter content">{{ old('content') }}</textarea>
                @error('content')
                    <div class="my-2 text-danger ms-2">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="published" class="form-label">Published</label>
                <input type="checkbox" class="form-check-input" id="published" name="published" value="1" {{ old('published') ? 'checked' : '' }}>
            </div>

            <div class="mt-3 text-end"><button type="submit" class="btn btn-primary">Submit</button></div>
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
