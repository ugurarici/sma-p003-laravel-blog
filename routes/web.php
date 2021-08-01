<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;

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

/**
 * Basit bir blog sistemi istiyoruz
 * İçinde blog yazıları (Post) bulunacak
 * Bu yazılar bir kullanıcıya (User) ait olacak
 * Bu yazılar bir kategoriye (Category) bağlı olacak
 * Bu yazılar birçok etikete (Tag) sahip olabilecek
 *
 * Ana sayfada en sonuncudan en eskiye, sayfa başı 5 tane gözükecek şekilde listeleme olacak
 * Bir kullanıcının adına basılarak, o kullanıcın yazılarının listelemesi olacak
 * Kategoriye göre listeleme olacak
 * Etikete göre listeleme olacak
 * Aktif bir kullanıcı varsa;
 * Kullanıcı yeni bir yazı ekleyebilecek
 * Kendi yazılarını düzenleyebilecek ve silebilecek
 */

Auth::routes();

Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);

Route::get('admin', function () {
    return "Buraların paşasının ekranı";
})->name('admin')->middleware(['auth', 'admin']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
