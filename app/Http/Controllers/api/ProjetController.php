<?php

namespace App\Http\Controllers\api;
use Exception;
use App\Models\Projet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjetRequest;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){

        try{
 return response()->json(
    [
        'status_code'=> 200,
        'status_message'=> 'les projet on été recupérer',
             'data'=> Projet::all()
    ]
    );


        //    $requette=Projet::query();
        //    $perPage= 2;
        //    $page=$request->input('page',1);
        //    $recherche=$request->input('recherche');
           
        //    // on vérifie si l'utilisateur fais un recherche sur un titre 
        //    if ($recherche) {
        //        $requette->whereRaw("titre LIKE '%" .$recherche . "%'");
               
               
        //    } 
        //    // on compte le nonbre de resultat trouver sur la bases de donner
        //    $total=$requette->count();  
        //    $resultat = $requette->offset(($page - 1) * $perPage)->limit($perPage)->get();
           

        //    return response()->json(
        //        [
        //            'status_code'=>200,
        //            'status_massage'=> 'les article on etais récupérer',
        //            'current_page'=>$page,
        //            'Last_page'=>ceil($total / $perPage),
        //            // dd($resultat);
        //           'items'=>$resultat
        //        ]);
           
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
    public function store(CreateProjetRequest $request)
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
    public function edit(Projet $projet)
    {
        //
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
