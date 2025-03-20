@extends('backend.layouts.app')

@section('title', 'Create Post')

@section('content')

    <x-backend.main.header class="btn-secondary" title="Create Post" :route="route('backend.posts.index')" linkText="Back"></x-backend.main.header>

    <div class="mx-auto col-12 col-md-8">
        <form action="{{ route('backend.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <x-backend.forms.row>
                <x-backend.forms.label for="title">Title</x-backend.forms.label>
                <x-backend.forms.text-input name="title" type="text"
                    :value="old('title')"
                    :isInvalid="$errors->has('title') || $errors->has('slug')"
                />
                <x-backend.forms.error :errors="$errors->get('title')" />
                <x-backend.forms.error :errors="$errors->get('slug')" />
            </x-backend.forms.row>

            <x-backend.forms.row>
                <x-backend.forms.label for="description">Description</x-backend.forms.label>
                <x-backend.forms.text-input name="description" type="text"
                    :value="old('description')"
                    :isInvalid="$errors->has('description')"
                />
                <x-backend.forms.error :errors="$errors->get('description')" />
            </x-backend.forms.row>

            <x-backend.forms.row>
                <x-backend.forms.label for="category_id">Category</x-backend.forms.label>
                <x-backend.forms.select :options="$categories" id="category_id" name="category_id" />
            </x-backend.forms.row>

            <x-backend.forms.row>
                <x-backend.forms.label for="tags">Tags</x-backend.forms.label>
                <x-backend.forms.select class="js-example-basic-multiple" :options="$tags" id="tags" name="tags[]" multiple />
            </x-backend.forms.row>

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

            <x-backend.forms.button class="btn-primary">Submit</x-backend.forms.button>

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
