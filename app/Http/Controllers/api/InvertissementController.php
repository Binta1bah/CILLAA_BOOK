<?php
namespace App\Http\Controllers\api;
use App\Models\User;
use App\Models\Projet;
use Illuminate\Http\Request;
use App\Models\Invertissement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditeProjetRequest;
use App\Http\Requests\CreateProjetRequest;
use App\Notifications\InvestissementNotification;

class InvertissementController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EditeProjetRequest $request,Projet $projet)
    {
        //
        $investissement=new Invertissement();
        $investissement->montant=$request->montant;
        $investissement->description=$request->description;
        $investissement->projet_id=$request->projet_id;
        $investissement->user_id=$request->user_id;
        $userId=$projet->user_id;
        if ($investissement->save()) {
            // Récupérer l'instance de l'investissement avec l'utilisateur chargé
            $investissementAvecUtilisateur = Invertissement::with('user')->find($investissement->id);
        
            // Récupérer l'utilisateur associé à l'investissement
            $user = $investissementAvecUtilisateur->user;
        
            if ($user) {
                $user->notify(new InvestissementNotification());
            
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Votre proposition a été enregistrée',
                    'data' => $investissement
                ]);
            } else {
                return response()->json([
                    'status_code' => 404,
                    'status_message' => 'Utilisateur non trouvé'
                ]);
            }  

    }}

    /**
     * Display the specified resource.
     */
    public function show(Invertissement $invertissement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invertissement $invertissement)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invertissement $invertissement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invertissement $invertissement)
    {
        //
    }
}
