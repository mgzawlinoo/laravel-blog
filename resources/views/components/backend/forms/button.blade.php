<div class="mt-3 text-end">
    <button {{ $attributes->merge(['class' => 'btn btn-primary', 'type' => 'submit']) }}>
        {{ $slot }}
    </button>
</div>