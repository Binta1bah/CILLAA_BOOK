<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Models\User;
use App\Models\Projet;
use Illuminate\Http\Request;
use App\Models\Invertissement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\EditeProjetRequest;
use App\Http\Requests\CreateProjetRequest;
use App\Mail\InvestissementMail;
use App\Mail\PropositionAcceptee;
use App\Notifications\InvestissementNotification;

class InvertissementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = auth()->user();
        $investissements = Invertissement::where('user_id', $user->id)->get();

        return response()->json([
            "message" => "Vos proposition d'investissement",
            "datas" => $investissements
        ]);
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
    public function store(EditeProjetRequest $request, string $id)

    {
        $user = auth()->user();
        $projet = Projet::findOrFail($id);
        // $porteur = $projet->user_id;
        $projet_id = $projet->id;
        $user_id = $user->id;

        // try {
        $investissement = new Invertissement();
        $investissement->montant = $request->montant;
        $investissement->description = $request->description;
        $investissement->projet_id = $projet_id;
        $investissement->user_id = $user_id;
        if ($investissement->save()) {
            $porteur = User::find($projet['user_id']);
            $envoi = Mail::to($porteur->email)->send(new InvestissementMail());
            if ($envoi) {
                return response()->json([
                    "message" => "c'est bon email envoyé"
                ]);
            } else {
                return response()->json([
                    "message" => "C'est pas bon"
                ]);
            }
            //         // on Récupére le projet associé à l'investissement
            //         $projet = Projet::find($request->projet_id);
            //         if ($projet) {
            //             // on Récupére l'utilisateur associé au projet
            //             $user = $projet->user;
            //             if ($user) {
            //                 // puis on Notifie l'utilisateur qui a créé le projet
            //                 $user->notify(new InvestissementNotification());
            //                 return response()->json([
            //                     'status_code' => 200,
            //                     'status_message' => 'Votre proposition a été enregistrée',
            //                     'data' => $investissement
            //                 ]);
            //             } else {
            //                 return response()->json([
            //                     'status_code' => 404,
            //                     'status_message' => 'Utilisateur du projet non trouvé'
            //                 ]);
            //             }
            //         } else {
            //             return response()->json([
            //                 'status_code' => 404,
            //                 'status_message' => 'Projet non trouvé'
            //             ]);
            //         }
            //     } else {
            //         return response()->json([
            //             'status_code' => 500,
            //             'status_message' => 'Erreur lors de l\'enregistrement de la proposition'
            //         ]);
            //     }
            // } catch (Exception $e) {
            //     return response()->json($e);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $investissement = Invertissement::findorFail($id);
        $projet = $investissement->projet->nom;
        $user = auth()->user();
        if ($investissement->user_id == $user->id) {

            return response()->json([
                "message" => "Details de la proposition",
                "datas" => [
                    "montant" => $investissement->montant,
                    "description" => $investissement->description,
                    "projet" => $projet,
                    'date' => $investissement->created_at,
                    'statut' => $investissement->status
                ]
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function refuser(string $id)
    {

        $investissement = Invertissement::findOrFail($id);
        if ($investissement->status = "Accpter") {
            $investissement->status = "Refuser";
            if ($investissement->save()) {

                $bailler = User::find($investissement['user_id']);
                $envoi = Mail::to($bailler->email)->send(new PropositionAcceptee());
                if ($envoi) {
                    return response()->json([
                        "message" => "Proposition refuser"
                    ]);
                }
            }
        }
    }

    public function valider(string $id)
    {
        $investissement = Invertissement::findOrFail($id);
        if ($investissement->status = "Refuser") {
            $investissement->status = "Accepter";
            if ($investissement->save()) {

                $bailler = User::find($investissement['user_id']);
                $envoi = Mail::to($bailler->email)->send(new PropositionAcceptee());
                if ($envoi) {
                    return response()->json([
                        "message" => "Proposition acceptée"
                    ]);
                }
            }
        }
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
