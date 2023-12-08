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
  public function store(EditeProjetRequest $request,Projet $projet)
    {
         try{
        $investissement = new Invertissement();
        $investissement->montant = $request->montant;
        $investissement->description = $request->description;
        $investissement->projet_id = $request->projet_id;
        $investissement->user_id = $request->user_id;
        if ($investissement->save()) {
            // on Récupére le projet associé à l'investissement
            $projet = Projet::find($request->projet_id);
                    if ($projet) {
                        // on Récupére l'utilisateur associé au projet
                        $user = $projet->user;
                            if ($user) {
                                // puis on Notifie l'utilisateur qui a créé le projet
                                $user->notify(new InvestissementNotification());
                                        return response()->json([
                                            'status_code' => 200,
                                            'status_message' => 'Votre proposition a été enregistrée',
                                            'data' => $investissement
                                        ]);
                                    } else {
                                        return response()->json([
                                            'status_code' => 404,
                                            'status_message' => 'Utilisateur du projet non trouvé'
                                        ]);
                                    }
                                            } else {
                                                return response()->json([
                                                    'status_code' => 404,
                                                    'status_message' => 'Projet non trouvé'
                                                ]);
                                            }
                                            } else {
                                                return response()->json([
                                                    'status_code' => 500,
                                                    'status_message' => 'Erreur lors de l\'enregistrement de la proposition'
                                                ]);
                                            }
         }catch(Exception $e){
            return response()->json($e);
         }
    }
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
