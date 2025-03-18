@props(['title', 'route', 'linkText', 'icon'])
<div class="p-3 mb-3 rounded bg-warning-subtle d-flex justify-content-between align-items-center">
    <h4 class="p-0 m-0">{{ $title }}</h4>
    <a {{ $attributes->merge(['class' => 'btn']) }} href="{{ $route ?? '#' }}"><i class="{{ $icon ?? 'fa-solid fa-arrow-left' }}"></i> {{ $linkText }}</a>
</div>