<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Promise\Create;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashBordBailleur()
    {
        $user = auth()->user();
        return response()->json([
            "message" => "Bienvenue sur ton Dashboard",
            "data" => $user
        ]);
    }

    public function dashBordPorteur()
    {
        $user = auth()->user();
        return response()->json([
            "message" => "Bienvenue sur ton Dashboard",
            "data" => $user
        ]);
    }

    public function dashBordAdmin()
    {
        $user = auth()->user();
        return response()->json([
            "message" => "Bienvenue sur ton Dashboard",
            "data" => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user =  User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                if ($user->role === 'Bailleur') {

                    $token = $user->createToken('auth_token')->plainTextToken;
                    return response()->json([
                        "statut" => 1,
                        "massage" => "Vous êtes connecté en tant que Bailleur",
                        "token" => $token,
                        "datas" => $user
                    ]);
                } elseif ($user->role === 'Porteur') {
                    $token = $user->createToken('auth_token')->plainTextToken;
                    return response()->json([
                        "statut" => 1,
                        "massage" => "Vous êtes connecté en tant que Porteur de projet",
                        "token" => $token
                    ]);
                } else {
                    $token = $user->createToken('auth_token')->plainTextToken;
                    return response()->json([
                        "statut" => 1,
                        "massage" => "Vous êtes connecté en tant que Admin",
                        "token" => $token
                    ]);
                }
            } else {
                return response()->json([
                    "statut" => 0,
                    "massage" => "Mot de passe Incorrect"
                ]);
            }
        } else {
            return response()->json([
                "massage" => "Email Introuvable"
            ]);
        }
    }

    public function Connexion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {

            return Response(['message' => $validator->errors()], 401);
        }

        if (Auth::attempt($request->all())) {
            $user = Auth::user();

            if ($user->role === "Bailleur") {
                $success =  $user->createToken('MyApp')->plainTextToken;
                return response([
                    'message' => 'Vous êtes connecté en tant que bailleur',
                    'token' => $success,
                    'datas' => $user
                ], 200);
            } elseif ($user->role === "Porteur") {
                $success =  $user->createToken('MyApp')->plainTextToken;
                return response([
                    'message' => 'Vous êtes connecté en tant que Porteur de projet',
                    'token' => $success,
                    'datas' => $user
                ], 200);
            } elseif ($user->role === "Admin") {
                $success =  $user->createToken('MyApp')->plainTextToken;
                return response([
                    'message' => 'Vous êtes connecté en tant que Admin',
                    'token' => $success,
                    'datas' => $user
                ], 200);
            }
        }


        return Response(['message' => 'email or password wrong'], 401);
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

    public function logout(): Response
    {
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        return Response(['message' => 'Deconnexion effectuée'], 200);
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
