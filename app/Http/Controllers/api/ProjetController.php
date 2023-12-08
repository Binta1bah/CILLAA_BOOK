<?php

namespace App\Http\Controllers\api;
use Exception;
use App\Models\Projet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditeProjetRequest;
use App\Http\Requests\CreateProjetRequest;
use App\Models\Invertissement;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){

        try{
 return response()->json(
    [
        'status_code'=> 200,
        'status_message'=> 'les projet on été recupérer',
             'data'=> Projet::all()
    ]
    );
        }catch(Exception $e){
           response()->json($e);
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
    public function store( $request)
    {
        // ici on va créer un projet
        $projet=new Projet();
        $projet->nom= $request->nom;
        $projet->objectif= $request->objectif;
        $projet->description= $request->description;
        $projet->echeanche= $request->echeance;
        $projet->budget= $request->budget;

        $projet->user_id= auth()->user()->id;
        $projet->save();
        return response()->json(
           [
               'status_code'=>200,
               'status_massage'=> 'projet créer avec succéss',
               'data'=>$projet
           ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Projet $projet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EditeProjetRequest $request,  Projet $projet)
    {
        // ici on va selection et proposer un investissement
                 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projet $projet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projet $projet)
    {
        //
    }
}
