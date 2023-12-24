<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPostRequest;
use App\Http\Requests\PostsFilterRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index(PostsFilterRequest $request): View
    {
        //dd(Auth::user());
        // User::create([
        //     'name' => 'John',
        //     'email' => 'test@test.fr',
        //     'password' => Hash::make('azerty'),
        // ]);

        // $post = Post::find(1);
        // $post->tags()->createMany([
        //     ['name' => 'laravel'],
        //     ['name' => 'php'],
        // ]);

        return view('blog.index', [
            'posts' => Post::with(['category', 'tags'])->paginate(10),
        ]);
    }

    public function show(string $slug, string $id): RedirectResponse | View
    {
        $post = Post::findorfail($id);
        if ($post->slug != $slug) {
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }
        return view('blog.show', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get(),
        ]);
    }

    public function create(): View
    {
        $post = new Post();
        return view('blog.create', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get(),
        ]);
    }

    // public function store(Request $request): RedirectResponse
    // {

    //     $post = Post::create([
    //         'title' => $request->input('title'),
    //         'content' => $request->input('content'),
    //         'slug' => Str::slug($request->input('title')),
    //     ]);

    //     return redirect()
    //         ->route('blog.show', ['slug' => $post->slug, 'id' => $post->id])
    //         ->with('success', "l'article a bien été ajouté");
    // }
    //le meme  mais une fois qu on a creer les contraintes de validation dans PostCreateRequest
    public function store(FormPostRequest $request): RedirectResponse
    {
        $post = Post::create($this->extractdata(new Post(), $request));
        $post->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show', ['slug' => $post->slug, 'id' => $post->id])
            ->with('success', "l'article a bien été ajouté");
    }

    public function edit(Post $post)
    {
        return view('blog.edit', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get(),
        ]);
    }

    public function update(FormPostRequest $request, Post $post)
    {

        $post->update($this->extractdata($post, $request));

        $post->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show', ['slug' => $post->slug, 'id' => $post->id])
            ->with('success', "l'article a bien été mis à jour");
    }

    private function extractdata(Post $post, FormPostRequest $request): array
    {
        $data = $request->validated();
        /** @var UploadedFile|null $image
         * pour faire le lien avec storage/app/public/bloc/nameimage taper php artisan storage:link pour faire un lien avecnotre dossier public de la racine
         */
        $image = $request->file('image');

        if ($image && !$image->getError()) {

            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }

            $imagePath = $image->store('blog', 'public');

            $data['image'] = $imagePath;
        }

        return $data;
    }


    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('blog.index')
            ->with('success', "l'article a bien été supprimé");
    }
}
