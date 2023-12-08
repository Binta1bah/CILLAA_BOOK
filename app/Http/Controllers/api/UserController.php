<?php

namespace App\Http\Controllers\API;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\LogUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }



public function register(RegisterUser $request){
    try{
        $user = new User();
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password= $request->password;
        $user->telephone= $request->telephone;
        $user->description=$request->description;
        $image=$request->file('image');
        if ($image !== null && !$image->getError()) {
            $validata['image'] = $image->store('image', 'public');
        }
        $user->save();
    
        return response()->json(
          [
              'status_code'=>200,
              'status_massage'=> 'Utilisateur enregistré',
              'user'=>$user
          ]);
    }catch(Exception $e){
        return response()->json($e);
    }
}

public function login(LogUserRequest $request){

                     try{
                        if (auth()->attempt($request->only(['email', 'password']))) {
                            $user= auth()->user();
                            $token = $user->createToken('Ma_CLE_VISIBLE_UNIQUEMENT_AU_BAKEND')->plainTextToken;
              
                            return response()->json(
                              [
                                  'status_code'=>200,
                                  'status_massage'=> 'Utilisateur connecté.',
                                  'user'=>$user,
                                  'token'=>$token
                                  
                              ]);
                        }else {
                          // Si les information ne correspondent a aucun utilisateur
                          return response()->json(
                              [
                                  'status_code'=>403,
                                  'status_massage'=> 'Information non valide',
                                  
                              ]);
                        }




                     }catch(Exception $e){
                        return response()->json($e);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
