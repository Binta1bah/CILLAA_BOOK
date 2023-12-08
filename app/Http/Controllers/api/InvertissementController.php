<?php
namespace App\Http\Controllers\api;
use App\Models\User;
use App\Models\Projet;
use Illuminate\Http\Request;
use App\Models\Invertissement;
use App\Http\Controllers\Controller;
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
    public function store(EditeProjetRequest $request)
    {
        //
        $investissement=new Invertissement();
        $investissement->montant=$request->montant;
        $investissement->description=$request->description;
        $investissement->projet_id=$request->projet_id;
        $investissement->user_id=$request->user_id;
        if($investissement->save()) {
            $user= User::Where('user_id')->first();
            $user->notify(new InvestissementNotification());
        return response()->json(
            [
                'status_code'=>200,
                'status_massage'=> 'Votre proposition a etais enregistrer',
                'data'=>$investissement
            ]);


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
