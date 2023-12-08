<?php

namespace App\Http\Controllers\api;
use App\Models\User;
use App\Models\Projet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

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
        //On crée un nouvel projet
        $projet = new Projet();
        $projet ->nom = $request->nom;
        $projet ->image = $request->image;
        $projet ->objectif = $request->objectif;
        $projet ->description = $request->description;
        $projet->echeance = $request->echeance;
        $projet->budget = $request->budget;
        $projet->etat = $request->etat;
        $projet->categorie_id = $request->categorie_id;
        $projet->user_id = $request->user_id;
        $projet->save();
        return response()->json(['message' => 'Project create successfully', 'projet' => $projet], 201);

    }


    /**
     * Display the specified resource.
     */
    public function show(Projet $projet): \Illuminate\Http\JsonResponse
    {
        return response()->json($projet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projet $projet): \Illuminate\Http\JsonResponse
    {

        //On met à jour  un  projet existant
            $projet = new Projet();
            $projet ->nom = $request->nom;
            $projet ->image = $request->image;
            $projet ->objectif = $request->objectif;
            $projet ->description = $request->description;
            $projet->echeance = $request->echeance;
            $projet->budget = $request->budget;
            $projet->etat = $request->etat;
            $projet->categorie_id = $request->categorie_id;
            $projet->user_id = $request->user_id;
            $projet->update();
            return response()->json(['message' => 'Project update  successfully', 'projet' => $projet], 201);

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
