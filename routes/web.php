<?php

use App\Http\Controllers\AlbumController;
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
})->name('home');


Route::group(['prefix'=>'album','as'=>'album.'],function (){
    Route::get('/',[AlbumController::class,'index'])->name('index');

    Route::get('create',[AlbumController::class,'create'])->name('create');

    Route::post('store',[AlbumController::class,'store'])->name('store');

    Route::get('edit/{album}',[AlbumController::class,'edit'])->name('edit');

    Route::post('update/{album}',[AlbumController::class,'update'])->name('update');

    Route::delete('delete/{id}',[AlbumController::class,'delete'])->name('delete');

    Route::post('destroy',[AlbumController::class,'destroy'])->name('destroy');

    Route::get('media/show/{album}',[AlbumController::class,'showMedia'])->name('media.show');

    Route::delete('media/delete/{id}',[AlbumController::class,'deleteMedia'])->name('media.delete');

    Route::delete('media/move/{id}',[AlbumController::class,'moveMedia'])->name('media.move');


});
