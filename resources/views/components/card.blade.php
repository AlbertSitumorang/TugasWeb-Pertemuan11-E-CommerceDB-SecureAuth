@props(['title' => null, 'hover' => false])

<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl shadow-sm ring-1 ring-slate-100 p-6' . ($hover ? ' hover-lift' : '')]) }}>
    @if ($title)
        <h2 class="font-bold text-lg mb-3 text-slate-900">{{ $title }}</h2>
    @endif
    {{ $slot }}
</div>
