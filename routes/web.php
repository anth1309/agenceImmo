<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorElement;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//normalement la logique se place dans le controlleur
//Route::prefix('blog')->name('blog.')->group(function () {


// Route::get('/', function (Request $request) {

// return [
//     "link" => route('blog.show', ['slug' => 'articles', 'id' => 3]),

// ];

//return Post::paginate(25);

//creation
// $post = new \App\Models\Post();
// $post->title = 'Mon cinquieme article';
// $post->content = 'Ceci est le contenu de mon premier article';
// $post->slug = 'mon-cinquieme-article';
// $post->save();
// return $post;
//ou
// $post = Post::create([
//     'title' => 'Mon sixieme article',
//     'content' => 'Ceci est le contenu de mon sixieme article',
//     'slug' => 'mon-sixieme-article',
// ]);
// return $post;


//recuperation
//$post = Post::all();
//$post = Post::all()->first();
//recuperer un article en particulier
//$post = Post::find(3);
//creer une pagination en option on peut passer ce qu on veut affiche
//$post = Post::paginate(1);
//exemple de requete avec where
//$post = Post::where('id', '>', '2')->limit(2)->get();

//modification
// $post = Post::find(3);
// $post->title = 'Mon second article modifie';
// $post->save();

//suppression
//     $post = Post::find(4);
//     $post->delete();
//     return $post;

//     return [
//         "link" => route('blog.show', ['slug' => 'articles', 'id' => 3]),

//     ];
// })->where([
//     'id' => '[0-9]+',
//     'slug' => '[a-z0-9\-]+',
// ])->name('index');



// Route::get('/{id}/{slug}', function (String $id, String $slug) {
//     return [
//         "id" => $id,
//         "slug" => $slug
//     ];
// })->name('show');



// Route::prefix('blog')->name('blog.')->group(function () {


//     Route::get('/', [PostsController::class, 'index'])->name('index');
//     Route::get('/{slug}/{id}', [PostsController::class, 'show'])
//         ->where([
//             'id' => '[0-9]+',
//             'slug' => '[a-z0-9\-]+',
//         ])->name('show');
// });

//on optimise comme dans meme controlleur
Route::prefix('blog')->name('blog.')->controller(PostsController::class)->group(function () {

    Route::get('/',  'index')->name('index');

    Route::get('/new', 'create')->name('create')->middleware('auth');
    Route::post('/new', 'store')->name('store')->middleware('auth');
    Route::get('/{post}/edit', 'edit')->name('edit')->middleware('auth');
    Route::patch('/{post}/edit', 'update')->name('update')->middleware('auth');
    Route::get('/{slug}/{id}', 'show')
        ->where([
            'id' => '[0-9]+',
            'slug' => '[a-z0-9\-]+',
        ])->name('show');
    Route::delete('/{post}', 'destroy')->name('destroy')->middleware('auth');

    Route::prefix('auth')->name('auth.')->controller(AuthController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'doLogin');
        Route::delete('/logout', 'logout')->name('logout');
    });
});
