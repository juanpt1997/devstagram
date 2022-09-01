@extends('layouts.app')

@section('title')
    Página principal
@endsection

@section('content')
    {{-- @forelse ($posts as $post)
        <h1>{{ $post->titulo }}</h1>
    @empty
        <h1>No hay posts</h1>
    @endforelse --}}
    {{-- ? Esto fue reemplazado por componentes--}}
    {{-- @if ($posts->count())

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src=" {{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>

        <div class="my-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @else
        <p class="text-center">No hay posts, sigue a alguien para poder mostrar sus posts</p>
    @endif --}}

    <x-listar-post />


@endsection
