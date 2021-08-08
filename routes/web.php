<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Mahmut\Muarrem;
use Cmfcmf\OpenWeatherMap;

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

Route::get('muarrem', function (Muarrem $muarrem) {
    //  bu closure içinde kullanabileceğimiz bir $muarrem objesi var
    //  parametre olarak girerken Muarrem şeklinde sınıfını belirttiğimiz anda
    //  Laravel bu sınıftan bir obje türetip, bu closure içinde kullanımımıza sunmaya çalışır
    //  Eğer bu sınıf, herhangi bir şekilde parametre alması gerekmiyorsa sorun yoktur
    //  ilgili sınıftan `new Muarrem` şeklinde bir obje türetilir ve döndürülü
    //  Ancak; bu sınıftan bir obje türetilmesi için parametre gerekiyorsa
    //  bir Service Provider aracılığıyla, bu sınıftan bir obje gerektiğinde
    //  o objenin hangi parametrelerle nasıl türetileceği Laravel'e öğretilir
    //  biz bu örnekte bu işlemi app/Providers/AppServiceProvider.php dosyasının register() metodunda yaptık
    //  böylece, oluşturulması için bir parametre gerekmesine rağmen
    //  Laravel uygulamamızın Service Container aracılığıyla bağımlılık sızdırma imkanı bulunan
    //  bütün alanlarında, Muarrem sınıfından bir objenin ilgili closure'a sızdırılmasını sağladık
    return $muarrem->singasong();
});


Route::get('owm', function (OpenWeatherMap $owm) {
    $weather = $owm->getWeather('Istanbul', 'metric', 'tr');
    dd($weather);
});
