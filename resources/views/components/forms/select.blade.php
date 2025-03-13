@props(['options'])
<select {{ $attributes->merge(['class' => 'form-select']) }} >
    @foreach ($options as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
</select>