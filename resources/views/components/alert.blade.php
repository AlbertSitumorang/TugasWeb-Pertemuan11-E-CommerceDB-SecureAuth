@props(['type' => 'success', 'message' => null])

@php
    $palette = [
        'success' => ['bg' => 'bg-green-50', 'text' => 'text-green-800', 'bar' => 'border-green-500', 'icon' => '✅'],
        'error'   => ['bg' => 'bg-red-50',   'text' => 'text-red-800',   'bar' => 'border-red-500',   'icon' => '⚠️'],
    ][$type] ?? ['bg' => 'bg-slate-50', 'text' => 'text-slate-800', 'bar' => 'border-slate-400', 'icon' => 'ℹ️'];
@endphp

@if ($message)
    <div {{ $attributes->merge(['class' => "flex items-center gap-3 {$palette['bg']} {$palette['text']} border-l-4 {$palette['bar']} rounded-r-xl px-4 py-3 mb-6 text-sm shadow-sm"]) }}>
        <span class="text-lg">{{ $palette['icon'] }}</span>
        <span>{{ $message }}</span>
    </div>
@endif
