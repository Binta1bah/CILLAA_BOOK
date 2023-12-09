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
    public function index(): \Illuminate\Http\JsonResponse
    {
        //return Projet::with('User')->get();
        $projets  = Projet::all();

        return response()->json($projets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function creer(Request $request): \Illuminate\Http\JsonResponse
    {


        $request->validate([
            'nom' => 'required',
            'image' => 'required',
            'objectif' => 'required',
            'description' => 'required',
            'echeance' => 'required',
            'budget' => 'required|numeric',
            'etat' => 'in:Disponible,Financé',
            'categorie_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $projet = Projet::create($request->all());
        return response()->json(['message' => 'Projet create successfully', 'projet' => $projet], 201);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        $data = $request->validate([
            'nom' => 'required',
            'image' => 'required',
            'objectif' => 'required',
            'description' => 'required',
            'echeance' => 'required',
            'budget' => 'required|numeric',
            'etat' => 'in:Disponible,Financé',
            'categorie_id' => 'required|exists:categories,id',
            // 'user_id' => 'required|exists:users,id'
        ]);
        $data['user_id'] = $user->id;
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('images', 'public');
            $data['image'] = $image_path;
        }
        $projet = Projet::create($data);

        return response()->json(['message' => 'Projet create successfully', 'projet' => $projet], 201);
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
        //update avec validation
        $request->validate([
            'nom' => 'required',
            'image' => 'required',
            'objectif' => 'required',
            'description' => 'required',
            'echeance' => 'required',
            'budget' => 'required|numeric',
            'etat' => 'in:Disponible,Financé',
            'categorie_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // On met à jour un projet existant
        $projet->update($request->all());

        return response()->json(['message' => 'Projet update successfully', 'projet' => $projet], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projet $projet): \Illuminate\Http\JsonResponse
    {
        $projet->delete();

        return response()->json();
    }
}
