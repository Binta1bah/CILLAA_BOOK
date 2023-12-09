<?php

namespace App\Http\Controllers\api;
use App\Models\Commentaire;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $commentaires  = Commentaire::all();

        return response()->json($commentaires );
    }


    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required',
            'contenu' => 'required',
            'article_id' => 'required|exists:articles,id'
        ]);
         $commentaire = Commentaire::create($request->all());
        return response()->json(data: ['message' => 'Commentaire create successfully', 'commentaire' => $commentaire], status: 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Commentaire $commentaire): JsonResponse
    {
        return response()->json($commentaire);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commentaire $commentaire): JsonResponse
    {
        //update avec validation
        $request->validate([
            'nom' => 'required',
            'email' => 'required',
            'contenu' => 'required',
            'article_id' => 'required|exists:articles,id',
        ]);

        // On met à jour un projet existant
        $commentaire->update($request->all());

        return response()->json(['message' => 'Projet update successfully', 'commentaire' => $commentaire], 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commentaire $commentaire): JsonResponse
    {
        $commentaire ->delete();

        return response()->json(['message' => 'Commentaire delete successfully', 'commentaire' => $commentaire]);
    }
}
