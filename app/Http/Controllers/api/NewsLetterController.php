<?php

namespace App\Http\Controllers\api;
use App\Models\NewsLetter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsletters= NewsLetter::all();
        $total= $newsletters->count();

        return response()->json([
            "status"=>1,
            "message"=> "voici vos articles",
            "Total"=>$total,
            "data"=>$newsletters
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
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:news_letters,email|max:255'
        ]);

        $newsletter= new NewsLetter();
        $newsletter->email= $request->email;
        if($newsletter->save()){
            return response()->json([
                "status"=>1,
                "message"=> "Votre Email a ete Envoyer",
            ]);
        }
      
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsLetter $newsLetter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsLetter $newsLetter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NewsLetter $newsLetter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
   

    public function supprimer($id){
        $newsLetter= NewsLetter::findOrFail($id);

        if($newsLetter->delete()){
            return response()->json([
                "status"=>1,
                "message"=> "Email supprimer avec succès"
            ]);
        }
    }
}
