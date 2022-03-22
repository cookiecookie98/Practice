<?php

use App\Http\Controllers\EquipmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('auth')->group(function (){
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::post('/register', [UserController::class, 'register'])->name('register');
});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/logout',[UserController::class, 'logout'])->name('logout');
    Route::get('/find',[UserController::class, 'getUserFromToken']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('equipment', EquipmentController::class);
});

