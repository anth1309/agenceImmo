@extends('base')

@section('title', 'Acceuil de mon blog')


@section('content')
<h1>Mon Super Blog</h1>
@foreach ($posts as $post)
<article>
   <h2>{{$post->title}}</h2>
   <p>{{$post->content}}</p>
   <p>
      <a href="{{route('blog.show', ['id' => $post->id, 'slug' => $post->slug])}}" class="btn btn-warning">Lire la suite</a>
   </p>

</article>
@endforeach
<!--permet de generer le lien de pagination-->
{{$posts->links()}}

@endsection