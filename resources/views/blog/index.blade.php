@extends('base')

@section('title', 'Acceuil de mon blog')


@section('content')
    <h1>Mon Super Blog</h1>
    @foreach ($posts as $post)
        <article>
            <h2>{{ $post->title }}</h2>

            <p class="small">
                @if ($post->category)
                    Categorie : <strong>{{ $post->category->name }}</strong>
                @endif
                @if (!$post->tags->isEmpty())
                    Tags :
                    @foreach ($post->tags as $tag)
                        <span class="badge bg-info">{{ $tag->name }}</span>
                    @endforeach
                @endif
            </p>
            @if ($post->image)
                <img src="{{ $post->imageUrl() }}" alt="">
            @endif
            <p>{{ $post->content }}</p>
            <p>
                <a href="{{ route('blog.show', ['id' => $post->id, 'slug' => $post->slug]) }}"
                    class="btn btn-info mr-2 ml-2">Lire la
                    suite</a>
                <a href="{{ route('blog.edit', ['post' => $post->id]) }}" class="btn btn-success mr-2 ml-2">Modifier cet
                    article</a>

            </p>

        </article>
    @endforeach
    <!--permet de generer le lien de pagination-->
    {{ $posts->links() }}

@endsection
