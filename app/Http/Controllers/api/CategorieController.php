<?php

namespace App\Http\Controllers\api;
use Exception;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCtegorieRequest;
use App\Models\Projet;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request)
{
    $categorieId = $request->input('categorie_id');

    if ($categorieId) {
        $projets = Projet::where('categorie_id', $categorieId)->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Projets récupérés avec succès',
            'projets' => $projets
        ]);
    } else {
        return response()->json([
            'status_code' => 400,
            'status_message' => 'ID de catégorie manquant'
        ]);
    }
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCtegorieRequest $request)
    {
        // ici je vais créer un categorie

        $categorie = new Categorie();
        $categorie->libelle = $request->libelle;
        $categorie->save();

    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        //
    }
}
