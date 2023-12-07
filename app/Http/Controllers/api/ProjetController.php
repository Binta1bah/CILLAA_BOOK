<?php

namespace App\Http\Controllers\api;
use App\Models\User;
use App\Models\Projet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return Projet::with('User')->get();
        $projets  = Projet::all();

        return response()->json($projets);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'nom' => 'required',
            'objectif' => 'required',
            'description' => 'required',
            'echeance' => 'required',
            'budget' => 'required|numeric',
            'etat' => 'in:Disponible,Financé',
            'categories_id' => 'required|exists:categories,id',
        ]);

        //On crée un nouvel projet
        $projet = Projet::create([
            'nom' => $request->name,
            'objectif' => $request->objectif,
            'description' => $request->description,
            'echeance' => $request->echeance,
            'budget' => $request->budget,
            'etat' => $request->etat,
            'categorie_id'
        ]);

        return response()->json($projet, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Projet $projet)
    {
        return response()->json($projet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projet $projet)
    {
        $request->validate([
            'nom' => 'required',
            'objectif' => 'required',
            'description' => 'required',
            'echeance' => 'required',
            'budget' => 'required|numeric',
            'etat' => 'in:Disponible,Financé',
            'categories_id' => 'required|exists:categories,id',
        ]);

        //On met à jour  un  projet existant
        $projet = update([
            'nom' => $request->name,
            'objectif' => $request->objectif,
            'description' => $request->description,
            'echeance' => $request->echeance,
            'budget' => $request->budget,
            'etat' => $request->etat,
            'categorie_id',
        ]);

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projet $projet)
    {
        $projet ->delete();

        return response()->json();
    }
}
