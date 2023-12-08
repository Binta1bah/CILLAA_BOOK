<?php

use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware'=>['auth:sanctum','porteur']],function(){
    Route::get('/dashboardPorteur', [UserController::class,"DashboardPorteur"]);
});

Route::group(['middleware'=>['auth:sanctum','bailleur']],function(){
    Route::get('/dashboardBailleur', [UserController::class,"DashboardBailleur"]);
});

Route::group(['middleware'=>['auth:sanctum','admin']],function(){
    Route::get('/dashboardAdmin', [UserController::class,"DashboardAdmin"]);
});



Route::post('/inscription', [UserController::class, 'store']);

Route::post('/login', [UserController::class, 'login'] );

// Route::get('/dashboardPorteur', [UserController::class,"index"]);

// Route::middleware(['auth', 'porteur'])->group(function () {
//     Route::get('/dashboardPorteur', [UserController::class,"index"]);
    
// });

