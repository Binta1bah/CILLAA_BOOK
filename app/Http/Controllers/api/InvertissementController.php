<?php
namespace App\Http\Controllers\api;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Invertissement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

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
    public function store(Request $request)
    {
        //
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

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Foundation\Application|Response|JsonResponse|Application|ResponseFactory
     */
    public function accepterInvertissement(Request $request, $id): \Illuminate\Foundation\Application|Response|JsonResponse|Application|ResponseFactory
    {

        $invertissement = Invertissement::find($id);

        if($invertissement){

            $input = $request->validate([
                'montant' => ['required'],
                'description' => ['required'],
                'status' => ['required'],
                'projet_id'=>['required'],
            ]);

            $invertissement->montant = $input['montant'];
            $invertissement->description = $input['description'];
            $invertissement->status = $input['status'];

            if( $invertissement->save()) {
                return response()->json(data: [

                    'Message: ' => 'Status Investissement  with success.',
                    'Invertissement: ' => $invertissement
                ], status: 200);
            } else {

                return response([

                    'Message: ' => 'We could not update the product.',

                ], 500);

            }
        }else {

            return response([

                'Message: ' => 'We could not find the product.',

            ], 500);
        }

    }

    public function refuserInvertissement(Invertissement $invertissement): JsonResponse
    {
        $invertissement->update(['status' => 'Refuser']);
        return response()->json(['message' => 'Investment refused', 'invertissement' => $invertissement]);
    }
}
