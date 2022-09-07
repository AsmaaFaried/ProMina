<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\HomeController;
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

Route::get('/',function(){
    return view("welcome");
});
Route::middleware(['auth'])->group(function () {
    Route::prefix('/user/')->group(function(){

        Route::resource('/albums', AlbumController::class);
        Route::post('/deleteAlbums', [AlbumController::class, 'destroy'])->name('albums.delete');

        Route::delete('/albums/{album}/image/{image}', [AlbumController::class, 'destroyImage'])->name('albums.image.destroy');
        Route::post('/albums/{album}/image', [AlbumController::class,'upload'])->name('albums.upload');



    });

});

Route::get('/test',function(){
    return view('Albums.test');
});


Auth::routes();

