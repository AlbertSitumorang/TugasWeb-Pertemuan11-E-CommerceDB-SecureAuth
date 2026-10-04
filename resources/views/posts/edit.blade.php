@extends('layouts.app')
@section('title', 'Edit Post')

@section('content')
    <h1 class="text-3xl font-extrabold text-slate-900 mb-6">✏️ Edit Post</h1>
    <x-card>
        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf
            @method('PUT')
            @include('posts._form')
        </form>
    </x-card>
@endsection
