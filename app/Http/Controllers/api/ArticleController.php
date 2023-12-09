<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\newslellerEmail;
use App\Models\Commentaire;
use App\Models\NewsLetter;
use App\Notifications\InfoNewsArticle;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $article = Article::all();
        $totalArticle = $article->count();

        return response()->json([
            "status" => 1,
            "message" => "voici vos articles",
            "Total" => $totalArticle,
            "data" => $article
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
            'titre' => 'required|string|max:255',
            'photo' => 'required',
            'description' => 'required|string'
        ]);

        $article = new Article();
        $article->titre = $request->titre;
        $imageData = $request->photo;
        $imageName = time() . '.jpeg';
        file_put_contents(public_path('image/' . $imageName), $imageData);
        $article->photo = "image/" . $imageName;
        $article->description = $request->description;

        if ($article->save()) {
            // Envoie Email aux abonnées du newsletters

            $newsletters = NewsLetter::all();
            foreach ($newsletters as $newsletter) {
                Mail::to($newsletter->email)->send(new newslellerEmail());
            }

            return response()->json([
                "status" => 1,
                "message" => "L'article a été ajouter avec succès",
                "data" => $article
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $commentaires = Commentaire::where('article_id', $article->id)->get();

        return response()->json([
            "message" => "Les Articles",
            "articles" => $article,
            "commentaire" => $commentaires
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'photo',
            'description' => 'required|string'
        ]);

        $article->titre = $request->titre;
        $imageData = $request->photo;
        $article->description = $request->description;
        if ($request->hasFile('image')) {
            $imageData = $request->photo;
            $imageName = time() . '.jpeg';
            file_put_contents(public_path('image/' . $imageName), $imageData);
            $article->photo = "image/" . $imageName;
        }


        if ($article->update()) {
            return response()->json([
                "status" => 1,
                "message" => "L'article a été modifier avec succès",
                "data" => $article
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if ($article->delete()) {
            return response()->json([
                "status" => 1,
                "message" => "L'article a été supprimer avec succès",
                "data" => $article
            ]);
        }
    }
}
