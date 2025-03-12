@props(['errors'])

@if ($errors)
    @foreach ($errors as $error)
        <div class="my-2 text-danger ms-2">{{ $error }}</div>
    @endforeach
@endif