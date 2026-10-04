@extends('layouts.app')
@section('title', 'Semua Post')

@section('content')
    <x-alert type="success" :message="session('success')" />

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-slate-900">📰 Berita & Pengumuman Toko</h1>
        @if (in_array(auth()->user()->role, ['admin', 'editor']))
            <a href="{{ route('posts.create') }}"
               class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold shadow-sm shadow-indigo-200 transition">
                + Post Baru
            </a>
        @endif
    </div>

    <div class="space-y-4">
        @forelse ($posts as $post)
            <x-card hover>
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <h3 class="text-lg font-bold text-slate-900">{{ $post->title }}</h3>
                        <p class="text-xs text-slate-400 mt-0.5 mb-2 flex items-center gap-1">
                            ✍️ {{ $post->user->name }}
                            <span class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-500 text-[10px] uppercase font-semibold">{{ $post->user->role }}</span>
                            · 🕒 {{ $post->created_at->diffForHumans() }}
                        </p>
                        <p class="text-slate-600 text-sm leading-relaxed">{{ Str::limit($post->body, 200) }}</p>

                        <div class="mt-3 flex gap-4 text-sm font-medium">
                            @can('update', $post)
                                <a href="{{ route('posts.edit', $post) }}" class="text-indigo-600 hover:text-indigo-800">✏️ Edit</a>
                            @endcan
                            @can('delete', $post)
                                <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Hapus post ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700">🗑️ Hapus</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </x-card>
        @empty
            <x-card>
                <div class="text-center py-10">
                    <div class="text-5xl mb-3">📭</div>
                    <p class="text-slate-500 text-sm">Belum ada post.</p>
                </div>
            </x-card>
        @endforelse
    </div>

    <div class="mt-6">{{ $posts->links() }}</div>
@endsection
