@extends('base')

@section('title', $post->title)


@section('content')

    <article>
        <h1>Mon Super Blog</h1>

        <div>
            <label for="title">Titre</label>
            <h2>{{ $post->title }}</h2>
        </div>
        <div>
            <label for="content">
                <Article></Article>
            </label>
            <p>{{ $post->content }}</p>
        </div>
        <a href="{{ route('blog.index') }}" class="btn btn-warning">Retour a l'acceuil</a>

    </article>
@endsection
