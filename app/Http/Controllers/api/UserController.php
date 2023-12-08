<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Faker\Core\File;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function DashboardPorteur()
    {
        $user= auth()->user();
        // dd($user);
       return "je suis porteur";
    }

    public function DashboardBailleur()
    {
        $user= auth()->user();
        // dd($user);
       return "je suis Bailleur";
    }

    public function DashboardAdmin()
    {
        $user= auth()->user();
        // dd($user);
       return "je suis Admin";
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     $user =  User::where('email', $request->email)->first();

    //     if ($user) {
    //         if (Hash::check($request->password, $user->password)) {
    //             if ($user->role === 'Bailleur') {

    //                 $token = $user->createToken('auth_token')->plainTextToken;
    //                 return response()->json([
    //                     "statut" => 1,
    //                     "massage" => "Vous êtes connecté en tant que Bailleur",
    //                     "token" => $token
    //                 ]);
    //             } elseif ($user->role === 'Porteur') {
    //                 $token = $user->createToken('auth_token')->plainTextToken;
    //                 return response()->json([
    //                     "statut" => 1,
    //                     "massage" => "Vous êtes connecté en tant que Porteur de projet",
    //                     "token" => $token
    //                 ]);
    //             } else {
    //                 $token = $user->createToken('auth_token')->plainTextToken;
    //                 return response()->json([
    //                     "statut" => 1,
    //                     "massage" => "Vous êtes connecté en tant que Admin",
    //                     "token" => $token
    //                 ]);
    //             }
    //         } else {
    //             return response()->json([
    //                 "statut" => 0,
    //                 "massage" => "Mot de passe Incorrect"
    //             ]);
    //         }
    //     } else {
    //         return response()->json([
    //             "massage" => "Email Introuvable"
    //         ]);
    //     }
    // }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        // $token = $user->createToken('auth_token')->plainTextToken;

        if ($user->role === 'Bailleur') {
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                "status" => 1,
                "message" => "Vous êtes connecté en tant que Bailleur",
                "token" => $token
            ]);
        } elseif ($user->role === 'Porteur') {
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                "status" => 1,
                "message" => "Vous êtes connecté en tant que Porteur de projet",
                "token" => $token
            ]);
        } else {
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                "status" => 1,
                "message" => "Vous êtes connecté en tant que Admin",
                "token" => $token
            ]);
        }
    } else {
        return response()->json([
            "status" => 0,
            "message" => "Identifiants incorrects"
        ], 401); 
    }
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

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->description = $request->description;
        $user->telephone = $request->telephone;
        $user->role = $request->role;
        $user->organisme = $request->organisme;
        $imageData = $request->image;
        $imageName = time() . '.jpeg';
        file_put_contents(public_path('image/' . $imageName), $imageData);
        $user->image = "image/" . $imageName;

        if ($user->save()) {
            return response()->json([
                "status" => "ok",
                "message" => "c'est bon",
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
