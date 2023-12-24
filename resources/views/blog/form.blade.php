@extends('base')

@section('title', "Modification d'un article")


@section('content')

    <form action="" method="post" enctype="multipart/form-data" class="vstack gap-2">
        @csrf
        @method($post->id ? 'PATCH' : 'POST')

        <div class="form-group">
            <label for="image">Image</label>
            <input class="form-control" type="file" id="image" name="image">
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Titre</label>
            <input class="form-control" type="text" id ="title" name="title"
                value="{{ old('title', $post->title) }}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">slug</label>
            <input class="form-control" type="text" name="slug" value="{{ old('slug', $post->slug) }}">
            @error('slug')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="content">Contenu</label>
            <textarea class="form-control" name="content">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category">Categorie</label>
            <select class="form-control" name="category_id" id="category">
                <option value="">Sélectionner une catégorie</option>
                @foreach ($categories as $category)
                    <option @selected(old('category_id', $post->category_id) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach

            </select>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        @php
            $tagsIds = $post->tags->pluck('id');
        @endphp

        <div class="form-group">
            <label for="tag">Tag</label>
            <select class="form-control" name="tags[]" id="tag" multiple>
                @foreach ($tags as $tag)
                    <option @selected($tagsIds->contains($tag->id)) value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach

            </select>
            @error('tags')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="row mr-2 ml-2">
            <button class="btn btn-success mr-2 ml-2">
                @if ($post->id)
                    Modifier
                @else
                    Créer
                @endif
            </button>
    </form>

    @if ($post->id)
        <form action="{{ route('blog.destroy', ['post' => $post->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    @endif
    </div>
    </form>

@endsection
