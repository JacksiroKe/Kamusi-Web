<?php

use Illuminate\Http\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');    
    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

	Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', 'App\Http\Controllers\UserController@index')->name('index');
        Route::get('edit/{user}', 'App\Http\Controllers\UserController@edit')->name('edit');
        Route::get('create', 'App\Http\Controllers\UserController@create')->name('create');
        Route::post('store', 'App\Http\Controllers\UserController@store')->name('store');
        Route::post('u/{user}/update', 'App\Http\Controllers\UserController@update')->name('update');
        Route::get('d/{user}/delete', 'App\Http\Controllers\UserController@destroy')->name('delete');
    });

    Route::get('profile', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');
    Route::put('profile', 'App\Http\Controllers\ProfileController@update')->name('profile.update');
    Route::put('profile/password', 'App\Http\Controllers\ProfileController@password')->name('profile.password');

    Route::group(['prefix' => 'words', 'as' => 'words.'], function () {
        Route::get('/', 'App\Http\Controllers\Data\WordController@index')->name('index');
        Route::get('view/{word}', 'App\Http\Controllers\Data\WordController@view')->name('view');
        Route::get('edit/{word}', 'App\Http\Controllers\Data\WordController@edit')->name('edit');
        Route::get('create', 'App\Http\Controllers\Data\WordController@create')->name('create');
        Route::get('search', 'App\Http\Controllers\Data\WordController@search')->name('search');
        Route::get('find', 'App\Http\Controllers\Data\WordController@find')->name('find');
        Route::post('store', 'App\Http\Controllers\Data\WordController@store')->name('store');
        Route::post('u/{word}/update', 'App\Http\Controllers\Data\WordController@update')->name('update');
        Route::get('d/{word}/delete', 'App\Http\Controllers\Data\WordController@destroy')->name('delete');
    });

    Route::group(['prefix' => 'proverbs', 'as' => 'proverbs.'], function () {
        Route::get('/', 'App\Http\Controllers\Data\ProverbController@index')->name('index');
        Route::get('edit/{proverb}/proverb', 'App\Http\Controllers\Data\ProverbController@edit')->name('edit');
        Route::get('create', 'App\Http\Controllers\Data\ProverbController@create')->name('create');
        Route::post('store', 'App\Http\Controllers\Data\ProverbController@store')->name('store');
        Route::post('u/{proverb}/update', 'App\Http\Controllers\Data\ProverbController@update')->name('update');
        Route::get('d/{proverb}/delete', 'App\Http\Controllers\Data\ProverbController@destroy')->name('delete');
    });

    Route::group(['prefix' => 'sayings', 'as' => 'sayings.'], function () {
        Route::get('/', 'App\Http\Controllers\Data\SayingController@index')->name('index');
        Route::get('edit/{saying}', 'App\Http\Controllers\Data\SayingController@edit')->name('edit');
        Route::get('create', 'App\Http\Controllers\Data\SayingController@create')->name('create');
        Route::post('store', 'App\Http\Controllers\Data\SayingController@store')->name('store');
        Route::post('u/{saying}/update', 'App\Http\Controllers\Data\SayingController@update')->name('update');
        Route::get('d/{saying}/delete', 'App\Http\Controllers\Data\SayingController@destroy')->name('delete');
    });

    Route::group(['prefix' => 'idioms', 'as' => 'idioms.'], function () {
        Route::get('/', 'App\Http\Controllers\Data\IdiomController@index')->name('index');
        Route::get('edit/{idiom}', 'App\Http\Controllers\Data\IdiomController@edit')->name('edit');
        Route::get('create', 'App\Http\Controllers\Data\IdiomController@create')->name('create');
        Route::post('store', 'App\Http\Controllers\Data\IdiomController@store')->name('store');
        Route::post('u/{idiom}/update', 'App\Http\Controllers\Data\IdiomController@update')->name('update');
        Route::get('d/{idiom}/delete', 'App\Http\Controllers\Data\IdiomController@destroy')->name('delete');
    });

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/', 'App\Http\Controllers\Trivia\CategoryController@index')->name('index');
        Route::get('edit/{category}', 'App\Http\Controllers\Trivia\CategoryController@edit')->name('edit');
        Route::get('create', 'App\Http\Controllers\Trivia\CategoryController@create')->name('create');
        Route::post('store', 'App\Http\Controllers\Trivia\CategoryController@store')->name('store');
        Route::post('u/{category}/update', 'App\Http\Controllers\Trivia\CategoryController@update')->name('update');
        Route::get('d/{category}/delete', 'App\Http\Controllers\Trivia\CategoryController@destroy')->name('delete');
    });

    Route::group(['prefix' => 'trivia', 'as' => 'trivia.'], function () {
        Route::get('/', 'App\Http\Controllers\Trivia\TriviaController@index')->name('index');
        Route::get('edit/{trivia}', 'App\Http\Controllers\Trivia\TriviaController@edit')->name('edit');
        Route::get('create', 'App\Http\Controllers\Trivia\TriviaController@create')->name('create');
        Route::post('store', 'App\Http\Controllers\Trivia\TriviaController@store')->name('store');
        Route::post('u/{trivia}/update', 'App\Http\Controllers\Trivia\TriviaController@update')->name('update');
        Route::get('d/{trivia}/delete', 'App\Http\Controllers\Trivia\TriviaController@destroy')->name('delete');
    });
    
    Route::group(['prefix' => 'questions', 'as' => 'questions.'], function () {
        Route::get('/', 'App\Http\Controllers\Trivia\QuestionController@index')->name('index');
        Route::get('view/{question}', 'App\Http\Controllers\Trivia\QuestionController@view')->name('view');
        Route::get('edit/{question}', 'App\Http\Controllers\Trivia\QuestionController@edit')->name('edit');
        Route::get('create/{word}', 'App\Http\Controllers\Trivia\QuestionController@create')->name('create');
        Route::get('search', 'App\Http\Controllers\Trivia\QuestionController@search')->name('search');
        Route::post('store', 'App\Http\Controllers\Trivia\QuestionController@store')->name('store');
        Route::post('u/{question}/update', 'App\Http\Controllers\Trivia\QuestionController@update')->name('update');
        Route::get('d/{question}/delete', 'App\Http\Controllers\Trivia\QuestionController@destroy')->name('delete');
    });

	Route::get('leaderboard', function () {
        return view('pages.upgrade');
    })->name('leaderboard');
});

Route::get('storage/{filename}', function ($filename) {
    $path = storage_path('public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
