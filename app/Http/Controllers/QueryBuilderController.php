<?php

namespace App\Http\Controllers;

use App\Repository\CvRepository;
use Illuminate\Http\Request;

class QueryBuilderController extends Controller
{
    //
    protected CvRepository $cvRepository;
    public function __construct()
    {
        $this->cvRepository = new CvRepository;
    }
    public function store(Request $request)
    {
        $regex = "/*[0-9]";
        $validate = preg_match($request->file_size, $regex);
        if (!$validate) {
            return response()->json(["message" => "validation not worcking"]);
        }

        $data = $request->all();

        $this->cvRepository->store($data);
    }
    public function show()
    {
        $cvs = $this->cvRepository->show();

        
    }
    public function destroy(Request $request)
    {
        $cvs = $this->cvRepository->destroy($request->id);

        return response()->json(["id is deleted " => $cvs]);
    }
    public function update(Request $request)
    {
        $data = $request->all();

        $this->cvRepository->update($data, $request->id);
    }
}
