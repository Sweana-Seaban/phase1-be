<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//added code
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
//added code

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//public routes
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/tasks',[TaskController::class,'index']);

//protected routes
Route::group(['middleware' => ['auth:sanctum']],function(){
    Route::post('/logout',[AuthController::class,'logout']);
    Route::post('/tasks',[TaskController::class,'store']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});