<?php

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
Route::get('survey/{survey}', function (\App\Models\Survey $survey) {
    return view('app',['title'=>$survey->title]);
});

Route::get('/admin', function () {
    return redirect('/admin/users');
});
Route::group(['middleware' => ['admin']], function () {
    Route::group(['prefix' => 'admin'], function()
    {
        Route::get('dashboard', function () {
            return view('dashboard');
        })->name('admin.dashboard');
        Route::resource('users',\App\Http\Controllers\UserController::class);
        Route::resource('categories',\App\Http\Controllers\CategoryController::class);
    });
});

require __DIR__.'/auth.php';

Route::get('{any}', function () {
    return view('welcome');
})->where('any','.*');



