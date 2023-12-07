<?php

namespace App\Http\Controllers\api;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string'
        ]);

        $categorie = new Categorie();
        $categorie->libelle = $request->libelle;
        if ($categorie->save()) {
            return response()->json([
                "statut" => 1,
                "message" => "Categorie ajoutée"
            ]);
        }
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
    public function update(Request $request, string $id)
    {
        $categorie = Categorie::findorFail($id);
        $categorie->libelle = $request->libelle;
        if ($categorie->save()) {
            return response()->json([
                "message" => "Modification effectuée"
            ]);
        } else {
            return response()->json([
                "message" => "Modification non effectuée"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $categorie = Categorie::findorFail($id);
        if($categorie->delete()) {
            return response()->json([
                "Statut" => 1,
                "massage" => "Suppression effectuer"
            ]);
        }
    }
}
