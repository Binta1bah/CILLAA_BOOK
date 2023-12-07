<?php

namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Faker\Core\File;

class UserController extends Controller
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
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6',
            'image' => 'required|string',
            'description' => 'nullable|string',
            'telephone' => 'required|string|max:255',
            'role' => 'required|in:Porteur,Bailleur,Admin',
            'organisme' => 'nullable|in:ONG,Entreprise,Particulier',
        ]);

        $user= new User();
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password= $request->password;
        $user->description= $request->description;
        $user->telephone= $request->telephone;
        $user->role= $request->role;
        $user->organisme= $request->organisme;
        $imageData = $request->image;
        $imageName = time() . '.jpeg';
        file_put_contents(public_path('image/' . $imageName), $imageData);
        $user->image = "image/" . $imageName;

        if($user->save()){
            return response()->json([
                "status"=>"ok",
                "message"=>"c'est bon",
                "data" => $user
           ]);
        }
      
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
