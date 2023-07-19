<?php

use App\Http\Controllers\ConvertFileController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
});


// singup and login
Route::get('/user/singup', []);

// Auth::routes();

Route::post('/convertfile', [ConvertFileController::class, 'convert_tiff'])
    ->name('convert.tiff')
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/translate', [TranslateController::class, "translate"])->name("translate");

// some comments