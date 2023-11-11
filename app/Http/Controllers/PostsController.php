<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostsFilterRequest;
use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PostsController extends Controller
{
    public function index(PostsFilterRequest $request): View
    {
        //identique a la requete dans dossier  PostsFilterRequest
        // Validator::make(
        //     [
        //         'title' => '',

        //     ],
        //     [
        //         'title.required' => [Rule::unique('posts'), 'required', 'min:5', 'max20'],

        //     ]
        // );
        $posts = Post::paginate(2);
        return view('blog.index', compact('posts'));
    }

    public function show(string $slug, string $id): RedirectResponse | View
    {
        $post = Post::findorfail($id);
        if ($post->slug != $slug) {
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }
        return view('blog.show', compact('post'));
    }
}
