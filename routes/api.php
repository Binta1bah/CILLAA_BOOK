<?php

use App\Http\Controllers\api\CommentaireController;
use App\Http\Controllers\api\InvertissementController;
use App\Http\Controllers\api\ProjetController;
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

Route::post('/inscription', [UserController::class, 'store']);

//Routes de mes projects

Route::apiResource('projets', ProjetController::class);


//Routes les commentaires
Route::apiResource('commentaires', CommentaireController::class);


// Routes investissements
// Accepter
Route::put('/invertissements/accepter/{invertissement}', [InvertissementController::class, 'accepterInvertissement']);
// Refuser
Route::put('/invertissements/refuser/{invertissement}', [InvertissementController::class, 'refuserInvestissement']);
