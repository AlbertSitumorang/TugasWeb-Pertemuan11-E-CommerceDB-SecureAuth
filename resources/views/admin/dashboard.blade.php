@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900">⚙️ Dashboard Admin</h1>
        <p class="text-sm text-slate-500 mt-1">Ringkasan toko — hanya bisa diakses oleh role <span class="font-semibold">admin</span>.</p>
    </div>

    {{-- Kartu statistik utama --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        @php
            $stats = [
                ['label' => 'Pengguna',  'value' => $totalUsers,    'icon' => '👥', 'from' => 'from-indigo-500', 'to' => 'to-purple-500'],
                ['label' => 'Produk',    'value' => $totalProducts, 'icon' => '📦', 'from' => 'from-orange-400', 'to' => 'to-rose-500'],
                ['label' => 'Order',     'value' => $totalOrders,   'icon' => '🧾', 'from' => 'from-emerald-400','to' => 'to-sky-500'],
                ['label' => 'Omzet',     'value' => 'Rp ' . number_format($omzet, 0, ',', '.'), 'icon' => '💰', 'from' => 'from-fuchsia-500','to' => 'to-pink-500'],
            ];
        @endphp
        @foreach ($stats as $s)
            <div class="rounded-2xl p-5 text-white bg-gradient-to-br {{ $s['from'] }} {{ $s['to'] }} shadow-sm hover-lift">
                <div class="text-2xl mb-2">{{ $s['icon'] }}</div>
                <div class="text-2xl font-extrabold leading-tight">{{ $s['value'] }}</div>
                <div class="text-xs opacity-90 mt-1">{{ $s['label'] }}</div>
            </div>
        @endforeach
    </div>

    {{-- Komposisi role --}}
    <x-card title="👤 Komposisi Pengguna per Role">
        @php $maxRole = max(array_values($byRole)) ?: 1; @endphp
        <div class="space-y-3">
            @foreach (['admin' => 'bg-rose-500', 'editor' => 'bg-amber-500', 'user' => 'bg-emerald-500'] as $role => $color)
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-medium capitalize">{{ $role }}</span>
                        <span class="text-slate-500">{{ $byRole[$role] }} orang</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-3">
                        <div class="{{ $color }} h-3 rounded-full transition-all" style="width: {{ $byRole[$role] / $maxRole * 100 }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-card>

    <div class="mt-6">
        <a href="{{ route('demo.eager') }}"
           class="inline-block px-5 py-2.5 bg-slate-800 hover:bg-slate-900 text-white rounded-xl text-sm font-semibold transition">
            ⚡ Lihat Demo Eager Loading (Bonus)
        </a>
    </div>
@endsection
