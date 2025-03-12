@props([
    'isInvalid' => false,
    'name'
])

<input id="{{$name}}" name="{{$name}}" {{ $attributes->merge(['class' => 'form-control' . ($isInvalid ? ' is-invalid' : '')]) }}>