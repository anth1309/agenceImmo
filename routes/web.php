<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Psy\Util\Str;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/{id}/{slug}', function (String $id, String $slug) {
        return [
            "id" => $id,
            "slug" => $slug
        ];
    })->name('show');

    Route::get('/', function (Request $request) {
        return [
            "link" => route('blog.show', ['slug' => 'articles', 'id' => 3]),

        ];
    })->where([
        'id' => '[0-9]+',
        'slug' => '[a-z0-9\-]+',
    ])->name('index');
});
