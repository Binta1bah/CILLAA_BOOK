<?php

use GuzzleHttp\Middleware;

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\ProjetController;
use App\Http\Controllers\api\CategorieController;
use App\Http\Controllers\api\InvertissementController;

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
    Route::get('/info/{id}', [UserController::class, 'show']);
    Route::put('/modifierProfil/{id}', [UserController::class, 'update']);
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
    //categorie
    Route::post('/ajouterCategorie', [CategorieController::class, 'store']);
    Route::get('/listeCtagorie', [CategorieController::class, 'index']);
    Route::put('/ModifierCategorie/{id}', [CategorieController::class, 'update']);
    Route::delete('/SupprimerCategorie/{id}', [CategorieController::class, 'destroy']);
    //porteurs
    Route::get('/listePorteur', [UserController::class, 'listePorteur']);
    //bailleur
    Route::get('/listeBailleur', [UserController::class, 'listeBailleur']);
    // user
    Route::put('/bloquerUser/{id}', [UserController::class, 'bloquerUser']);
    Route::put('/debloquerUser/{id}', [UserController::class, 'debloquerUser']);
});


Route::post('/inscription', [UserController::class, 'store']);

Route::post('/login', [UserController::class, 'connexion'])->name('login');
