<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;

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
    return view('guest.welcome');
});

Route::post('ckeditor/image_upload', [CkeditorController::class, 'upload'])->name('upload');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/dashboard', function() {
        return view('admin.home');
    })->name('home');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/tags', [TagController::class, 'index'])->name('tags');
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
    Route::get('/blogs/add', [BlogController::class, 'addBlog'])->name('blog-add');
    Route::get('/blogs/{id}', [BlogController::class, 'showBlog'])->name('show-blog');
    Route::get('/blogs/edit/{id}', [BlogController::class, 'editBlog'])->name('edit-blog');
});
