<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SurveyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response($request->user(),200);
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/survey', SurveyController::class,['only'=>['index','store','update','destroy']]);
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);
});
Route::get('/survey/{id}',[SurveyController::class,'show']);
Route::get('/surveys-public/{category_id?}', [SurveyController::class, 'showForGuest']);
Route::post('/vote/{surveyAnswer}', [\App\Http\Controllers\SurveyAnswerController::class, 'update']);
Route::get('categories-api',[\App\Http\Controllers\CategoryController::class,'showForApi']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

