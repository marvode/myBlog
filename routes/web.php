<?php

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

use App\Http\Controllers\Blog\PostsController;

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::prefix('blog')->group(function () {
    Route::get('posts/{post}', [PostsController::class, 'show'])->name('blog.show');
    Route::get('categories/{category}', [PostsController::class, 'category'])->name('blog.category');
    Route::get('tags/{tag}', [PostsController::class, 'tag'])->name('blog.tag');
});


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories', 'CategoriesController');
    Route::resource('tags', 'TagsController');
    Route::resource('post', 'PostController')->middleware('auth');
    Route::get('trashed-posts', 'PostController@trashed')->name('post.trashed-post');
    Route::put('post/{post}/restore', 'PostController@restore')->name('post.restore');
    Route::get('users/profile', 'UsersController@edit')->name('users.edit-profile');
    Route::put('users/profile', 'UsersController@update')->name('users.update-profile');
});

Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('users/index', 'UsersController@index')->name('users.index');
    Route::post('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
});