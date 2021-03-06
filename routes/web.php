<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\PengujianController;

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

Route::middleware(['auth:sanctum', 'verified'])->group(function (){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('data', DataController::class );
    Route::resource('dataset', DatasetController::class);

    //Route untuk import data excel
    Route::post('importExcel', [DataController::class, 'import'])->name('importExcel');

    //load data set
    Route::get('load_data', [DatasetController::class, 'load'])->name('load_data');

    Route::resource('perhitungan', PerhitunganController::class);
    Route::get('/uji/{id}', [PengujianController::class, 'pengujian'])->name('uji');
    Route::resource('pengujian',PengujianController::class);
    Route::get('/show/{id}', [PengujianController::class, 'show'])->name('show');


});

//Route::get('/dashboard', function () {
//    return view('beranda');
//})->middleware(['auth'])->name('dashboard');
//
//Route::get('/about',function (){
//    return view('about')->name('about');
//});

require __DIR__.'/auth.php';
