@extends('base')

@section('title', $post->title)


@section('content')
   <article>
      <h1>Mon Super Blog</h1>
      <h2>{{$post->title}}</h2>
      <p>{{$post->content}}</p>
      <a href="{{route('blog.index')}}" class="btn btn-warning">Retour a l'acceuil</a>
   </article>
 


   

    
@endsection
