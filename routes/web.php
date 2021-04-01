<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Frontpage;
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

Route::group(['middleware' => [
    'auth:sanctum',
    'verified',
]],function () {

    Route::get('/dashboard',function(){
        return view('dashboard');
    })->name('dashboard');

    Route::get('/pages',function(){
        return view('admin.pages');
    })->name('pages');
});

Route::get('/{urlslug}', Frontpage::class);
Route::get('/', Frontpage::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

use App\Http\Controllers\PdfController;
Route::get('/graphs', [PdfController::class, 'graphs']);
Route::get('/graphs-pdf', [PdfController::class, 'graphPdf']);