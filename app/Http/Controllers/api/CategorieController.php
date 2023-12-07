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
    public function index(Request $request){

        try{

           $requette=Projet::query();
        //    dd($request);
           $perPage= 4;
           $page=$request->input('page',1);
           $recherche=$request->input('recherche');
           
           // on vérifie si l'utilisateur fais un recherche sur un titre 
           if ($recherche) {
               $requette->whereRaw("categories LIKE '%" .$recherche . "%'");
               
               
           } 
           // on compte le nonbre de resultat trouver sur la bases de donner
           $total=$requette->count();  
           $resultat = $requette->offset(($page - 1) * $perPage)->limit($perPage)->get();
           

           return response()->json(
               [
                   'status_code'=>200,
                   'status_massage'=> 'les projet on etais récupérer',
                   'current_page'=>$page,
                   'Last_page'=>ceil($total / $perPage),
                   // dd($resultat);
                  'items'=>$resultat
               ]);
           
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
