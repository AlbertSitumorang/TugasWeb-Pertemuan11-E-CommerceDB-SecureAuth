@extends('layouts.app')
@section('title', 'Post Baru')

@section('content')
    <h1 class="text-3xl font-extrabold text-slate-900 mb-6">✏️ Post Baru</h1>
    <x-card>
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            @include('posts._form')
        </form>
    </x-card>
@endsection
