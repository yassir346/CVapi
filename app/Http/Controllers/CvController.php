<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Http\Requests\StoreCvRequest;
use App\Http\Requests\UpdateCvRequest;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;

class CvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cv = Cv::all();
        return response()->json(['cv' => $cv]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        if ($request->size <= 5) {
            Cv::create($request->all());
        }
        
        return response()->json(['message', 'cv created']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCvRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        $cv = Cv::findOrFail($request->id);

        return response()->json([
            "message" => $cv
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cv $cv)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $cv = Cv::find($id);
        $cv->update(request()->all());
        return response()->json(["message", "this is updated"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        // return ["message"=> $request];
        $cv = Cv::find($id);
        $cv->delete();
        return response()->json(["message", "deleted"]);
        
    }
}
