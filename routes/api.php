<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventAPIController;
use App\Http\Controllers\TeamAPIController;
use App\Http\Controllers\MatchListAPIController;
use App\Http\Controllers\UserAPIController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('/event', EventAPIController::class);
Route::resource('/team', TeamAPIController::class);
Route::resource('/match', MatchListAPIController::class);
Route::resource('/user', UserAPIController::class);
//User
Route::put('/user/updatepassword/{user}', [UserAPIController::class, 'updatepassword'])->name('user.update_password');
Route::post('/user/auth', [UserAPIController::class, 'authentication'])->name('user.auth');
