<?php

use App\Models\Invertissement;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

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


// route pour Enregistrer un utilisateur
Route::post('/register', [UserController::class,'register']);
// route pour connecter un utilisateur
 Route::post('/login', [UserController::class,'login']);

// route pour lister les projet 
Route::get('/projet', [ProjetController::class, 'index']);
// // route pour rechercher les projet par categorie
Route::get('/categorieprojet',[CategorieController::class,'index']);

// route pour selectionner un projet et faire une proposition
Route::post('/investissement',[InvertissementController::class,'store']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request){
        return $request->user();
    });
});
