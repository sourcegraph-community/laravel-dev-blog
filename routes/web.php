<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Parsed\Content;
use Parsed\ContentParser;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $articles = [];
    $limit = 10;

    foreach (glob(storage_path('app') . '/*.md') as $file) {
        $article = new Content(file_get_contents($file));
        $article->parse(new ContentParser());

        $articles[] = $article;
    }

    krsort($articles);
    $articles = array_slice($articles, 0, $limit);
    return view('index', [
        'articles' => $articles
    ]);
});
