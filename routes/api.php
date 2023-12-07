<?php

use App\Http\Controllers\api\CategorieController;
use App\Http\Controllers\api\UserController;
use GuzzleHttp\Middleware;
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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [UserController::class, 'logout']);
});

// Les routes du Bailleur
Route::group(['middleware' => ['auth:sanctum', 'bailleur']], function () {
    Route::get('/dashboardBailleur', [UserController::class, 'dashBordBailleur']);
});


// Les routes du porteur de projet
Route::group(['middleware' => ['auth:sanctum', 'porteur']], function () {
    Route::get('/dashboardPorteur', [UserController::class, 'dashBordPorteur']);
});


// Les routes de l'admin
Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {
    Route::get('/dashboardAdmin', [UserController::class, 'dashBordAdmin']);
    Route::post('/ajouterCategorie', [CategorieController::class, 'store']);
    Route::put('/ModifierCategorie/{id}', [CategorieController::class, 'update']);
    Route::delete('/SupprimerCategorie/{id}', [CategorieController::class, 'destroy']);
});


Route::post('/inscription', [UserController::class, 'store']);

Route::post('/login', [UserController::class, 'connexion'])->name('login');
