<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use App\Http\Requests\StoreCompetenceRequest;
use GuzzleHttp\Psr7\Request;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $competence = Competence::all();
        return response()->json(['competence' => $competence]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($request)
    {
        //
        Competence::create($request->all());
        return response()->json(['message', 'competences ajoutées']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompetenceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
        $competence = Competence::all();

        return response()->json([
            "message" => $competence
        ]);
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        //
        $competence = Competence::findOrFail($id, $request);
        $competence->update(request()->all());
        return response()->json(["message", "updated"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $competence = Competence::find($id);
        $competence->delete();
        return response()->json(["message", "deleted"]);
    }
}
