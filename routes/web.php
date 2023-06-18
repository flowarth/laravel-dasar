<?php

use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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

Route::fallback(function () {
    return "404 by BUDIMAN";
});

Route::view('/hello', 'hello', ['name' => 'Rangga']);

Route::get('/hello-again', function () {
    return view('hello', ['name' => 'Rangga']);
});

Route::get('/hello-world', function () {
    return view('hello.world', ['name' => 'Rangga']);
});

Route::get('/products/{id}', function ($productId) {
    return "Product : $productId";
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Product $productId, Item $itemId";
})->name('product.item.detail');

Route::get('/categories/{id}', function (string $categoryId) {
    return "Categories : $categoryId";
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/users/{id?}', function (string $userId = '404') {
    return "Users : $userId";
})->name('user.detail');

Route::get('/conflict/{name}', function ($name) {
    return "Conflict $name";
});

Route::get('/conflict/rangga', function () {
    return "Conflict Rangga Setiawan";
});

Route::get('/controller/hello', [HelloController::class, 'hello']);
Route::get('/controller/hello/request', [HelloController::class, 'request']);

Route::get('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello/first', [InputController::class, 'helloFirst']);
Route::post('/input/hello/input', [InputController::class, 'helloInput']);
Route::post('/input/hello/array', [InputController::class, 'arrayInput']);
Route::post('/input/type', [InputController::class, 'inputType']);
Route::post('/input/only', [InputController::class, 'filterOnly']);
Route::post('/input/except', [InputController::class, 'filterExcept']);
Route::post('/input/merge', [InputController::class, 'filterMerge']);

// Route::post('/file/upload', [FileController::class, 'upload']);
Route::post('/file/upload', [FileController::class, 'upload'])->withoutMiddleware([VerifyCsrfToken::class]); // tanpa csrf

Route::get('/response/hello', [ResponseController::class, 'response']);
Route::get('/response/header', [ResponseController::class, 'header']);

Route::prefix('/response/type')->group(function () {
    Route::get('/view', [ResponseController::class, 'responseView']);
    Route::get('/json', [ResponseController::class, 'responseJson']);
    Route::get('/file', [ResponseController::class, 'responseFile']);
    Route::get('/download', [ResponseController::class, 'responseDownload']);
});

Route::get('/cookie/set', [CookieController::class, 'createCookie']);
Route::get('/cookie/get', [CookieController::class, 'getCookie']);
Route::get('/cookie/clear', [CookieController::class, 'clearCookie']);

Route::controller(RedirectController::class)->prefix('/redirect')->group(function () {
    Route::get('/from', 'redirectFrom');
    Route::get('/to', 'redirectTo');
    Route::get('/name', 'redirectName');
    Route::get('/name/{name}', 'redirectHello')->name('redirect-hello');
    Route::get('/action', 'redirectAction');
    Route::get('/away', 'redirectAway');
    Route::get('/named', function () {
        return route('redirect-hello', ['name' => 'Rangga']);
    });
});

Route::middleware(['contoh:PZN,401'])->prefix('/middleware')->group(function () {
    Route::get('/api', function () {
        return "OK";
    });
    Route::get('/group', function () {
        return "GROUP";
    });
});

Route::get('/url/action', function (){
//    return action([FormController::class, 'form'], []);
//    return url()->action([FormController::class, 'form'], []);
    return URL::action([FormController::class, 'form'], []);
});
Route::get('/form', [FormController::class, 'form']);
Route::post('/form', [FormController::class, 'submitForm']);

Route::get('/url/current', function () {
    return URL::full();
});

Route::get('/session/create', [\App\Http\Controllers\SessionController::class, 'createSession']);
Route::get('/session/get', [\App\Http\Controllers\SessionController::class, 'getSession']);

Route::get('/error/sample', function (){
    throw new Exception("Sample Error");
});

Route::get('/error/manual', function (){
    report(new Exception("Sample Error"));
    return "OKE";
});

Route::get('/error/validation', function(){
    throw new \App\Exceptions\ValidationException("Validation error");
});

Route::get('/abort/400', function (){
    abort(400);
});

Route::get('/abort/401', function (){
    abort(401);
});

Route::get('/abort/500', function (){
    abort(500);
});
