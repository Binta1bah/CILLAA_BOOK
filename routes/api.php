<?php

use App\Http\Controllers\api\CommentaireController;

use App\Http\Controllers\api\ArticleController;

use App\Http\Controllers\api\NewsLetterController;
use App\Http\Controllers\api\UserController;
use App\Models\NewsLetter;
use GuzzleHttp\Middleware;

use Illuminate\Support\Facades\Route;



use Symfony\Component\HttpFoundation\Request;
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
    Route::post('/investissement/{projet}', [InvertissementController::class, 'store']);
    Route::get('/investissement/liste', [InvertissementController::class, 'index']);
    Route::get('/investissement/{id}', [InvertissementController::class, 'show']);
    Route::delete('/supprimer/investissement/{id}', [InvertissementController::class, 'destroy']);
});


// Les routes du porteur de projet
Route::group(['middleware' => ['auth:sanctum', 'porteur']], function () {
    Route::get('/dashboardPorteur', [UserController::class, 'dashBordPorteur']);
    Route::put('/accepterProposition/{id}', [InvertissementController::class, 'valider']);
    Route::put('/refuserProposition/{id}', [InvertissementController::class, 'refuser']);
});


// Les routes de l'admin
Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {
    Route::get('/dashboardAdmin', [UserController::class, 'dashBordAdmin']);
    //categorie
    Route::post('/ajouterCategorie', [CategorieController::class, 'store']);
    Route::get('/listeCtagorie', [CategorieController::class, 'index']);
    Route::put('/ModifierCategorie/{id}', [CategorieController::class, 'update']);
    Route::delete('/SupprimerCategorie/{id}', [CategorieController::class, 'destroy']);

    // CRUD ARTICLE
    Route::get('/voirArticles', [ArticleController::class, 'index']);
    Route::post('/ajouterArticle', [ArticleController::class, 'store']);
    Route::put('/modifierArticle/{article}', [ArticleController::class, 'update']);
    Route::delete('/supprimerArticle/{article}', [ArticleController::class, 'destroy']);

    // CRUD NewsLetter
    Route::get('/voirNewsLetters', [NewsLetterController::class, 'index']);
    Route::delete('/supprimerNewsLetter/{id}', [NewsLetterController::class, 'supprimer']);
});

Route::post('/ajouterNewsLetter', [NewsLetterController::class, 'store']);
Route::post('/inscription', [UserController::class, 'store']);

//Routes de mes projects

Route::apiResource('projets', ProjetController::class);


//Routes les commentaires
Route::apiResource('commentaires', CommentaireController::class);


// Routes investissements
// Accepter
Route::put('/invertissements/accepter/{invertissement}', [InvertissementController::class, 'accepterInvertissement']);
// Refuser
Route::put('/invertissements/refuser/{invertissement}', [InvertissementController::class, 'refuserInvertissement']);

Route::post('/login', [UserController::class, 'connexion'])->name('login');



// // route pour lister les projet 
// Route::get('/projet', [ProjetController::class, 'index']);
// // route pour rechercher les projet par categorie
// Route::get('/categorieprojet',[CategorieController::class,'index']);

// route pour selectionner un projet et faire une proposition



// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/user', function (Request $request){
//         return $request->user();
//     });
// });
