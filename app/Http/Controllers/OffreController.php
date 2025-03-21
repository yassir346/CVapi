<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;

class OffreController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offres = Offre::all();
        return response()->json($offres);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Offre::class);
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'contract_type' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        if($validator->fails()){
            return response()->json($validator->error(), 422);
        }

        $offre = Offre::create($validator->validated());
        return response()->json($offre, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Offre $offre)
    {
        $this->authorize('view', $offre);
        return response()->json($offre);
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offre $offre)
    {
        $this->authorize('update', $offre);
        $validator = Validator::make($request->all(), [
            'title' => 'string|max:255',
            'description' => 'string',
            'location' => 'string|max:255',
            'contract_type' => 'string|max:255',
            'category' => 'string|max:255',
            'user_id' => 'exists:users,id',
        ]);

        if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
        }

        $offre->update($validator->validated());

        return response()->json($offre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offre $offre)
    {
        $this->authorize('delete', $offre);
        $offre->delete();

        return response()->json(null, 204);
    }

    public function apply(Offre $offre)
    {
        $this->authorize('apply', Offre::class);
        return response()->json(['message' => 'Application submitted successfully.'], 200);
    }
}
